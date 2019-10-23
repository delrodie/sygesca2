<?php

namespace AppBundle\Controller;

use AppBundle\Utilities\GestionScout;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * Class StatistiqueController
 * @Route("/statistiques")
 */
class StatistiqueController extends Controller
{
    /**
     * Effectif total
     *
     * @Route("/", name="statistiques_total")
     */
    public function totalAction(GestionScout $gestionScout)
    {
        $em = $this->getDoctrine()->getManager();
        $pourcentage = $em->getRepository("AppBundle:Scout")->getNmbreTotal($gestionScout->cotisation());
        return $this->render("default/statistique_nombre_scout.html.twig",['pourcentage'=>$pourcentage]);
    }

    /**
     * Effectif total
     *
     * @Route("/pourcentage", name="statistiques_pourcentage_total")
     */
    public function pourcentageAction(GestionScout $gestionScout)
    {
        $em = $this->getDoctrine()->getManager();
        $nombre = $em->getRepository("AppBundle:Scout")->getNmbreTotal($gestionScout->cotisation());
        $pourcentage = $nombre*100/20000;
        return $this->render("default/statistique_nombre_scout.html.twig",['pourcentage'=>$pourcentage]);
    }

    /**
     * Effectifs regions
     *
     * @Route("/region/{slug}", name="statistiques_region_nombre")
     * @Method({"GET","POST"})
     */
    public function regionAction($slug, GestionScout $gestionScout)
    {
        $em = $this->getDoctrine()->getManager();
        $cotisation = $gestionScout->cotisation();
        $nombre_scout = $em->getRepository("AppBundle:Scout")->getNombreByRegion($slug, $cotisation);
        $total = $em->getRepository("AppBundle:Scout")->getNmbreTotal($cotisation);
        if (!$total){
            $total = 1;
        }
        $pourcentage = $nombre_scout*100/$total;
        return $this->render('default/statistique_nombre_scout.html.twig',[
            'pourcentage' => $pourcentage
        ]);
    }

    /**
     * Statistiques des jeunes par branche
     *
     * @Route("/branche/{slug}/", name="statistques_branche")
     * @Method("GET")
     */
    public function brancheAction($slug, GestionScout $gestionScout)
    {
        $em = $this->getDoctrine()->getManager(); //dump($slug);die();
        $total_jeune = $em->getRepository("AppBundle:Scout")->getNombreTotalParStatut('Jeune',$gestionScout->cotisation());
        $branche = $em->getRepository("AppBundle:Scout")->getNombreTotalParBranche('Jeune',$slug,$gestionScout->cotisation());

        if (!$total_jeune){
            $total_jeune = 1;
        }
        $pourcentage = $branche*100/$total_jeune; //dump($branche);die();

        return $this->render("default/statistique_statut.html.twig",[
            'nombre' => $branche,
            'pourcentage' => $pourcentage
        ]);
    }

    /**
     * Statistiques par statut
     *
     * @Route("/statut/{slug}/s", name="statistiques_total_statut")
     * @Method("GET")
     */
    public function statutAction($slug, GestionScout $gestionScout)
    {
        $em = $this->getDoctrine()->getManager(); //dump($slug);die();
        $total_statut = $em->getRepository("AppBundle:Scout")->getNombreTotalParStatut($slug,$gestionScout->cotisation());

        $total = $em->getRepository("AppBundle:Scout")->getNmbreTotal($gestionScout->cotisation());

        if (!$total){
            $total = 1;
        }
        $pourcentage = $total_statut*100/$total; //dump($branche);die();

        return $this->render("default/statistique_statut.html.twig",[
            'nombre' => $total_statut,
            'pourcentage' => $pourcentage
        ]);

    }

}
