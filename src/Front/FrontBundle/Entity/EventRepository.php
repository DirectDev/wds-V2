<?php

namespace Front\FrontBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Front\FrontBundle\Entity\EventType;

/**
 * EventRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class EventRepository extends EntityRepository {

    public function findForCitypages($startdate_only = true, $limit = 6, $eventTypes = null, $musicTypes = null,
            $startdate = null, $stopdate = null, $latitude = null, $longitude = null, $distance = 20, $excludedEvents = array()) {

        if (!$startdate)
            $startdate = date('Y-m-d');
        if (!$stopdate)
            $stopdate = date('Y-m-d', strtotime('+7 days'));
        
        $arrayEventType = array();
        $arraymusicTypes = array();

        $query = $this->createQueryBuilder('e')
                ->leftJoin('e.eventType', 'et')
                ->leftJoin('e.musicTypes', 'mt')
                ->leftJoin('e.eventDates', 'ed')
                ->leftJoin('e.addresses', 'a')
                ->setParameter('startdate', $startdate)
                ->setParameter('stopdate', $stopdate)
                ->orderBy('ed.startdate', 'ASC');
        
        if($startdate_only)
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
        
        if(count($excludedEvents)){
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
        
        
        /* dev*/
//        $query = $this->createQueryBuilder('e')
//                ->setMaxResults(6);
        
        return $query->getQuery()->getResult();



        ;
    }
    

}
