<?php

namespace Front\FrontBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * VideoRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class VideoRepository extends EntityRepository {

    public function findVideosByLocation($limit = 6, $latitude = null, $longitude = null, $distance = 20) {

        $query = $this->createQueryBuilder('v')
                ->leftJoin('v.user', 'u')
                ->leftJoin('u.addresses', 'a')
                ->setMaxResults($limit);

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
        $query = $this->createQueryBuilder('v')
                ->select('COUNT(v.id)')
                ->leftJoin('v.user', 'u')
                ->where('u.id = :id')
                ->setParameter('id', $User->getId());
        return $query->getQuery()->getSingleScalarResult();
    }

    public function filter($data, $locale = 'en') {
        $query = $this->createQueryBuilder('v')
                ->leftJoin('v.translations', 'vt', 'WITH', 'vt.locale = :locale')
                ->leftJoin('v.user', 'u')
                ->leftJoin('v.tags', 't')
                ->leftJoin('t.translations', 'tt', 'WITH', 'tt.locale = :locale')
                ->setParameter('locale', $locale)
                ->where("1 = 1");

        if (isset($data["search"])) {
            $orQuery = $query->expr()->orx();
            $orQuery->add($query->expr()->like("v.name", ":search"));
            $orQuery->add($query->expr()->like("vt.title", ":search"));
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

}
