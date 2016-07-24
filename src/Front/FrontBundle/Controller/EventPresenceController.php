<?php

namespace Front\FrontBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Front\FrontBundle\Entity\Event;
use Front\FrontBundle\Entity\EventFile;
use Front\FrontBundle\Form\EventType;
use Front\FrontBundle\Form\EventLinkType;
use Front\FrontBundle\Form\EventDescriptionType;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\Response;

/**
 * Event controller.
 *
 */
class EventPresenceController extends Controller {


    private function createPresenceForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('front_eventpresence_presence', array('id' => $id)))
                        ->setMethod('POST')
                        ->add('submit', 'submit', array(
                            'label' => /** @Ignore */ $this->get('translator')->trans('I go'),
                            'attr' => array(
                                'class' => 'btn-wds2 btn-block presence_button'
                            )
                        ))
                        ->getForm()
        ;
    }

    private function createUnPresenceForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('front_eventpresence_unpresence', array('id' => $id)))
                        ->setMethod('POST')
                        ->add('submit', 'submit', array(
                            'label' => /** @Ignore */ $this->get('translator')->trans("I don't go"),
                            'attr' => array(
                                'class' => 'btn-wds2 btn-block presence_button'
                            )
                        ))
                        ->getForm()
        ;
    }

    public function presenceAction(Request $request, $id) {

        if (!$this->getUser())
            return $this->redirect($this->generateUrl('fos_user_security_login'));

        $form = $this->createPresenceForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('FrontFrontBundle:Event')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Event entity.');
            }
            if (!$entity->getUserPresents()->contains($this->getUser()))
                $entity->addUserPresent($this->getUser());

            $em->persist($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('front_eventpresence_presences', array('id' => $entity->getId())));
    }

    public function unPresenceAction(Request $request, $id) {

        if (!$this->getUser())
            return $this->redirect($this->generateUrl('fos_user_security_login'));

        $form = $this->createUnPresenceForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('FrontFrontBundle:Event')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Event entity.');
            }

            $User = $this->getUser();
            if ($User->getEventpresences()->contains($entity))
                $User->removeEventpresence($entity);

            $em->persist($User);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('front_eventpresence_presences', array('id' => $entity->getId())));
    }

    public function presencesAction($id) {
        $em = $this->getDoctrine()->getManager();

        $event = $em->getRepository('FrontFrontBundle:Event')->find(array('id' => $id));
        if (!$event) {
            throw $this->createNotFoundException('Unable to find Event entity.');
        }

        $presenceForm = $this->createPresenceForm($id);
        $unPresenceForm = $this->createUnPresenceForm($id);

        $usersPresenceEvent = $em->getRepository('UserUserBundle:User')->getUsersPresentsToEvent($event, 8);

        return $this->render('FrontFrontBundle:Event:presences.html.twig', array(
                    'event' => $event,
                    'usersPresenceEvent' => $usersPresenceEvent,
                    'presence_form' => $presenceForm->createView(),
                    'unpresence_form' => $unPresenceForm->createView(),
        ));
    }

}
