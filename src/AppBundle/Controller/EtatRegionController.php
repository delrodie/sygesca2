<?php

namespace AppBundle\Controller;

use AppBundle\Utilities\GestionScout;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class EtatRegionController
 * @Route("/etats-region")
 */
class EtatRegionController extends Controller
{
    /**
     * @Route("/", name="etats_regionaux")
     */
    public function indexAction(Request $request, GestionScout $gestionScout)
    {
        $em = $this->getDoctrine()->getManager();$user =$this->getUser();

        // Recueration des roles
        $roles[]=$user->getRoles();
        if ($roles[0][0] =="ROLE_USER"){
            $gestionnaire = $em->getRepository("AppBundle:Gestionnaire")->findOneBy(['user'=>$user]);

            if ($gestionnaire == null){
                throw new AccessDeniedException();
            }else{
                $region = $em->getRepository("AppBundle:Region")->findOneBy(['id'=>$gestionnaire->getRegion()]);
                return $this->redirectToRoute("etat_region_index",['region'=>$region->getSlug()]);
            }
        }
        $scouts = $em->getRepository("AppBundle:Scout")->findAll();
        $regions = $em->getRepository("AppBundle:Region")->findOnlyRegion();

        return $this->render("etat/etat_global.html.twig",[
            'scouts' =>$scouts,
            'annee' => $gestionScout->cotisation(),
            'regions' => $regions
        ]);
    }

    /**
     * @Route("/region", name="etats_regionaux_show")
     * @Method({"GET","POST"})
     */
    public function regionAction(Request $request, GestionScout $gestionScout)
    {
        $em = $this->getDoctrine()->getManager();
        $regionSlug = $request->get('region'); //dump($regionSlug);die();
        if (!$regionSlug) return $this->redirectToRoute("etats_regionaux");

        $region = $em->getRepository("AppBundle:Region")->findOneBy(['slug'=>$regionSlug]);
        $scouts = $em->getRepository("AppBundle:Scout")->findByRegion($gestionScout->cotisation(),$regionSlug);
        $districts = $em->getRepository("AppBundle:District")->findByRegion($regionSlug);

        return $this->render("etat/etat_region.html.twig",[
            'region' => $region,
            'scouts' => $scouts,
            'districts' => $districts,
            'annee' => $gestionScout->cotisation()
        ]);

    }

    /**
     * @Route("/district/", name="etats_regionaux_districts")
     * @Method({"GET","POST"})
     */
    public function districtAction(Request $request, GestionScout $gestionScout)
    {
        $em = $this->getDoctrine()->getManager();
        $districtSlug = $request->get('district');
        if (!$districtSlug) return $this->redirectToRoute("etats_regionaux");

        $district = $em->getRepository("AppBundle:District")->findOneBy(['slug'=>$districtSlug]);
        $scouts = $em->getRepository("AppBundle:Scout")->findByDistrict($gestionScout->cotisation(),$districtSlug);
        $groupes = $em->getRepository("AppBundle:Groupe")->findBy(['district'=>$district->getId()],['id'=>'ASC']);

        return $this->render("etat/etat_district.html.twig",[
            'district' => $district,
            'scouts' => $scouts,
            'groupes' => $groupes,
            'annee' => $gestionScout->cotisation()
        ]);

    }

    /**
     * @Route("/groupe/liste", name="etats_regionaux_groupe")
     * @Method({"GET","POST"})
     */
    public function groupeAction(Request $request, GestionScout $gestionScout)
    {
        $em = $this->getDoctrine()->getManager();
        $groupeSlug = $request->get('groupe');
        if (!$groupeSlug) return $this->redirectToRoute("etats_regionaux");

        $groupe = $em->getRepository("AppBundle:Groupe")->findOneBy(['slug'=>$groupeSlug]);
        $scouts = $em->getRepository("AppBundle:Scout")->findByGroupe($gestionScout->cotisation(),$groupeSlug);
        $groupes = $em->getRepository("AppBundle:Groupe")->findBy(['district'=>$groupe->getDistrict()->getId()],['id'=>'ASC']);

        return $this->render("etat/etat_groupe.html.twig",[
            'groupe' => $groupe,
            'scouts' => $scouts,
            'groupes' => $groupes,
            'annee' => $gestionScout->cotisation()
        ]);
    }
}
