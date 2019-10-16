<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Cotisation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Cotisation controller.
 *
 * @Route("admin/cotisation")
 */
class CotisationController extends Controller
{
    /**
     * Lists all cotisation entities.
     *
     * @Route("/", name="admin_cotisation_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $cotisations = $em->getRepository('AppBundle:Cotisation')->findAll();

        return $this->render('cotisation/index.html.twig', array(
            'cotisations' => $cotisations,
        ));
    }

    /**
     * Finds and displays a cotisation entity.
     *
     * @Route("/{id}", name="admin_cotisation_show")
     * @Method("GET")
     */
    public function showAction(Cotisation $cotisation)
    {

        return $this->render('cotisation/show.html.twig', array(
            'cotisation' => $cotisation,
        ));
    }
}
