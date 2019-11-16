<?php

namespace AppBundle\Controller;

use AppBundle\Utilities\GestionScout;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class TotauxController
 * @Route("/totaux")
 */
class TotauxController extends Controller
{
    /**
     * @Route("/{slug}", name="totaux_region")
     * @Method("GET")
     */
    public function totauxAction(Request $request, $slug, GestionScout $gestionScout)
    {
        $em = $this->getDoctrine()->getManager();
        $cotisation = $gestionScout->cotisation();
        $nombre_scout = $em->getRepository("AppBundle:Scout")->getNombreByRegion($slug, $cotisation);
        $total = $em->getRepository("AppBundle:Scout")->getNmbreTotal($cotisation);

        return $this->render('default/nombre.html.twig',[
            'nombre' => $nombre_scout,
        ]);

    }

    /**
     * @Route("/{statut}/{slug}", name="totaux_region_statut")
     * @Method("GET")
     */
    public function statutAction($statut, $slug, GestionScout $gestionScout)
    {
        $em = $this->getDoctrine()->getManager(); //dump($slug);die();
        $total_statut = $em->getRepository("AppBundle:Scout")->getNombreTotalParStatut($statut,$gestionScout->cotisation(), $slug);

        return $this->render('default/nombre.html.twig',[
            'nombre' => $total_statut,
        ]);
    }

    /**
     * @Route("/{sexe}/{slug}/", name="totaux_region_sexe")
     * @Method("GET")
     */
    public function sexeAction($sexe, $slug, GestionScout $gestionScout)
    {
        $em = $this->getDoctrine()->getManager();
        $total_sexe = $em->getRepository("AppBundle:Scout")->getNombreTotalParSexe($gestionScout->cotisation(), $sexe, $slug);

        return $this->render("default/nombre.html.twig",[
            'nombre' => $total_sexe
        ]);
    }
}
