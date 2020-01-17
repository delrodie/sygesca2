<?php


namespace AppBundle\Utilities;


use AppBundle\Entity\ScoutDeleted;
use Doctrine\ORM\EntityManager;

class GestionEpuration
{
    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    /**
     * @param $id
     * @return bool
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function deleteScout($id)
    {
        $scoutDeleted = $this->createScoutDeleted($id);
        if (!$scoutDeleted){ return false;}
        else{
            // Suppression de la ligne
            $cotisation = $this->em->getRepository("AppBundle:Cotisation")->findOneBy(['scout'=>$id]);
            $this->em->remove($cotisation);
            $this->em->flush();

            // Suppression du scout
            $scout = $this->em->getRepository('AppBundle:Scout')->findOneBy(['id'=>$id]);
            $this->em->remove($scout);
            $this->em->flush();

            return true;
        }

    }

    /**
     * @param $id
     * @return bool
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function createScoutDeleted($id)
    {
        $scoutDeleted = new ScoutDeleted();
        $date = \Date('Y-m-d H:i:s');
        $scout = $this->em->getRepository("AppBundle:Scout")->findOneBy(['id'=>$id]);
        $cotisationEntity = $this->em->getRepository("AppBundle:Cotisation")->findOneBy(['scout'=>$id]);
        if (!$scout){
            return false;
        }else{
            $scoutDeleted->setMatricule($scout->getMatricule());
            $scoutDeleted->setNom($scout->getNom());
            $scoutDeleted->setPrenoms($scout->getPrenoms());
            $scoutDeleted->setDatenaiss($scout->getDatenaiss());
            $scoutDeleted->setLieunaiss($scout->getLieunaiss());
            $scoutDeleted->setSexe($scout->getSexe());
            $scoutDeleted->setBranche($scout->getBranche());
            $scoutDeleted->setFonction($scout->getFonction());
            $scoutDeleted->setContact($scout->getContact());
            $scoutDeleted->setContactParent($scout->getContactParent());
            $scoutDeleted->setEmail($scout->getEmail());
            $scoutDeleted->setCarte($scout->getCarte());
            $scoutDeleted->setCotisation($scout->getCotisation());
            $scoutDeleted->setUrgence($scout->getUrgence());
            $scoutDeleted->setPublieLe($scout->getPublieLe());
            $scoutDeleted->setSlug($scout->getSlug());
            $scoutDeleted->setStatut($scout->getStatut()->getLibelle());
            $scoutDeleted->setGroupe($scout->getGroupe()->getParoisse());
            $scoutDeleted->setDistrict($scout->getGroupe()->getDistrict()->getNom());
            $scoutDeleted->setRegion($scout->getGroupe()->getDistrict()->getRegion()->getNom());
            $scoutDeleted->setMontant($cotisationEntity->getMontant());
            $scoutDeleted->setMontantSansFrais($cotisationEntity->getMontantSansFrais());
            $scoutDeleted->setRistourne($cotisationEntity->getRistourne());
            $scoutDeleted->setSupprimeLe($date);
            //dump($scoutDeleted);die();
            $this->em->persist($scoutDeleted);
            $this->em->flush();

            return true;
        }
    }
}
