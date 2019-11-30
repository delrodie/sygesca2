<?php

namespace AppBundle\Controller;

use AppBundle\Utilities\GestionScout;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class RegScoutController
 * @Route("/liste-scout")
 */
class RegScoutController extends Controller
{
    /**
     * @Route("/{region}", name="liste_scout_index")
     */
    public function indexAction(Request $request, GestionScout $gestionScout)
    {
        $em = $this->getDoctrine()->getManager();
        $slug = $request->get('region'); //dump($slug);die();
        if (!$slug){
            $region = null;
        }else{
            $region = $em->getRepository("AppBundle:Region")->findOneBy(['slug'=>$slug]);
        }

        $scouts = $em->getRepository('AppBundle:Scout')->findByRegion($gestionScout->cotisation(),$slug);

        return $this->render('regions/scout_list.html.twig', array(
            'scouts' => $scouts,
        ));
    }

    /**
     * @Route("/{slug}/", name="liste_scout_show")
     * @Method({"GET","POST"})
     */
    public function showAction($slug)
    {
        $em = $this->getDoctrine()->getManager();
        $scout = $em->getRepository("AppBundle:Scout")->findOneBy(['slug'=>$slug]);

        return $this->render("regions/scout_show.html.twig",[
            'scout' => $scout
        ]);
    }

    /**
     * @Route("/carte/{matricule}", name="liste_scout_carte")
     * @Method({"GET","POST"})
     */
    public function carteAction($matricule)
    {
        $em = $this->getDoctrine()->getManager();
        $scout = $em->getRepository("AppBundle:Scout")->findOneBy(['matricule'=>$matricule]);
        if (!$scout){
            $message = "Votre carte provisoire n'est pas encore disponible. Veuillez ressaisir les informations requises ou
							prière vous inscrire.";
            return $this->render("default/404.html.twig",['message'=>$message]);
        }
        return $this->render('regions/carte.html.twig',[
            'scout'=>$scout,
        ]);
    }
}
