<?php

namespace Front\FrontBundle\Services;

use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;
use User\UserBundle\Entity\User;

class DisplayCountersServices {

    private $em;
    private $container;

    function __construct(EntityManager $em, Container $container) {
        $this->em = $em;
        $this->container = $container;
    }

    public function updateUserDisplayCounter(User $User) {
        $User->incrementDisplayCounter();
        $this->em->persist($User);
        $this->em->flush();
    }

}
