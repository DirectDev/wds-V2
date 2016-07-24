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
class EventLoveController extends Controller {


    private function createLoveForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('front_eventlove_love', array('id' => $id)))
                        ->setMethod('POST')
                        ->add('submit', 'submit', array(
                            'label' => /** @Ignore */ $this->get('translator')->trans('I Like'),
                            'attr' => array(
                                'class' => 'btn-wds2 btn-block love_button'
                            )
                        ))
                        ->getForm()
        ;
    }

    private function createUnLoveForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('front_eventlove_unlove', array('id' => $id)))
                        ->setMethod('POST')
                        ->add('submit', 'submit', array(
                            'label' => /** @Ignore */ $this->get('translator')->trans("I don't like"),
                            'attr' => array(
                                'class' => 'btn-wds2 btn-block love_button'
                            )
                        ))
                        ->getForm()
        ;
    }

    public function loveAction(Request $request, $id) {

        if (!$this->getUser())
            return $this->redirect($this->generateUrl('fos_user_security_login'));

        $form = $this->createLoveForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('FrontFrontBundle:Event')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Event entity.');
            }
            if (!$entity->getLovesMe()->contains($this->getUser()))
                $entity->addLovesMe($this->getUser());

            $em->persist($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('front_eventlove_loves', array('id' => $entity->getId())));
    }

    public function unLoveAction(Request $request, $id) {

        if (!$this->getUser())
            return $this->redirect($this->generateUrl('fos_user_security_login'));

        $form = $this->createUnLoveForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('FrontFrontBundle:Event')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Event entity.');
            }

            $User = $this->getUser();
            if ($User->getEventloves()->contains($entity))
                $User->removeEventlove($entity);

            $em->persist($User);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('front_eventlove_loves', array('id' => $entity->getId())));
    }

    public function lovesAction($id) {
        $em = $this->getDoctrine()->getManager();

        $event = $em->getRepository('FrontFrontBundle:Event')->find(array('id' => $id));
        if (!$event) {
            throw $this->createNotFoundException('Unable to find Event entity.');
        }

        $loveForm = $this->createLoveForm($id);
        $unLoveForm = $this->createUnLoveForm($id);

        $usersLoveEvent = $em->getRepository('UserUserBundle:User')->getUsersLoveEvent($event, 8);

        return $this->render('FrontFrontBundle:Event:loves.html.twig', array(
                    'event' => $event,
                    'usersLoveEvent' => $usersLoveEvent,
                    'love_form' => $loveForm->createView(),
                    'unlove_form' => $unLoveForm->createView(),
        ));
    }

}
