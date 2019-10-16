<?php


namespace AppBundle\Utilities;

use AppBundle\Entity\Cotisation;
use Doctrine\ORM\EntityManager;

/**
 * Class GestionCotisation
 */
class GestionCotisation
{
    public function __construct(EntityManager $entityManager, GestionScout $gestionScout)
    {
        $this->em = $entityManager;
        $this->gestionScout = $gestionScout;
    }

    /**
     * Enregistrement de la cotisation du scout
     */
    public function save($scoutID)
    {
        $cotisation = new Cotisation();
        $annee = $this->gestionScout->cotisation();
        $scout = $this->em->getRepository("AppBundle:Scout")->findOneBy(['id'=>$scoutID, 'cotisation'=>$annee]);

        // Si le scout est un jeune alors affecté la branche à la fonction
        $statut = $scout->getStatut()->getLibelle();
        if ($statut === 'Jeune'){
            $cotisation->setFonction($scout->getBranche());
        }else{
            $cotisation->setFonction($scout->getFonction());
        }
        $cotisation->setAnnee($annee);
        $cotisation->setScout($scout);
        $cotisation->setCarte($scout->getCarte());

        $this->em->persist($cotisation);
        $this->em->flush();

        return true;
    }
}
