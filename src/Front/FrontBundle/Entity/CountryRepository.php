<?php

namespace Front\FrontBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * CountryRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CountryRepository extends EntityRepository {

    public function findOneByTitle($title = null) {
        if (!$title)
            return;
        $query = $this->createQueryBuilder('c')
                ->leftJoin('c.translations', 'ct')
                ->where("ct.title LIKE :title")
                ->setParameter('title', $title);
        return $query->getQuery()->getOneOrNullResult();
    }

}
