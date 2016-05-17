<?php

namespace Front\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Front\FrontBundle\Form\FacebookEventImportType;

class FacebookController extends Controller {

    public function importEventPageAction(Request $request) {

        $em = $this->getDoctrine()->getManager();

        $page = $this->getDoctrine()->getRepository('AdminAdminBundle:Page')->findOneByName('facebook-import-event');
        if (!$page)
            throw new \Exception('Page not found!');

        $user = $this->getUser();

        $facebookEventImportForm = $this->createFacebookEventImportForm();

        return $this->render('FrontFrontBundle:Facebook:importEvent.html.twig', array(
                    'page' => $page,
                    'user' => $user,
                    'facebookEventImportForm' => $facebookEventImportForm->createView(),
        ));
    }

    public function previewImportEventsAction(Request $request) {

        $em = $this->getDoctrine()->getManager();

        $user = $this->getUser();

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

        $ids = explode(',', $request->get('ids'));

        $facebookServices = $this->get('facebook.services');
        $events = $facebookServices->importEvents($ids);

        return $this->render('FrontFrontBundle:Facebook:importedEvents.html.twig', array(
                    'user' => $user,
                    'events' => $events,
        ));
    }

    private function createFacebookEventImportForm() {
        $form = $this->createForm(new FacebookEventImportType(), null, array(
            'action' => $this->generateUrl('facebook_preview_import_event'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => /** @Ignore */ $this->get('translator')->trans('preview'), 'attr' => array('class' => 'btn-u pull-right')));


        return $form;
    }

    public function previewImportEventAction(Request $request) {

        $em = $this->getDoctrine()->getManager();

        $user = $this->getUser();

        $facebookEventImportForm = $this->createFacebookEventImportForm();
        $facebookEventImportForm->handleRequest($request);

        if ($facebookEventImportForm->isValid()) {
            $data = $facebookEventImportForm->getData();
            $facebook_event_id = $this->getIdFromText($data['url']);
        }

        $facebook_events = array();
        if ($facebook_event_id) {
            $facebookServices = $this->get('facebook.services');
            $facebook_events = $facebookServices->previewImportEvent($facebook_event_id);
        }

        return $this->render('FrontFrontBundle:Facebook:previewImportEvents.html.twig', array(
                    'user' => $user,
                    'facebook_events' => $facebook_events,
                    'facebookEventImportForm' => $facebookEventImportForm->createView(),
        ));
    }

    private function getIdFromText($fulltext) {
        trim($fulltext);
        if (is_numeric($fulltext) and strlen($fulltext) >= 15)
            return $fulltext;
        $tab = explode('/', $fulltext);
        foreach ($tab as $text) {
            if (is_numeric($text) and strlen($text) >= 15)
                return $text;
        }
        return null;
    }

//    public function testAction(Request $request) {
//
//        $em = $this->getDoctrine()->getManager();
//        $session = $this->getRequest()->getSession();
//
//        // besoin de se connecter avec un compte fb d'abord
//
//        $facebookServices = $this->get('facebook.services');
//        $facebookServices->importEvent('1599833447000034');
//        $facebookServices->importEvent('1597645500474602');
//        $facebookServices->importEvents();
//
//        return new Response('test facebook', 200);
//    }
}
