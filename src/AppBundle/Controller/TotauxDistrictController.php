<?php

namespace AppBundle\Controller;

use AppBundle\Utilities\GestionScout;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * Class TotauxDistrictController
 * @Route("/totaux-district")
 */
class TotauxDistrictController extends Controller
{
    /**
     * @Route("/{slug}", name="totaux_district")
     * @Method("GET")
     */
    public function indexAction($slug, GestionScout $gestionScout)
    {
        $em = $this->getDoctrine()->getManager();
        $nombre_scout = $em->getRepository("AppBundle:Scout")->getNombreByDistrict($slug, $gestionScout->cotisation());

        return $this->render('default/nombre.html.twig',[
            'nombre' => $nombre_scout,
        ]);
    }

    /**
     * @Route("/{statut}/{slug}", name="totaux_district_statut")
     * @Method("GET")
     */
    public function statutAction($statut,$slug, GestionScout $gestionScout)
    {
        $em = $this->getDoctrine()->getManager();
        $nombre_scout = $em->getRepository("AppBundle:Scout")->getNombreByDistrictStatut($slug,$statut,$gestionScout->cotisation());

        return $this->render('default/nombre.html.twig',[
            'nombre' => $nombre_scout,
        ]);
    }

    /**
     * @Route("/{sexe}/{slug}/", name="totaux_district_sexe")
     * @Method("GET")
     */
    public function sexeAction($sexe,$slug, GestionScout $gestionScout)
    {
        $em = $this->getDoctrine()->getManager();
        $nombre_scout = $em->getRepository("AppBundle:Scout")->getNombreByDistrictSexe($slug,$sexe,$gestionScout->cotisation());

        return $this->render('default/nombre.html.twig',[
            'nombre' => $nombre_scout,
        ]);
    }
}
