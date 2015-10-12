<?php

namespace Front\FrontBundle\Entity;

/**
 * MeaCityRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class MeaCityRepository extends \Doctrine\ORM\EntityRepository {

    public function findForHomePage($limit = 3) {
        $query = $this->createQueryBuilder('mc')
                ->setMaxResults($limit);

        return $query->getQuery()->getResult();
    }

}