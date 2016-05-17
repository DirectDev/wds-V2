<?php

namespace Front\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class FacebookController extends Controller {

    public function importEventPageAction(Request $request) {

        $em = $this->getDoctrine()->getManager();

        $page = $this->getDoctrine()->getRepository('AdminAdminBundle:Page')->findOneByName('facebook-import-event');
        if (!$page)
            throw new \Exception('Page not found!');

        $user = $this->getUser();

        return $this->render('FrontFrontBundle:Facebook:importEvent.html.twig', array(
                    'page' => $page,
                    'user' => $user,
        ));
    }

    public function previewImportEventsAction(Request $request) {

        $em = $this->getDoctrine()->getManager();

        $user = $this->getUser();
        
        // besoin de se connecter avec un compte fb d'abord

        $facebookServices = $this->get('facebook.services');
        $facebook_events = $facebookServices->previewImportEvents();

        return $this->render('FrontFrontBundle:Facebook:previewImportEvents.html.twig', array(
                    'user' => $user,
                    'facebook_events' => $facebook_events,
        ));
    }
    
    public function importEventsAction(Request $request) {

        $em = $this->getDoctrine()->getManager();

        $user = $this->getUser();
        
        $ids = explode(',',$request->get('ids'));
        dump($ids);
        
        // besoin de se connecter avec un compte fb d'abord

        $facebookServices = $this->get('facebook.services');
        $events = $facebookServices->importEvents($ids);

        return $this->render('FrontFrontBundle:Facebook:importedEvents.html.twig', array(
                    'user' => $user,
                    'events' => $events,
        ));
    }

    public function testAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();

        // besoin de se connecter avec un compte fb d'abord

        $facebookServices = $this->get('facebook.services');
//        $facebookServices->importEvent('1599833447000034');
//        $facebookServices->importEvent('1597645500474602');
        $facebookServices->importEvents();

        return new Response('test facebook', 200);
    }

}
