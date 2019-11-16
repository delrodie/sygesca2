<?php

namespace AppBundle\Repository;

/**
 * DistrictRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class DistrictRepository extends \Doctrine\ORM\EntityRepository
{
    public function liste()
    {
        return $this->createQueryBuilder('d')->orderBy('d.nom', 'ASC');
    }

    public function findByRegion($slug)
    {
        return $this->createQueryBuilder('d')
                    ->leftJoin('d.region', 'r')
                    ->where('r.slug = :region')
                    ->orderBy('d.nom', 'ASC')
                    ->setParameter('region', $slug)
                    ->getQuery()->getResult()
            ;
    }
}
