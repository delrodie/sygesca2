<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Scout;
use AppBundle\Utilities\GestionEpuration;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * Class EpurationController
 * @Route("/epuration")
 */
class EpurationController extends Controller
{
    /**
     * @Route("/", name="epuration_index")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $scouts = $em->getRepository("AppBundle:Scout")->findExistMore();

        return $this->render('default/epuration.html.twig', [
            'scouts' => $scouts,
        ]);
    }

    /**
     * @Route("/{id}", name="epuration_delete")
     * @Method("GET")
     */
    public function deleteDoublonAction(Scout $scout, GestionEpuration $gestionEpuration)
    {
        //$em = $this->getDoctrine()->getManager();
        //$scouts = $em->getRepository("AppBundle:Scout")->findDoublon(); //dump($scout);die();

        if ($gestionEpuration->deleteScout($scout->getId())){
            $this->addFlash('notice', "Doublon supprimé avec succès!");
            return $this->redirectToRoute('epuration_index');
        }else{
            $this->addFlash('error', "Erreur de suppression.");
            return $this->redirectToRoute('epuration_index');
        }
    }
}
