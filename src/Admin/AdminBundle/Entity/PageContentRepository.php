<?php

namespace Admin\AdminBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * PageContentRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PageContentRepository extends EntityRepository {

    public function findByPage($page) {
        $query = $this->createQueryBuilder('pc')
                ->leftJoin('pc.Page', 'p')
                ->where('p.id LIKE :id')
                ->orderBy("pc.position", "ASC")
                ->setParameter('id', $page->getId())
                ->getQuery();
        return $query->getResult();
    }

}
