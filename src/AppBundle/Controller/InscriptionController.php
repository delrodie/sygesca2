<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Scout;
use AppBundle\Utilities\GestionCotisation;
use AppBundle\Utilities\GestionScout;
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
     * @Route("/inscription/", name="scout_inscription")
     * @Method({"GET","POST"})
     */
    public function inscriptionAction(Request $request, GestionScout $gestionScout, GestionCotisation $gestionCotisation)
    {
        $em = $this->getDoctrine()->getManager();
        if ($request->getMethod() == 'POST'){
            $x = $request->request->get('k');
            //dump($x);
            for ($i=1;$i<=$x;$i++){

                $scout = new Scout();

                $nom = $request->request->get('nom'.$i);
                $prenom = $request->request->get('prenom'.$i);
                $age = $request->request->get('age'.$i);
                $sexe = $request->request->get('sexe'.$i);
                $groupe = $request->request->get('groupe'.$i);
                $statutID = $request->request->get('statut'.$i);
                $date = $request->request->get('date'.$i);
                $lieu = $request->request->get('lieu'.$i);
                $contact = $request->request->get('contact'.$i);
                $parent = $request->request->get('parent'.$i);
                $email = $request->request->get('email'.$i);
                $branche = $request->request->get('branche'.$i);
                $fonction = $request->request->get('fonction'.$i);

                $statut = $em->getRepository("AppBundle:Statut")->findOneBy(['id'=>$statutID]);
                $paroisse = $em->getRepository("AppBundle:Groupe")->findOneBy(['id'=>$groupe]);

                $matricule = $gestionScout->matricule($groupe);
                $scout->setCotisation($gestionScout->cotisation());
                $scout->setMatricule($matricule);
                $scout->setNom($nom);
                $scout->setPrenoms($prenom);
                $scout->setDatenaiss($date);
                $scout->setSexe($sexe);
                $scout->setStatut($statut);
                $scout->setLieunaiss($lieu);
                $scout->setContact($contact);
                $scout->setContactParent($parent);
                $scout->setEmail($email);
                $scout->setBranche($branche);
                $scout->setFonction($fonction);
                $scout->setGroupe($paroisse);

                $em->persist($scout);
                $em->flush();

                $gestionScout->carte($scout->getId());
                $gestionCotisation->save($scout->getId());
            }
        }
        return $this->redirectToRoute('admin_scout_index');
    }

    /**
     * @Route("/carte/{matricule}", name="scout_carte")
     * @Method({"GET","POST"})
     */
    public function carteAction(Request $request, $matricule)
    {
        $em = $this->getDoctrine()->getManager();
        $scout = $em->getRepository("AppBundle:Scout")->findOneBy(['matricule'=>$matricule]);
        if (!$scout){
            return $this->render("default/404.html.twig");
        }
        return $this->render('default/carte.html.twig',[
            'scout'=>$scout,
        ]);
    }

}
