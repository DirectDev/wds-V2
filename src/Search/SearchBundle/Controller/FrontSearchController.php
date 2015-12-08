<?php

namespace Search\SearchBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Search\SearchBundle\Form\UserFrontSearchType;
use User\UserBundle\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Front\FrontBundle\Entity\City;

class FrontSearchController extends Controller {

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
