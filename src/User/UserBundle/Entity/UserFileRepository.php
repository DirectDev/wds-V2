<?php

namespace User\UserBundle\Entity;

use Doctrine\ORM\EntityRepository;

class UserFileRepository extends EntityRepository {

    public function findPhotosByLocation($limit = 6, $latitude = null, $longitude = null, $distance = 20) {

        $query = $this->createQueryBuilder('uf')
                ->leftJoin('uf.user', 'u')
                ->leftJoin('u.userTypes', 'ut')
                ->leftJoin('u.addresses', 'a')
                ->setMaxResults($limit)
        ;

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
        $query = $this->createQueryBuilder('uf')
                ->select('COUNT(uf.id)')
                ->leftJoin('uf.user', 'u')
                ->where('u.id = :id')
                ->setParameter('id', $User->getId());
        return $query->getQuery()->getSingleScalarResult();
    }

    public function findForAdmin($locale = 'en') {
        $query = $this->createQueryBuilder('uf');

        return $query->getQuery();
    }

    public function filterAdmin($data, $locale = 'en') {
        $query = $this->createQueryBuilder('uf')
                ->leftJoin('uf.user', 'u')
                ->leftJoin('u.translations', 'ut', 'WITH', 'ut.locale = :locale')
                ->setParameter('locale', $locale)
                ->where("1 = 1");

        if (isset($data["search"])) {
            $orQuery = $query->expr()->orx();
            $orQuery->add($query->expr()->like("u.id", ":search"));
            $orQuery->add($query->expr()->like("u.username", ":search"));
            $orQuery->add($query->expr()->like("u.email", ":search"));
            $orQuery->add($query->expr()->like("u.facebook_id", ":search"));
            $orQuery->add($query->expr()->like("u.google_id", ":search"));
            $orQuery->add($query->expr()->like("u.email", ":search"));
            $orQuery->add($query->expr()->like("ut.description", ":search"));
            $orQuery->add($query->expr()->like("ut.baseline", ":search"));
            $query->andWhere($orQuery);
            $query->setParameter('search', '%' . $data["search"] . '%');
        }

        return $query->getQuery();
    }
    
    public function count() {
        $query = $this->createQueryBuilder('uf')
                ->select('COUNT(uf.id)');
        return $query->getQuery()->getSingleScalarResult();
    }

}
