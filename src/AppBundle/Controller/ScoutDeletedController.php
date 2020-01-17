<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ScoutDeleted;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Scoutdeleted controller.
 *
 * @Route("scoutdeleted")
 */
class ScoutDeletedController extends Controller
{
    /**
     * Lists all scoutDeleted entities.
     *
     * @Route("/", name="scoutdeleted_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $scoutDeleteds = $em->getRepository('AppBundle:ScoutDeleted')->findAll();

        return $this->render('scoutdeleted/index.html.twig', array(
            'scoutDeleteds' => $scoutDeleteds,
        ));
    }

    /**
     * Creates a new scoutDeleted entity.
     *
     * @Route("/new", name="scoutdeleted_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $scoutDeleted = new Scoutdeleted();
        $form = $this->createForm('AppBundle\Form\ScoutDeletedType', $scoutDeleted);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($scoutDeleted);
            $em->flush();

            return $this->redirectToRoute('scoutdeleted_show', array('id' => $scoutDeleted->getId()));
        }

        return $this->render('scoutdeleted/new.html.twig', array(
            'scoutDeleted' => $scoutDeleted,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a scoutDeleted entity.
     *
     * @Route("/{id}", name="scoutdeleted_show")
     * @Method("GET")
     */
    public function showAction(ScoutDeleted $scoutDeleted)
    {
        $deleteForm = $this->createDeleteForm($scoutDeleted);

        return $this->render('scoutdeleted/show.html.twig', array(
            'scoutDeleted' => $scoutDeleted,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing scoutDeleted entity.
     *
     * @Route("/{id}/edit", name="scoutdeleted_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ScoutDeleted $scoutDeleted)
    {
        $deleteForm = $this->createDeleteForm($scoutDeleted);
        $editForm = $this->createForm('AppBundle\Form\ScoutDeletedType', $scoutDeleted);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('scoutdeleted_edit', array('id' => $scoutDeleted->getId()));
        }

        return $this->render('scoutdeleted/edit.html.twig', array(
            'scoutDeleted' => $scoutDeleted,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a scoutDeleted entity.
     *
     * @Route("/{id}", name="scoutdeleted_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ScoutDeleted $scoutDeleted)
    {
        $form = $this->createDeleteForm($scoutDeleted);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($scoutDeleted);
            $em->flush();
        }

        return $this->redirectToRoute('scoutdeleted_index');
    }

    /**
     * Creates a form to delete a scoutDeleted entity.
     *
     * @param ScoutDeleted $scoutDeleted The scoutDeleted entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ScoutDeleted $scoutDeleted)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('scoutdeleted_delete', array('id' => $scoutDeleted->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
