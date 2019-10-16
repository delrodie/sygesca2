<?php


namespace AppBundle\Utilities;


use Cassandra\Date;
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

    /**
     * Année de cotisation du scout
     */
    public function cotisation()
    {
        $mois_encours = Date('m', time());
        if ($mois_encours > 9){
            $debut_annee = Date('Y', time());
            $fin_annee = Date('Y', time())+1;
            //$an = Date('y', time())+1;
        }else{
            $debut_annee = Date('Y', time())-1;
            $fin_annee = Date('Y', time());
            //$an = Date('y', time());
        }

        $annee = $debut_annee.'-'.$fin_annee;

        return $annee;
    }

    /**
     * generation du numero de la carte du scout
     */
    public function carte($id)
    {
        $mois_encours = Date('m', time());
        if ($mois_encours > 9){
            $an = Date('y', time())+1;
        }else{
            $an = Date('y', time());
        }

        if ($id < 10){
            $num = '0000'.$id;
        }elseif($id < 100){
            $num = '000'.$id;
        }elseif ($id < 1000){
            $num = '00'.$id;
        }elseif ($id < 10000){
            $num = '0'.$id;
        }else{
            $num = $id;
        }

        $scout = $this->em->getRepository("AppBundle:Scout")->findOneBy(['id'=>$id]);
        $code = $this->em->getRepository("AppBundle:Region")->getRegionCode($scout->getGroupe()->getId());

        $carte = $code.''.$an.'-'.$num;

        $scout->setCarte($carte);
        $this->em->flush();

        return true;

    }
}
