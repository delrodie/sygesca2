<?php


namespace AppBundle\Repository;


use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{

    /**
     * UserController:indexAction
     * @return array
     */
    public function findList()
    {
        return $this->createQueryBuilder('u')
            ->where('u.username <> :user')
            ->orderBy('u.username', 'ASC')
            ->setParameter('user', 'delrodie')
            ->getQuery()->getResult()
            ;
    }
}
