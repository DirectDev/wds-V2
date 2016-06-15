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

    public function findForAdmin($locale = 'en') {
        $query = $this->createQueryBuilder('pc')
                ->leftJoin('pc.translations', 'pct', 'WITH', 'pct.locale = :locale')
                ->setParameter('locale', $locale);

        return $query->getQuery();
    }

    public function filterAdmin($data, $locale = 'en') {
        $query = $this->createQueryBuilder('pc')
                ->leftJoin('pc.translations', 'pct', 'WITH', 'pct.locale = :locale')
                ->leftJoin('pc.Page', 'p')
                ->leftJoin('p.translations', 'pt', 'WITH', 'pt.locale = :locale')
                ->setParameter('locale', $locale)
                ->where("1 = 1");

        if (isset($data["search"])) {
            $orQuery = $query->expr()->orx();
            $orQuery->add($query->expr()->like("pc.position", ":search"));
            $orQuery->add($query->expr()->like("p.name", ":search"));
            $orQuery->add($query->expr()->like("pt.title", ":search"));
            $orQuery->add($query->expr()->like("pt.description", ":search"));
            $orQuery->add($query->expr()->like("pt.content", ":search"));
            $orQuery->add($query->expr()->like("pct.content", ":search"));
            $query->andWhere($orQuery);
            $query->setParameter('search', '%' . $data["search"] . '%');
        }

        return $query->getQuery();
    }

}
