<?php

namespace AppBundle\Controller;

use AppBundle\Utilities\GestionScout;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * Class StatistiqueRegionController
 * @Route("/etat-objectif/statistiques")
 */
class StatistiqueRegionController extends Controller
{
    /**
     * @Route("/", name="etat_statistique_objectif")
     */
    public function indexAction(GestionScout $gestionScout)
    {
        $em = $this->getDoctrine()->getManager();
        $annee = $gestionScout->cotisation();

        $regions = $em->getRepository("AppBundle:Region")->findOnlyRegion();

        return $this->render("etat/etat_statistiques.html.twig",[
            'regions' => $regions,
            'annee' => $annee
        ]);
    }

    /**
     * @Route("/{region}", name="region_objectif")
     * @Method("GET")
     */
    public function objectifAction($region, GestionScout $gestionScout)
    {
        $em = $this->getDoctrine()->getManager();
        $annee = $gestionScout->cotisation();
        $objectif = $em->getRepository('AppBundle:Objectif')->findOneBy(['region'=>$region,'annee'=>$annee]);
        if ($objectif) $nombre = $objectif->getValeur();
        else $nombre = 0;

        return $this->render("default/nombre.html.twig",[
            'nombre' => $nombre,
        ]);
    }

    /**
     * @Route("/{slug}/taux", name="region_taux")
     * @Method("GET")
     */
    public function tauxAction($slug, GestionScout $gestionScout)
    {
        $em = $this->getDoctrine()->getManager();
        $cotisation = $gestionScout->cotisation();
        $region = $em->getRepository("AppBundle:Region")->findOneBy(['slug'=>$slug]);
        $nombre_scout = $em->getRepository("AppBundle:Scout")->getNombreByRegion($slug, $cotisation);
        $objectif = $em->getRepository("AppBundle:Objectif")->findOneBy(['region'=>$region->getId(),'annee'=>$cotisation]);
        if ($objectif){
            if ($objectif->getValeur() != 0)$taux = $nombre_scout * 100 / $objectif->getValeur();
            else $taux = null;
        }else{
            $taux = null;
        }
        $total = $em->getRepository("AppBundle:Scout")->getNmbreTotal($cotisation);

        return $this->render('default/nombre_objectif.html.twig',[
            'nombre' => $nombre_scout,
            'taux' => round($taux),
        ]);
    }
}
