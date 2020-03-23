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
        //$cotisations = $em->getRepository("AppBundle:Cotisation")->findBy(['annee'=>$gestionScout->cotisation()]);
        $cotisations = $em->getRepository("AppBundle:Cotisation")->findListGlobal($gestionScout->cotisation());
        
        $montantTotal = $em->getRepository("AppBundle:Cotisation")->calculMontant($gestionScout->cotisation()); //dump($montantTotal);die();

        return $this->render("default/finance.html.twig",[
            'cotisations' => $cotisations,
            'montant' => $montantTotal
        ]);
    }

    /**
     * @Route("/ristroune", name="finance_ristourne")
     */
    public function ristourneAction(GestionScout $gestionScout, GestionCotisation $gestionCotisation)
    {
        $em = $this->getDoctrine()->getManager();
        $annee = $gestionScout->cotisation();
        // Mise a jour de la liste des ristournes
        if (!$gestionCotisation->generatePrice()) return $this->redirectToRoute('finance_ristourne');

        //Calcul du montant total de ristourne
        $ristourneTotal = $em->getRepository('AppBundle:Cotisation')->calculRistourne($annee);
        $inscriptionTotal = $em->getRepository("AppBundle:Cotisation")->calculMontant($annee);
        $ristourneJeune = $em->getRepository("AppBundle:Cotisation")->calculRistourneByType($annee, 200);
        $ristourneChef = $em->getRepository("AppBundle:Cotisation")->calculRistourneByType($annee, 500);
        $ristourneRegion = $em->getRepository("AppBundle:Cotisation")->calculRistourneByType($annee, 700);
        $ristourneRegional = $em->getRepository("AppBundle:Cotisation")->calculRistourneByType($annee, 2000);
        $regions = $em->getRepository("AppBundle:Region")->findOnlyRegion();

        return $this->render('finance/ristourne_globale.html.twig',[
            'regions' => $regions,
            'ristourne_total' => $ristourneTotal,
            'annee' => $annee,
            'inscription_total' => $inscriptionTotal,
            'rsitourne_jeune' => $ristourneJeune,
            'ristourne_chef' => $ristourneChef,
            'ristourne_region' => $ristourneRegion + $ristourneRegional,
        ]);
    }
    /**
     * @Route("/extraction/", name="finance_extraction")
     */
    public function extractionAction(GestionScout $gestionScout, GestionCotisation $gestionCotisation)
    {
        $em = $this->getDoctrine()->getManager();
        if (!$gestionCotisation->generatePrice()) return $this->redirectToRoute('finance_liste');
        //$cotisations = $em->getRepository("AppBundle:Cotisation")->findListGlobal($gestionScout->cotisation());
        $cotisations = $em->getRepository("AppBundle:Cotisation")->findBy(['annee'=>$gestionScout->cotisation()]);

        return $this->render("extraction/rsitourne_globale.html.twig",[
            'cotisations' => $cotisations,
            'annee' => $gestionScout->cotisation()
        ]);
    }

    /**
     * @Route("/{region}/ristourne", name="finance_ristourne_region")
     * @Method("GET")
     */
    public function regionAction(GestionScout $gestionScout, GestionCotisation $gestionCotisation, $region)
    {
        $em = $this->getDoctrine()->getManager();
        $annee = $gestionScout->cotisation();
        // Mise a jour de la liste des ristournes
        //if (!$gestionCotisation->generatePrice()) return $this->redirectToRoute('finance_ristourne');

        //Calcul du montant total de ristourne
        $ristourneTotal = $em->getRepository('AppBundle:Cotisation')->calculRistourne($annee,$region); //dump($ristourneTotal);die();
        $inscriptionTotal = $em->getRepository("AppBundle:Cotisation")->calculMontant($annee,$region);
        $ristourneJeune = $em->getRepository("AppBundle:Cotisation")->calculRistourneByType($annee, 200,$region);
        $ristourneChef = $em->getRepository("AppBundle:Cotisation")->calculRistourneByType($annee, 500,$region);
        $ristourneRegion = $em->getRepository("AppBundle:Cotisation")->calculRistourneByType($annee, 700,$region);
        $ristourneRegional = $em->getRepository("AppBundle:Cotisation")->calculRistourneByType($annee, 2000,$region);
        $regions = $em->getRepository("AppBundle:Region")->findOnlyRegion();

        return $this->render('finance/region_complement.html.twig',[
            'regions' => $regions,
            'ristourne_total' => $ristourneTotal,
            'annee' => $annee,
            'inscription_total' => $inscriptionTotal,
            'ristourne_jeune' => $ristourneJeune,
            'ristourne_chef' => $ristourneChef,
            'ristourne_region' => $ristourneRegion + $ristourneRegional,
        ]);
    }
}
