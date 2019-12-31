<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Objectif;
use AppBundle\Utilities\GestionScout;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Objectif controller.
 *
 * @Route("admin/objectif")
 */
class ObjectifController extends Controller
{
    /**
     * Lists all objectif entities.
     *
     * @Route("/", name="admin_objectif_index")
     * @Method({"GET", "POST"})
     */
    public function indexAction(Request $request, GestionScout $gestionScout)
    {
        $em = $this->getDoctrine()->getManager();
        $objectif = new Objectif();
        $form = $this->createForm('AppBundle\Form\ObjectifType', $objectif);
        $form->handleRequest($request);

        $annee = $gestionScout->cotisation();

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $objectif->setAnnee($annee);
            //Si l'objectif de la region de cette année a été definit alors return false
            $verifExist = $em->getRepository("AppBundle:Objectif")->findOneBy(['region'=>$objectif->getRegion(),'annee'=>$annee]);
            if ($verifExist){
                $this->addFlash('error',"L'objectif de l'année de cette region a déjà été defini.");
                return $this->redirectToRoute("admin_objectif_index");
            }
            $em->persist($objectif);
            $em->flush();

            return $this->redirectToRoute('admin_objectif_index');
        }
        $objectifs = $em->getRepository('AppBundle:Objectif')->findBy(['annee'=>$annee]);

        return $this->render('objectif/index.html.twig', array(
            'objectifs' => $objectifs,
            'objectif' => $objectif,
            'form' => $form->createView(),
            'annee' => $annee
        ));
    }

    /**
     * Creates a new objectif entity.
     *
     * @Route("/new", name="admin_objectif_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $objectif = new Objectif();
        $form = $this->createForm('AppBundle\Form\ObjectifType', $objectif);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($objectif);
            $em->flush();

            return $this->redirectToRoute('objectif_show', array('id' => $objectif->getId()));
        }

        return $this->render('objectif/new.html.twig', array(
            'objectif' => $objectif,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a objectif entity.
     *
     * @Route("/{id}", name="admin_objectif_show")
     * @Method("GET")
     */
    public function showAction(Objectif $objectif)
    {
        $deleteForm = $this->createDeleteForm($objectif);

        return $this->render('objectif/show.html.twig', array(
            'objectif' => $objectif,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing objectif entity.
     *
     * @Route("/{id}/edit", name="admin_objectif_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Objectif $objectif, GestionScout $gestionScout)
    {
        $em = $this->getDoctrine()->getManager();
        $deleteForm = $this->createDeleteForm($objectif);
        $editForm = $this->createForm('AppBundle\Form\ObjectifType', $objectif);
        $editForm->handleRequest($request);

        $annee = $gestionScout->cotisation();

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_objectif_index');
        }
        $objectifs = $em->getRepository('AppBundle:Objectif')->findBy(['annee'=>$annee]);

        return $this->render('objectif/edit.html.twig', array(
            'objectifs' => $objectifs,
            'objectif' => $objectif,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'annee'=>$annee
        ));
    }

    /**
     * Deletes a objectif entity.
     *
     * @Route("/{id}", name="admin_objectif_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Objectif $objectif)
    {
        $form = $this->createDeleteForm($objectif);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($objectif);
            $em->flush();
        }

        return $this->redirectToRoute('admin_objectif_index');
    }

    /**
     * Creates a form to delete a objectif entity.
     *
     * @param Objectif $objectif The objectif entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Objectif $objectif)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_objectif_delete', array('id' => $objectif->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
