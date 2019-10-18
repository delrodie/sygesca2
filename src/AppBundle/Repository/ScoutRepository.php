<?php

namespace AppBundle\Repository;

/**
 * ScoutRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ScoutRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * Generation du code composant le matricule du scout
     * Avec la methode mt_rand(10000000,99999999)
     *
     * Author: Delrodie AMOIKON
     * Since: v1.0 | 27/02/2017
     */
    public function generationCode()
    {

        // Affectation a code la valeur aleatoire generée
        $matricule = mt_rand(1000, 9999);

        return $matricule;
    }

    /**
     * Géneration d'une lettre aleatoire composant le matricule du scout
     *
     * Author: Delrodie AMOIKON
     * Since Version v1.0 | 27/02/2017
     */
    public function generationLettre()
    {
        // Liste des lettres de l'alphabet
        $alphabet="ABCDEFGHIJKLMNOPQRSTUVWXYZ";

        // Affectation d'une lettre aleatoire
        $lettre_aleatoire=$alphabet[rand(0,25)];

        return $lettre_aleatoire;
    }
}