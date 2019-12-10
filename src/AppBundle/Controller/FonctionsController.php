<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Fonctions;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Fonction controller.
 *
 * @Route("admin/fonction")
 */
class FonctionsController extends Controller
{
    /**
     * Lists all fonction entities.
     *
     * @Route("/", name="admin_fonction_index")
     * @Method({"GET", "POST"})
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $fonctions = $em->getRepository('AppBundle:Fonctions')->findAll();
        $fonction = new Fonctions();
        $form = $this->createForm('AppBundle\Form\FonctionsType', $fonction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($fonction);
            $em->flush();

            return $this->redirectToRoute('admin_fonction_index');
        }

        return $this->render('fonctions/index.html.twig', array(
            'fonctions' => $fonctions,
            'fonction' => $fonction,
            'form' => $form->createView(),
        ));
    }

    /**
     * Creates a new fonction entity.
     *
     * @Route("/new", name="admin_fonction_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $fonction = new Fonction();
        $form = $this->createForm('AppBundle\Form\FonctionsType', $fonction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($fonction);
            $em->flush();

            return $this->redirectToRoute('admin_fonction_show', array('id' => $fonction->getId()));
        }

        return $this->render('fonctions/new.html.twig', array(
            'fonction' => $fonction,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a fonction entity.
     *
     * @Route("/{id}", name="admin_fonction_show")
     * @Method("GET")
     */
    public function showAction(Fonctions $fonction)
    {
        $deleteForm = $this->createDeleteForm($fonction);

        return $this->render('fonctions/show.html.twig', array(
            'fonction' => $fonction,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing fonction entity.
     *
     * @Route("/{id}/edit", name="admin_fonction_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Fonctions $fonction)
    {
        $em = $this->getDoctrine()->getManager();

        $fonctions = $em->getRepository('AppBundle:Fonctions')->findAll();
        $deleteForm = $this->createDeleteForm($fonction);
        $editForm = $this->createForm('AppBundle\Form\FonctionsType', $fonction);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_fonction_index');
        }

        // Liste des fonctions
        $scouts = $em->getRepository("AppBundle:Scout")->findBy(['fonction'=>$fonction->getLibelle()]);
        if ($scouts) $suppression = true;
        else $suppression =  null;

        return $this->render('fonctions/edit.html.twig', array(
            'fonction' => $fonction,
            'fonctions' => $fonctions,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'suppression' => $suppression,
        ));
    }

    /**
     * Deletes a fonction entity.
     *
     * @Route("/{id}", name="admin_fonction_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Fonctions $fonction)
    {
        $form = $this->createDeleteForm($fonction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($fonction);
            $em->flush();
        }

        return $this->redirectToRoute('admin_fonction_index');
    }

    /**
     * Creates a form to delete a fonction entity.
     *
     * @param Fonctions $fonction The fonction entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Fonctions $fonction)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_fonction_delete', array('id' => $fonction->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
