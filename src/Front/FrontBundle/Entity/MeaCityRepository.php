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
                ->setMaxResults($limit)
                ->orderBy('mc.ordre');

        return $query->getQuery()->getResult();
    }

    public function findForDiscover($limit = 3) {
        $query = $this->createQueryBuilder('mc')
                ->where('(mc.salsaDiscover = 1 OR mc.bachataDiscover = 1 OR mc.kizombaDiscover = 1)')
                ->orderBy('mc.ordre')
                ->setMaxResults($limit);

        return $query->getQuery()->getResult();
    }

    public function findForLearn($limit = 3) {
        $query = $this->createQueryBuilder('mc')
                ->where('(mc.salsaLearn = 1 OR mc.bachataLearn = 1 OR mc.kizombaLearn = 1)')
                ->orderBy('mc.ordre')
                ->setMaxResults($limit);

        return $query->getQuery()->getResult();
    }

    public function findForMeet($limit = 3) {
        $query = $this->createQueryBuilder('mc')
                ->where('(mc.salsaMeet = 1 OR mc.bachataMeet = 1 OR mc.kizombaMeet = 1)')
                ->orderBy('mc.ordre')
                ->setMaxResults($limit);

        return $query->getQuery()->getResult();
    }

    public function findForAdmin($locale = 'en') {
        $query = $this->createQueryBuilder('mc')
                ->leftJoin('mc.translations', 'mct', 'WITH', 'mct.locale = :locale')
                ->orderBy('mc.ordre')
                ->setParameter('locale', $locale);

        return $query->getQuery();
    }

    public function filterAdmin($data, $locale = 'en') {
        $query = $this->createQueryBuilder('mc')
                ->leftJoin('mc.translations', 'mct', 'WITH', 'mct.locale = :locale')
                ->orderBy('mc.ordre')
                ->leftJoin('mc.city', 'mcc')
                ->setParameter('locale', $locale)
                ->where("1 = 1");

        if (isset($data["search"])) {
            $orQuery = $query->expr()->orx();
            $orQuery->add($query->expr()->like("mct.description", ":search"));
            $orQuery->add($query->expr()->like("mct.edito", ":search"));
            $orQuery->add($query->expr()->like("mcc.name", ":search"));
            $query->andWhere($orQuery);
            $query->setParameter('search', '%' . $data["search"] . '%');
        }

        return $query->getQuery();
    }

    public function count() {
        $query = $this->createQueryBuilder('mc')
                ->select('COUNT(mc.id)');
        return $query->getQuery()->getSingleScalarResult();
    }

}
