<?php


namespace AppBundle\Utilities;


use Doctrine\ORM\EntityManager;

class GestionCinetpay
{
    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    /**
     * Verification d'exist
     */
}
