<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * Class TotauxCartographieController
 * @Route("/catograhie-statistique")
 */
class TotauxCartographieController extends Controller
{
    /**
     * @Route("/{region}", name="cartographie_totaux_region")
     * @Method("GET")
     */
    public function regionAction($region)
    {
        $em = $this->getDoctrine()->getManager();
        $nombre_district = $em->getRepository("AppBundle:District")->getDistrictNombre($region);
        $nombre_groupe = $em->getRepository("AppBundle:Groupe")->getGroupeNombre($region);

        return $this->render('default/totaux_cartographie.html.twig',[
            'nombre_district' => $nombre_district,
            'nombre_groupe' => $nombre_groupe
        ]);
    }

    /**
     * @Route("/{district}/", name="cartographie_totaux_district")
     * @Method("GET")
     */
    public function districtAction($district)
    {
        $em = $this->getDoctrine()->getManager();
        $nombre_groupe = $em->getRepository("AppBundle:Groupe")->getGroupeNombre(true,$district);

        return $this->render('default/nombre.html.twig',[
            'nombre' => $nombre_groupe
        ]);

    }
}
