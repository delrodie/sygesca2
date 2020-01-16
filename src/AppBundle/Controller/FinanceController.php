<?php

namespace AppBundle\Controller;

use AppBundle\Utilities\GestionCotisation;
use AppBundle\Utilities\GestionScout;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * Class FinanceController
 * @Route("/finance")
 */
class FinanceController extends Controller
{
    /**
     * @Route("/", name="finance_liste")
     */
    public function indexAction(GestionScout $gestionScout, GestionCotisation $gestionCotisation)
    {
        $em = $this->getDoctrine()->getManager();
        if (!$gestionCotisation->generatePrice()) return $this->redirectToRoute('finance_liste');
        $cotisations = $em->getRepository("AppBundle:Cotisation")->findBy(['annee'=>$gestionScout->cotisation()]);

        $montantTotal = $em->getRepository("AppBundle:Cotisation")->calculMontant($gestionScout->cotisation()); //dump($montantTotal);die();

        return $this->render("default/finance.html.twig",[
            'cotisations' => $cotisations,
            'montant' => $montantTotal
        ]);
    }
}
