<?php

namespace AppBundle\Controller;

use AppBundle\Utilities\GestionScout;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class RegEtatGlobalController
 * @Route("/etat-region")
 */
class RegEtatGlobalController extends Controller
{
    /**
     * @param Request $request
     * @param GestionScout $gestionScout
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @Route("/{region}", name="etat_region_index")
     * @Method("GET")
     */
    public function indexAction(Request $request, GestionScout $gestionScout)
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
     * @Route("/{district}", name="etat_region_district")
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
}
