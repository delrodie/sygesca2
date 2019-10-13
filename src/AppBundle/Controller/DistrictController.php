<?php

namespace AppBundle\Controller;

use AppBundle\Entity\District;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * District controller.
 *
 * @Route("admin/district")
 */
class DistrictController extends Controller
{
    /**
     * Lists all district entities.
     *
     * @Route("/", name="admin_district_index")
     * @Method({"GET", "POST"})
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $districts = $em->getRepository('AppBundle:District')->findAll();
        $district = new District();
        $form = $this->createForm('AppBundle\Form\DistrictType', $district);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($district);
            $em->flush();

            return $this->redirectToRoute('admin_district_index');
        }

        return $this->render('district/index.html.twig', array(
            'districts' => $districts,
            'district' => $district,
            'form' => $form->createView(),
        ));
    }

    /**
     * Creates a new district entity.
     *
     * @Route("/new", name="admin_district_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $district = new District();
        $form = $this->createForm('AppBundle\Form\DistrictType', $district);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($district);
            $em->flush();

            return $this->redirectToRoute('admin_district_show', array('id' => $district->getId()));
        }

        return $this->render('district/new.html.twig', array(
            'district' => $district,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a district entity.
     *
     * @Route("/{id}", name="admin_district_show")
     * @Method("GET")
     */
    public function showAction(District $district)
    {
        $deleteForm = $this->createDeleteForm($district);

        return $this->render('district/show.html.twig', array(
            'district' => $district,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing district entity.
     *
     * @Route("/{slug}/edit", name="admin_district_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, District $district)
    {
        $em = $this->getDoctrine()->getManager();

        $districts = $em->getRepository('AppBundle:District')->findAll();
        $deleteForm = $this->createDeleteForm($district);
        $editForm = $this->createForm('AppBundle\Form\DistrictType', $district);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_district_index');
        }

        return $this->render('district/edit.html.twig', array(
            'district' => $district,
            'districts' => $districts,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a district entity.
     *
     * @Route("/{id}", name="admin_district_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, District $district)
    {
        $form = $this->createDeleteForm($district);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($district);
            $em->flush();
        }

        return $this->redirectToRoute('admin_district_index');
    }

    /**
     * Creates a form to delete a district entity.
     *
     * @param District $district The district entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(District $district)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_district_delete', array('id' => $district->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
