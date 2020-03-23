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
    public function save($scoutID, $montant = null)
    {
        $cotisation = new Cotisation();
        $annee = $this->gestionScout->cotisation();
        $scout = $this->em->getRepository("AppBundle:Scout")->findOneBy(['id'=>$scoutID, 'cotisation'=>$annee]);

        // Si le scout est un jeune alors affecté la branche à la fonction
        $statut = $scout->getStatut()->getLibelle();
        if ($statut == 'Jeune'){
            $cotisation->setFonction($scout->getBranche());
        }else{
            $cotisation->setFonction($scout->getFonction());
        }
        $cotisation->setAnnee($annee);
        $cotisation->setScout($scout);
        $cotisation->setCarte($scout->getCarte());
        $cotisation->setMontant($montant);

        $this->em->persist($cotisation);
        $this->em->flush();

        return true;
    }

    public function generatePrice()
    {
        $cotisations = $this->em->getRepository('AppBundle:Cotisation')->findBySansRistourne();
        $finishTime = time() + 25;
        foreach($cotisations as $cotisation){
            $execTime = time();
            $string = $this->switcFonction($cotisation->getFonction());
            if ($string === 'CONSEIL NATIONAL DES AINES') $string = 'AINES';
            $fonction = $this->em->getRepository("AppBundle:Fonctions")->findOneBy(['libelle'=>$string]);
            if (!$fonction)dump($cotisation);die();
            $montant = $fonction->getMontant();

            $ristourne = $fonction->getRistourne();
            $cotisation->setMontantSansFrais($montant);
            $cotisation->setRistourne($ristourne); //dump($cotisation);die();
            $this->em->flush();
            if ($execTime >= $finishTime) return false;
        }

        return true;
    }

    private function switcFonction($string)
    {
        switch ($string){
            case 'LOUVETEAU (8 - 11 ANS)':
                $fonction = "LOUVETEAU (8 - 11 ANS)";
                break;
            case 'ECLAIREUR (12 - 14 ANS)':
                $fonction = "ECLAIREUR (12 - 14 ANS)";
                break;
            case 'CHEMINOT (15 - 17 ANS)':
                $fonction = "CHEMINOT (15 - 17 ANS)";
                break;
            case 'ROUTIER (18 - 21 ANS)':
                $fonction = "ROUTIER (18 - 21 ANS)";
                break;
            case "ASSISTANT CHEF D'UNITE (ACU)":
                $fonction = "ASSISTANT CHEF D'UNITE (ACU)";
                break;
            case "ASSISTANT CHEF DE GROUPE":
                $fonction = "ASSISTANT CHEF DE GROUPE (ACG)";
                break;
            case "ASSISTANT CHEF DE GROUPE (ACG)":
                $fonction = "ASSISTANT CHEF DE GROUPE (ACG)";
                break;
            case "ASSISTANT COMMISSAIRE DE DISTRICT":
                $fonction = "ASSISTANT COMMISSAIRE DE DISTRICT (ACD)";
                break;
            case "ASSISTANT COMMISSAIRE DE DISTRICT (ACD)":
                $fonction = "ASSISTANT COMMISSAIRE DE DISTRICT (ACD)";
                break;
            case "ASSISTANT COMMISSAIRE NATIONAL":
                $fonction = "ASSISTANT COMMISSAIRE NATIONAL (ACN)";
                break;
            case "ASSISTANT COMMISSAIRE NATIONAL (ACN)":
                $fonction = "ASSISTANT COMMISSAIRE NATIONAL (ACN)";
                break;
            case "ASSISTANT COMMISSAIRE REGIONAL":
                $fonction = "ASSISTANT COMMISSAIRE REGIONAL (ACR)";
                break;
            case "ASSISTANT COMMISSAIRE REGIONAL (ACR)":
                $fonction = "ASSISTANT COMMISSAIRE REGIONAL (ACR)";
                break;
            case "AUMONIER DE DISTRICT":
                $fonction = "AUMONIER DE DISTRICT";
                break;
            case "AUMONIER DE GROUPE":
                $fonction = "AUMONIER DE GROUPE";
                break;
            case "AUMONIER REGIONAL":
                $fonction = "AUMONIER REGIONAL";
                break;
            case "AUMÔNIER NATIONAL":
                $fonction = "AUMÔNIER NATIONAL";
                break;
            case "CHEF D'UNITE (CU)":
                $fonction = "CHEF D'UNITE (CU)";
                break;
            case "CHEF D'UNITE ADJOINT (CUA)":
                $fonction = "CHEF D'UNITE ADJOINT (CUA)";
                break;
            case "Chef de groupe":
                $fonction = "CHEF DE GROUPE (CG)";
                break;
            case "CHEF DE GROUPE (CG)":
                $fonction = "CHEF DE GROUPE (CG)";
                break;
            case "CHEF DE GROUPE ADJOINT":
                $fonction = "CHEF DE GROUPE ADJOINT (CGA)";
                break;
            case "CHEF DE GROUPE ADJOINT (CGA)":
                $fonction = "CHEF DE GROUPE ADJOINT (CGA)";
                break;
            case "COMITE NATIONAL DE DIRECTION (CND)":
                $fonction = "COMITE NATIONAL DE DIRECTION (CND)";
                break;
            case "COMMISSAIRE AUX COMPTES":
                $fonction = "COMMISSAIRE AUX COMPTES";
                break;
            case "COMMISSAIRE DE DISTRICT":
                $fonction = "COMMISSAIRE DE DISTRICT (CD)";
                break;
            case "COMMISSAIRE DE DISTRICT (CD)":
                $fonction = "COMMISSAIRE DE DISTRICT (CD)";
                break;
            case "COMMISSAIRE DE DISTRICT ADJOINT":
                $fonction = "COMMISSAIRE DE DISTRICT ADJOINT (CDA)";
                break;
            case "COMMISSAIRE DE DISTRICT ADJOINT (CDA)":
                $fonction = "COMMISSAIRE DE DISTRICT ADJOINT (CDA)";
                break;
            case "COMMISSAIRE NATIONAL":
                $fonction = "COMMISSAIRE NATIONAL (CN)";
                break;
            case "COMMISSAIRE NATIONAL ADJOINT (CNA)":
                $fonction = "COMMISSAIRE NATIONAL ADJOINT (CNA)";
                break;
            case "Commissaire REgional":
                $fonction = "COMMISSAIRE REGIONAL (CR)";
                break;
            case "Commissaire Regional":
                $fonction = "COMMISSAIRE REGIONAL (CR)";
                break;
            case "COMMISSAIRE REGIONAL (CR)":
                $fonction = "COMMISSAIRE REGIONAL (CR)";
                break;
            case "Commissaire Regional Adjoint":
                $fonction = "COMMISSAIRE REGIONAL ADJOINT (CRA)";
                break;
            case "COMMISSAIRE REGIONAL ADJOINT (CRA)":
                $fonction = "COMMISSAIRE REGIONAL ADJOINT (CRA)";
                break;
            case "CONSEIL NATIONAL DES AINES":
                $fonction = "CONSEIL NATIONAL DES AINES";
                break;
            case "CONSEILLER":
                $fonction = "CONSEILLER";
                break;
            case "EQUIPE TECHNIQUE":
                $fonction = "EQUIPE TECHNIQUE";
                break;
            case "SYMPATHISANT":
                $fonction = "SYMPATHISANT (PARRAIN, MARRAINE, CONSEILLERS, ANCIEN CHEF)";
                break;
            case "SYMPATHISANT (PARRAIN, MARRAINE, CONSEILLERS, ANCIEN CHEF)":
                $fonction = "SYMPATHISANT (PARRAIN, MARRAINE, CONSEILLERS, ANCIEN CHEF)";
                break;
            default:
                $fonction = "SYMPATHISANT (PARRAIN, MARRAINE, CONSEILLERS, ANCIEN CHEF)";
                break;
        }

        return $fonction;
    }
}
