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
}
