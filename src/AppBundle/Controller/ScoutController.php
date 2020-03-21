<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Scout;
use AppBundle\Utilities\GestionCotisation;
use AppBundle\Utilities\GestionScout;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;

/**
 * Scout controller.
 *
 * @Route("admin/scout")
 */
class ScoutController extends Controller
{
    /**
     * Lists all scout entities.
     *
     * @Route("/", name="admin_scout_index")
     * @Method("GET")
     */
    public function indexAction(GestionScout $gestionScout)
    {
        $em = $this->getDoctrine()->getManager();$user =$this->getUser();

        // Recueration des roles
        $roles[]=$user->getRoles();
        if ($roles[0][0] =="ROLE_USER"){
            $gestionnaire = $em->getRepository("AppBundle:Gestionnaire")->findOneBy(['user'=>$user]);

            if ($gestionnaire == null){
                throw new AccessDeniedException();
            }else{
                $region = $em->getRepository("AppBundle:Region")->findOneBy(['id'=>$gestionnaire->getRegion()]);
                return $this->redirectToRoute("liste_scout_index",['region'=>$region->getSlug()]);
            }
        }

        //$scouts = $em->getRepository('AppBundle:Scout')->findAll();
        $scouts = $em->getRepository('AppBundle:Scout')->findListGlobal(); //dump($scouts);die();

        return $this->render('scout/index.html.twig', array(
            'scouts' => $scouts,
        ));
    }

    /**
     * Creates a new scout entity.
     *
     * @Route("/new", name="admin_scout_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request, GestionScout $gestionScout, GestionCotisation $gestionCotisation)
    {
        $scout = new Scout();
        $form = $this->createForm('AppBundle\Form\ScoutType', $scout);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $matricule = $gestionScout->matricule($scout->getGroupe());
            $scout->setMatricule($matricule);
            $scout->setCotisation($gestionScout->cotisation());

            // Verification de l'existence du scout dans le système pour cette année scoute
            $existe = $gestionScout->verifExistence($scout->getNom(),$scout->getPrenoms(),$scout->getDatenaiss(),$scout->getLieunaiss());
            if ($existe){
                return $this->redirectToRoute('admin_scout_index');
            }

            $em->persist($scout);
            $em->flush();

            $gestionScout->carte($scout->getId());
            $gestionCotisation->save($scout->getId());

            return $this->redirectToRoute('scout_inscription', [
                'nom' => $scout->getNom(),
                'prenoms'=>$scout->getPrenoms()
            ]);
        }

        return $this->render('scout/new.html.twig', array(
            'scout' => $scout,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a scout entity.
     *
     * @Route("/{slug}", name="admin_scout_show")
     * @Method("GET")
     */
    public function showAction(Scout $scout)
    {
        $deleteForm = $this->createDeleteForm($scout);

        return $this->render('scout/show.html.twig', array(
            'scout' => $scout,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing scout entity.
     *
     * @Route("/{slug}/edit", name="admin_scout_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Scout $scout)
    {
        $deleteForm = $this->createDeleteForm($scout);
        $editForm = $this->createForm('AppBundle\Form\ScoutType', $scout);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_scout_index');

        }

        return $this->render('scout/edit.html.twig', array(
            'scout' => $scout,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a scout entity.
     *
     * @Route("/{id}", name="admin_scout_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Scout $scout)
    {
        $form = $this->createDeleteForm($scout);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($scout);
            $em->flush();
        }

        return $this->redirectToRoute('admin_scout_index');
    }

    /**
     * Creates a form to delete a scout entity.
     *
     * @param Scout $scout The scout entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Scout $scout)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_scout_delete', array('id' => $scout->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
