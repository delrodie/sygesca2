<?php

namespace AppBundle\Controller;

use AppBundle\Utilities\GestionScout;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $regions = $em->getRepository("AppBundle:Region")->findOnlyRegion();

        return $this->render('default/index.html.twig', [
            'regions' => $regions,
        ]);
    }

    /**
     * @Route("/tableau-de-bord_region", name="tbord_region")
     * @Method({"GET","POST"})
     */
    public function tbordAction(Request $request, GestionScout $gestionScout)
    {
        $em = $this->getDoctrine()->getManager();
        $slug = $request->get('region'); //dump($slug);die();
        $regions = $em->getRepository("AppBundle:Region")->findOnlyRegion();
        $region = $em->getRepository("AppBundle:Region")->findOneBy(['slug'=>$slug]);

        // Statistiques
        $total_jeune = $em->getRepository("AppBundle:Scout")->getNombreTotalParStatut('Jeune',$gestionScout->cotisation(), $slug);
        $total_adulte = $em->getRepository("AppBundle:Scout")->getNombreTotalParStatut('Adulte',$gestionScout->cotisation(), $slug);
        $meute = 'LOUVETEAU'; $troupe = 'ECLAIREUR'; $generation='CHEMINOT'; $route = 'ROUTIER';
        $louveteau = $em->getRepository("AppBundle:Scout")->getNombreTotalParBranche('Jeune',$meute,$gestionScout->cotisation(),$slug);
        $eclaireur = $em->getRepository("AppBundle:Scout")->getNombreTotalParBranche('Jeune',$troupe,$gestionScout->cotisation(),$slug);
        $cheminot = $em->getRepository("AppBundle:Scout")->getNombreTotalParBranche('Jeune',$generation,$gestionScout->cotisation(),$slug);
        $routier = $em->getRepository("AppBundle:Scout")->getNombreTotalParBranche('Jeune',$route,$gestionScout->cotisation(),$slug);

        if (!$total_jeune){
            $total_jeune = 1;
        }
        // Total inscrits
        $nombre_scout = $em->getRepository("AppBundle:Scout")->getNombreByRegion($slug, $gestionScout->cotisation());
        if (!$nombre_scout){
            $nombre_scout = 1;
        }

        $loup_pourcent = $louveteau*100/$total_jeune;
        $eclai_pourcent = $eclaireur*100/$total_jeune;
        $chemin_pourcent = $cheminot*100/$total_jeune;
        $rout_pourcent = $routier*100/$total_jeune;
        $jeune_porcent = $total_jeune*100/$nombre_scout;
        $adulte_pourcent = $total_adulte*100/$nombre_scout;

        // Liste des districts
        $districts = $em->getRepository('AppBundle:District')->findByRegion($slug);

        return $this->render("default/region.html.twig",[
            'regions' => $regions,
            'region' => $region,
            'louveteau' => $louveteau,
            'eclaireur' => $eclaireur,
            'cheminot' => $cheminot,
            'routier' => $routier,
            'loup_pourcent' => $loup_pourcent,
            'eclai_pourcent' => $eclai_pourcent,
            'chemin_pourcent' => $chemin_pourcent,
            'route_pourcent' => $rout_pourcent,
            'total_jeune' => $total_jeune,
            'total_adulte' => $total_adulte,
            'total_scout' => $nombre_scout,
            'jeune_porcent' => $jeune_porcent,
            'adulte_pourcent' => $adulte_pourcent,
            'districts' => $districts,
        ]);
    }
}
