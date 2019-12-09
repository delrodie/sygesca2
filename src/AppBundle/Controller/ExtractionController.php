<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Region;
use AppBundle\Utilities\GestionScout;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ExtractionController
 * @Route("/extraction")
 */
class ExtractionController extends Controller
{
    /**
     * @Route("/", name="extraction_index")
     */
    public function indexAction(GestionScout $gestionScout)
    {
        $em = $this->getDoctrine()->getManager();
        $scouts = $em->getRepository("AppBundle:Scout")->findBy(['cotisation'=>$gestionScout->cotisation()]);
        return $this->render("extraction/liste_globale.html.twig",[
            'scouts' => $scouts,
            'annee' => $gestionScout->cotisation(),
        ]);
    }

    /**
     * @Route("/region", name="extraction_region_liste")
     */
    public function regionAction()
    {
        $em = $this->getDoctrine()->getManager();
        $regions = $em->getRepository("AppBundle:Region")->findAll();

        return $this->render("extraction/region.html.twig",[
            'regions' => $regions,
        ]);
    }

    /**
     * @Route("/{region}/", name="extraction_region_show")
     * @Method({"GET","POS"})
     */
    public function regionshowAction(Region $region, GestionScout $gestionScout)
    {
        $em = $this->getDoctrine()->getManager();

        $districts = $em->getRepository("AppBundle:District")->findBy(['region'=>$region->getId()]);
        $groupes = $em->getRepository("AppBundle:Groupe")->findGroupeDESC($region->getId());
        $scouts = $em->getRepository("AppBundle:Scout")->findByRegion($gestionScout->cotisation(),$region->getSlug());

        return $this->render("extraction/liste_region.html.twig",[
            'scouts' => $scouts,
            'region' => $region,
            'districts' => $districts,
            'groupes' => $groupes,
            'annee' => $gestionScout->cotisation(),
        ]);
    }

    /**
     * @Route("/{region}/district", name="extraction_district_show")
     * @Method({"GET","POST"})
     */
    public function districtAction(Request $request, Region $region, GestionScout $gestionScout)
    {
        $em = $this->getDoctrine()->getManager();
        $districtID = $request->get('district');

        $districts = $em->getRepository("AppBundle:District")->findBy(['region'=>$region->getId()]);
        $district = $em->getRepository("AppBundle:District")->findOneBy(['id'=>$districtID]);
        $groupes = $em->getRepository("AppBundle:Groupe")->findBy(['district'=>$districtID]);
        $scouts = $em->getRepository("AppBundle:Scout")->findByDistrict($gestionScout->cotisation(),$district->getSlug());

        return $this->render("extraction/liste_district.html.twig",[
            'scouts' => $scouts,
            'region' => $region,
            'districts' => $districts,
            'district' => $district,
            'groupes' => $groupes,
            'annee' => $gestionScout->cotisation()
            ]);
    }

    /**
     * @Route("/{region}/groupe/", name="extraction_groupe_show")
     * @Method({"GET","POST"})
     */
    public function groupeAction(Request $request, Region $region, GestionScout $gestionScout)
    {
        $em = $this->getDoctrine()->getManager();
        $paroisseSlug = $request->get('paroisse');

        $districts = $em->getRepository("AppBundle:District")->findBy(['region'=>$region->getId()]);
        $groupe = $em->getRepository("AppBundle:Groupe")->findOneBy(['slug'=>$paroisseSlug]);
        $groupes = $em->getRepository("AppBundle:Groupe")->findBy(['district'=>$groupe->getDistrict()->getId()]);
        $scouts = $em->getRepository("AppBundle:Scout")->findByGroupe($gestionScout->cotisation(),$groupe->getSlug());

        return $this->render("extraction/liste_groupe.html.twig",[
            'scouts' => $scouts,
            'region' => $region,
            'districts' => $districts,
            'groupe' => $groupe,
            'groupes' => $groupes,
            'annee' => $gestionScout->cotisation()
            ]);
    }
}
