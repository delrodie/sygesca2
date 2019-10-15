<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class InscriptionController
 * @Route("/scout")
 */
class InscriptionController extends Controller
{
    /**
     * @Route("/", name="scout_index")
     */
    public function indexAction()
    {
        return $this->render('default/formulaire.html.twig');
    }

    /**
     * Inscription par cinetpay
     *
     * @Route("/inscription/[scout]", name="scout_inscription")
     * @Method({"GET","POST"})
     */
    public function inscriptionAction(Request $request, $scout)
    {
        $scouts = $request->get('scout'); dump($scouts);die();
    }
}
