<?php

namespace Front\FrontBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * MusicRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class MusicRepository extends EntityRepository {

    public function findMusicsByLocation($limit = 6, $latitude = null, $longitude = null, $distance = 20) {

        $query = $this->createQueryBuilder('m')
                ->leftJoin('m.user', 'u')
                ->leftJoin('u.addresses', 'a')
                ->setMaxResults($limit)
                ->orderBy('m.id', 'DESC');

        /* Geocode */
        $query->andWhere("(3958*3.1415926*sqrt((a.latitude - :latitude)*(a.latitude - :latitude)
                + cos(a.latitude/57.29578)*cos(:latitude/57.29578)*(a.longitude - :longitude)*(a.longitude-:longitude))/180)
                <= :distance")
                ->setParameter('latitude', $latitude)
                ->setParameter('longitude', $longitude)
                ->setParameter('distance', $distance);
        /* Geocode */

        $result = $query->getQuery()->getResult();
        shuffle($result);
        return $result;
    }

    public function countByUser(\User\UserBundle\Entity\User $User) {
        $query = $this->createQueryBuilder('m')
                ->select('COUNT(m.id)')
                ->leftJoin('m.user', 'u')
                ->where('u.id = :id')
                ->setParameter('id', $User->getId());
        return $query->getQuery()->getSingleScalarResult();
    }

    public function count() {
        $query = $this->createQueryBuilder('m')
                ->select('COUNT(m.id)');
        return $query->getQuery()->getSingleScalarResult();
    }

    public function findForMusicIndex() {
        $query = $this->createQueryBuilder('m')
                ->leftJoin('m.user', 'u')
                ->leftJoin('m.tags', 't');
        // order by count loves

        return $query->getQuery();
    }

    public function filter($data, $locale = 'en', $sort = 'm.id', $order = 'DESC') {
        $query = $this->createQueryBuilder('m')
                ->leftJoin('m.translations', 'mt', 'WITH', 'mt.locale = :locale')
                ->leftJoin('m.user', 'u')
                ->leftJoin('m.tags', 't')
                ->leftJoin('t.translations', 'tt', 'WITH', 'tt.locale = :locale')
                ->setParameter('locale', $locale)
                ->where("1 = 1")
                ->orderBy($sort, $order);

        if (isset($data["search"])) {
            $orQuery = $query->expr()->orx();
            $orQuery->add($query->expr()->like("m.name", ":search"));
            $orQuery->add($query->expr()->like("mt.title", ":search"));
            $orQuery->add($query->expr()->like("t.name", ":search"));
            $orQuery->add($query->expr()->like("tt.title", ":search"));
            $orQuery->add($query->expr()->like("u.username", ":search"));
            $query->andWhere($orQuery);
            $query->setParameter('search', '%' . $data["search"] . '%');
        }

        if (isset($data["tag"])) {
            $orQuery = $query->expr()->orx();
            $orQuery->add($query->expr()->like("t.name", ":tag"));
            $orQuery->add($query->expr()->like("tt.title", ":tag"));
            $query->andWhere($orQuery);
            $query->setParameter('tag', '%' . $data["tag"] . '%');
        }

        if (isset($data["user"])) {
            $orQuery = $query->expr()->orx();
            $orQuery->add($query->expr()->like("u.username", ":user"));
            $orQuery->add($query->expr()->like("u.id", ":user"));
            $query->andWhere($orQuery);
            $query->setParameter('user', '%' . $data["user"] . '%');
        }

        // order by count loves

        return $query->getQuery();
    }

    public function findForAdmin($locale = 'en') {
        $query = $this->createQueryBuilder('m')
                ->leftJoin('m.translations', 'mt', 'WITH', 'mt.locale = :locale')
                ->setParameter('locale', $locale);

        return $query->getQuery();
    }

    public function filterAdmin($data, $locale = 'en') {
        $query = $this->createQueryBuilder('m')
                ->leftJoin('m.translations', 'mt', 'WITH', 'mt.locale = :locale')
                ->leftJoin('m.tags', 'mta')
                ->leftJoin('mta.translations', 'mtat', 'WITH', 'mtat.locale = :locale')
                ->setParameter('locale', $locale)
                ->where("1 = 1");

        if (isset($data["search"])) {
            $orQuery = $query->expr()->orx();
            $orQuery->add($query->expr()->like("m.name", ":search"));
            $orQuery->add($query->expr()->like("m.url", ":search"));
            $orQuery->add($query->expr()->like("mt.title", ":search"));
            $orQuery->add($query->expr()->like("mta.name", ":search"));
            $orQuery->add($query->expr()->like("mtat.title", ":search"));
            $query->andWhere($orQuery);
            $query->setParameter('search', '%' . $data["search"] . '%');
        }

        return $query->getQuery();
    }

}
