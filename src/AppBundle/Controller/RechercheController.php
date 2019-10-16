<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class RechercheController
 * @Route("/recherche")
 */
class RechercheController extends Controller
{
    /**
     * @Route("/", name="recherche_index")
     */
    public function indexAction()
    {
        return $this->render('default/recherche.html.twig');
    }

    /**
     * @Route("/carte", name="recherche_carte")
     * @Method({"GET","POST"})
     */
    public function carteAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        if ($request->getMethod() == 'POST'){
            $matricule = $request->get('matricule');
            $scout = $em->getRepository("AppBundle:Scout")->findOneBy(['matricule'=>$matricule]);

            if (!$scout){
                return $this->render("default/404.html.twig");
            }

            return $this->render("default/carte.html.twig", [
                'scout'=> $scout,
            ]);
        }

        return $this->render("default/404.html.twig");
    }
}
