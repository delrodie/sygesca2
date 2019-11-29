<?php

namespace AppBundle\Repository;

/**
 * RegionRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class RegionRepository extends \Doctrine\ORM\EntityRepository
{
    public function liste()
    {
        return $this->createQueryBuilder('r')->orderBy('r.nom','ASC');
    }

    /**
     * Liste des regions  spécifiques
     */
    public function findOnlyRegion()
    {
        return $this->createQueryBuilder('r')
                    ->where('r.id BETWEEN 1 AND 20')
                    ->getQuery()->getResult()
            ;
    }

    /**
     * Fonction de recherche du code de la region par l'Id du groupe
     */
    public function getRegionCode($groupe)
    {
        $em = $this->getEntityManager();
        $qb = $em->createQuery(' 
                    SELECT  r.code as code 
                    FROM AppBundle:Groupe g 
                    JOIN  g.district d 
                    JOIN d.region r 
                    WHERE  g.id = :id
        ')->setParameter('id', $groupe);

        try {
            $code = $qb->getSingleResult();
            foreach ($code as $key => $value) {
                return $value;
            }

        } catch (NoResultException $e) {
            return $e;
        }
    }

    public function getRegionNombre()
    {
        return $this->createQueryBuilder('r')
                    ->select('count(r.id)')
                    ->where('r.id BETWEEN 4 AND 18')
                    ->getQuery()->getSingleScalarResult()
            ;
    }
}
