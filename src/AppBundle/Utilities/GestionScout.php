<?php


namespace AppBundle\Utilities;


use Doctrine\ORM\EntityManager;

class GestionScout
{
    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    /**
     * Generation du matricule du scout
     */
    public function matricule($groupe)
    {
        // le code de la region
        $region = $this->em->getRepository("AppBundle:Region")->getRegionCode($groupe);

        $matricule = $region.''.$this->code_aleatoire().''.$this->lettre_aleatoire();
        $exist = $this->em->getRepository("AppBundle:Scout")->findOneBy(['matricule'=>$matricule]);
        while ($exist){
            $matricule = $region.''.$this->code_aleatoire().''.$this->lettre_aleatoire();
            $exist = $this->em->getRepository("AppBundle:Scout")->findOneBy(['matricule'=>$matricule]);
        }

        return $matricule;
    }

    /**
     * generation de code aleatoire composant le matricule du scout avec la method mt_rand
     */
    private function code_aleatoire()
    {
        $aleatoire = mt_rand(10000,99999);
        return $aleatoire;
    }

    /**
     * Generation d'une lettre aleatoire composant le maticule du scout
     */
    private function lettre_aleatoire()
    {
        // Liste des lettres de l'alphabet
        $alphabet="ABCDEFGHIJKLMNOPQRSTUVWXYZ";

        // Affectation d'une lettre aleatoire
        $lettre_aleatoire=$alphabet[rand(0,25)];

        return $lettre_aleatoire;
    }
}
