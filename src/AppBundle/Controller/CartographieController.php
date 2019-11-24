<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class CartographieController
 * @Route("/cartograhie")
 */
class CartographieController extends Controller
{
    /**
     * @Route("/", name="cartographie_indx")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $regions = $em->getRepository("AppBundle:Region")->findOnlyRegion();
        $nombre_region = $em->getRepository("AppBundle:Region")->getRegionNombre();
        $nombre_district = $em->getRepository("AppBundle:District")->getDistrictNombre();
        $nombre_groupe = $em->getRepository("AppBundle:Groupe")->getGroupeNombre();
        $groupes = $em->getRepository("AppBundle:Groupe")->findGroupeDESC();

        return $this->render('default/cartographie.html.twig',[
            'regions' => $regions,
            'nombre_region' => $nombre_region,
            'nombre_district' => $nombre_district,
            'nombre_groupe' => $nombre_groupe,
            'groupes' => $groupes
        ]);
    }

    /**
     * @Route("/region", name="cartographie_region")
     * @Method({"GET","POST"})
     */
    public function regionACtion(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $region = $request->get('region');
        $regionEntity = $em->getRepository("AppBundle:Region")->findOneBy(['id'=>$region]);
        $regions = $em->getRepository("AppBundle:Region")->findOnlyRegion();
        $nombre_district = $em->getRepository("AppBundle:District")->getDistrictNombre($region);
        $nombre_groupe = $em->getRepository("AppBundle:Groupe")->getGroupeNombre($region);
        $groupes = $em->getRepository("AppBundle:Groupe")->findGroupeDESC($region);
        $districts = $em->getRepository("AppBundle:District")->findByRegion($regionEntity->getSlug());

        return $this->render('default/cartographie_region.html.twig',[
            'regions' => $regions,
            'districts' => $districts,
            'nombre_district' => $nombre_district,
            'nombre_groupe' => $nombre_groupe,
            'groupes' => $groupes,
            'region' => $regionEntity
        ]);
    }
}
