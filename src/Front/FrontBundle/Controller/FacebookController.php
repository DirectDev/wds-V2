<?php

namespace Front\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class FacebookController extends Controller {

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
