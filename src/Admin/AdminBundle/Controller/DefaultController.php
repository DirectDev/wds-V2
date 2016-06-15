<?php

namespace Admin\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller {

    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $count_users = $em->getRepository('UserUserBundle:User')->count();
        $count_cities = $em->getRepository('FrontFrontBundle:City')->count();
        $count_addresss = $em->getRepository('FrontFrontBundle:Address')->count();
        $count_events = $em->getRepository('FrontFrontBundle:Event')->count();
        $count_eventdates = $em->getRepository('FrontFrontBundle:EventDate')->count();
        $count_musics = $em->getRepository('FrontFrontBundle:Music')->count();
        $count_videos = $em->getRepository('FrontFrontBundle:Video')->count();

        return $this->render('AdminAdminBundle:Admin:index.html.twig', array(
                    'count_users' => $count_users,
                    'count_cities' => $count_cities,
                    'count_addresss' => $count_addresss,
                    'count_events' => $count_events,
                    'count_eventdates' => $count_eventdates,
                    'count_musics' => $count_musics,
                    'count_videos' => $count_videos,
        ));
    }

}
