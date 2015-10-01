<?php

namespace Search\SearchBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Search\SearchBundle\Form\UserFrontSearchType;
use User\UserBundle\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Front\FrontBundle\Entity\City;

class FrontSearchController extends Controller {

    public function UserFrontSearchAction() {

        $request = $this->container->get('request');

        if (!$request->isXmlHttpRequest())
            return new response('', 404);

        $keyword = $request->request->get('keyword');
        if (!$keyword)
            return new response('', 404);

        $em = $this->container->get('doctrine')->getEntityManager();


        $qb = $em->createQueryBuilder();

        $qb->select('u')
                ->from('UserUserBundle:User', 'u')
                ->where("u.username LIKE :keyword")
                ->orderBy('u.username', 'ASC')
                ->setParameter('keyword', '%' . $keyword . '%');

        $query = $qb->getQuery();
        $users = $query->getResult();


        return $this->container->get('templating')->renderResponse('SearchSearchBundle:FrontSearch:userList.html.twig', array('users' => $users));
    }

    public function EventFrontSearchAction(Request $request) {

        $session = $this->getRequest()->getSession();

        $searchcity = $request->query->get('searchcity', '', true);
        if (!$searchcity)
            $searchcity = $session->get('city');

        $searcheventdate = $request->query->get('searcheventdate', '', true);
        if (!$searcheventdate)
            $searcheventdate = $session->get('startdate');

        if (!$searchcity)
            return new response('city error', 404);

        return $this->redirect($this->generateUrl('city_calendar', array('searchcity' => $searchcity, 'searcheventdate' => $searcheventdate)));
    }

}
