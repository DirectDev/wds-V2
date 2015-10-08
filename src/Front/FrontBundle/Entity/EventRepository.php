<?php

namespace Front\FrontBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Front\FrontBundle\Entity\EventType;
use User\UserBundle\Entity\User;

/**
 * EventRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class EventRepository extends EntityRepository {

    public function findForCitypages($startdate_only = true, $limit = 6, $eventTypes = null, $musicTypes = null, $startdate = null, $stopdate = null, $latitude = null, $longitude = null, $distance = 20, $excludedEvents = array()) {

        if (!$startdate)
            $startdate = date('Y-m-d');
        if (!$stopdate)
            $stopdate = date('Y-m-d', strtotime('+7 days'));

        $arrayEventType = array();
        $arraymusicTypes = array();

        $query = $this->createQueryBuilder('e')
                ->leftJoin('e.eventTypes', 'et')
                ->leftJoin('e.musicTypes', 'mt')
                ->leftJoin('e.eventDates', 'ed')
                ->leftJoin('e.addresses', 'a')
                ->setParameter('startdate', $startdate)
                ->setParameter('stopdate', $stopdate)
                ->orderBy('ed.startdate', 'ASC')
                ->groupBy('e.id, ed.startdate')
                ->setMaxResults($limit);

        if ($startdate_only)
            $query->where('((
                    (ed.startdate <= :startdate AND ed.stopdate >= :startdate) 
                    OR (ed.startdate < :stopdate AND ed.stopdate >= :stopdate)
                    OR (ed.startdate >= :startdate AND ed.stopdate <= :stopdate)
                    )
                    OR ( ed.stopdate IS NULL AND ed.startdate = :startdate ))');
        else
            $query->where('((
                    (ed.startdate <= :startdate AND ed.stopdate >= :startdate) 
                    OR (ed.startdate < :stopdate AND ed.stopdate >= :stopdate)
                    OR (ed.startdate >= :startdate AND ed.stopdate <= :stopdate)
                    )
                    OR ( ed.stopdate IS NULL AND ed.startdate >= :startdate AND ed.startdate <= :stopdate))');

        if ($eventTypes && count($eventTypes)) {
            foreach ($eventTypes as $eventType)
                $arrayEventType [] = $eventType->getId();

            $query->andWhere($query->expr()->in('et.id', $arrayEventType));
        }

        if ($musicTypes && count($musicTypes)) {
            foreach ($musicTypes as $musicType)
                $arraymusicTypes [] = $musicType->getId();

            $query->andWhere($query->expr()->in('mt.id', $arraymusicTypes));
        }

        if (count($excludedEvents)) {
            $toExclude = array();
            foreach ($excludedEvents as $event)
                $toExclude[] = $event->getId();
            $query->andWhere($query->expr()->notIn('e.id', $toExclude));
        }

        /* Geocode */
        $query->andWhere("(3958*3.1415926*sqrt((a.latitude - :latitude)*(a.latitude - :latitude)
                + cos(a.latitude/57.29578)*cos(:latitude/57.29578)*(a.longitude - :longitude)*(a.longitude-:longitude))/180)
                <= :distance")
                ->setParameter('latitude', $latitude)
                ->setParameter('longitude', $longitude)
                ->setParameter('distance', $distance);
        /* Geocode */


        /* dev */
//        $query = $this->createQueryBuilder('e')
//                ->setMaxResults(6);

        return $query->getQuery()->getResult();



        ;
    }

    public function countForCitypages($startdate = null, $latitude = null, $longitude = null, $distance = 20) {

        if (!$startdate)
            $startdate = date('Y-m-d');

        $query = $this->createQueryBuilder('e')
                ->select('COUNT(e.id)')
                ->leftJoin('e.eventDates', 'ed')
                ->leftJoin('e.addresses', 'a')
                ->setParameter('startdate', $startdate)
                ->orderBy('ed.startdate', 'ASC')
                ->where('ed.startdate >= :startdate');


        /* Geocode */
        $query->andWhere("(3958*3.1415926*sqrt((a.latitude - :latitude)*(a.latitude - :latitude)
                + cos(a.latitude/57.29578)*cos(:latitude/57.29578)*(a.longitude - :longitude)*(a.longitude-:longitude))/180)
                <= :distance")
                ->setParameter('latitude', $latitude)
                ->setParameter('longitude', $longitude)
                ->setParameter('distance', $distance);
        /* Geocode */

        return $query->getQuery()->getSingleScalarResult();
    }

    public function countByUser(\User\UserBundle\Entity\User $User) {
        $query = $this->createQueryBuilder('e')
                ->select('COUNT(e.id)')
                ->leftJoin('e.user', 'u')
                ->where('u.id = :id')
                ->setParameter('id', $User->getId());
        return $query->getQuery()->getSingleScalarResult();
    }

    public function getNextEventByUser(User $user, $limit = 6, $startdate = null, $stopdate = null) {

        if (!$startdate)
            $startdate = date('Y-m-d');
        if (!$stopdate)
            $stopdate = date('Y-m-d', strtotime('+365 days'));

        $query = $this->createQueryBuilder('e')
                        ->leftJoin('e.user', 'u')
                        ->leftJoin('e.eventDates', 'ed')
                        ->setParameter('startdate', $startdate)
                        ->setParameter('stopdate', $stopdate)
                        ->setParameter('id', $user->getId())
                        ->orderBy('ed.startdate', 'ASC')
                        ->groupBy('e.id, ed.startdate')
                        ->setMaxResults($limit)
                        ->where('u.id = :id')->andWhere('((
                    (ed.startdate <= :startdate AND ed.stopdate >= :startdate) 
                    OR (ed.startdate < :stopdate AND ed.stopdate >= :stopdate)
                    OR (ed.startdate >= :startdate AND ed.stopdate <= :stopdate)
                    )
                    OR ( ed.stopdate IS NULL AND ed.startdate >= :startdate AND ed.startdate <= :stopdate))');

        return $query->getQuery()->getResult();
    }

}
