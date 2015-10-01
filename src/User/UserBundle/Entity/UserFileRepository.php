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



        ;
    }

}
