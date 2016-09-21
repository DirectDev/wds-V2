<?php

namespace Front\FrontBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Front\FrontBundle\Entity\Address;
use Front\FrontBundle\Form\AddressType;
use Symfony\Component\HttpFoundation\Response;

/**
 * Address controller.
 *
 */
class AddressController extends Controller {

    private function findEvent($id) {
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository('FrontFrontBundle:Event')->find($id);
        if (!$event)
            throw $this->createNotFoundException('Unable to find Event entity.');
        return $event;
    }

    private function findUser($id) {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('UserUserBundle:User')->find($id);
        if (!$user)
            throw $this->createNotFoundException('Unable to find User entity.');
        return $user;
    }

    /**
     * Creates a new Address entity.
     *
     */
    public function createByEventAction(Request $request, $id) {

        if (!$this->getUser())
            return $this->redirect($this->generateUrl('fos_user_security_login'));

        $event = $this->findEvent($id);
        $address = new Address();
        $address->addEvent($event);
        $form = $this->createCreateFormByEvent($address, $event->getId());
        $form->submit($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($address);
            $em->flush();

            try {
                $em->refresh($address);
                $this->setLatitudeAndLongitude($address);
                $em->persist($address);
                $em->flush();
            } catch (\Exception $e) {
                
            }

            $this->get('session')->getFlashBag()->add(
                    'success', $this->get('translator')->trans('form.ffa.flashbags.create')
            );

            return $this->redirect($this->generateUrl('front_address_show_with_buttons', array('id' => $address->getId())));
        }

        return new Response($this->get('translator')->trans('toastr.xhr_error.create_address'), 500);
    }

    /**
     * Creates a form to create a Address entity.
     *
     * @param Address $address The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateFormByEvent(Address $address, $id) {
        $form = $this->createForm(new AddressType(), $address, array(
            'action' => $this->generateUrl('front_address_event_create', array('id' => $id)),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => /** @Ignore */ $this->get('translator')->trans('create')));

        return $form;
    }

    /**
     * Displays a form to create a new Address entity.
     *
     */
    public function newByEventAction($id) {

        if (!$this->getUser())
            return $this->redirect($this->generateUrl('fos_user_security_login'));

        $event = $this->findEvent($id);

        $address = new Address();
        $address->addEvent($event);
        $form = $this->createCreateFormByEvent($address, $event->getId());

        return $this->render('FrontFrontBundle:Address:new.html.twig', array(
                    'address' => $address,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Creates a new Address entity.
     *
     */
    public function createByUserAction(Request $request, $id) {

        if (!$this->getUser())
            return $this->redirect($this->generateUrl('fos_user_security_login'));

        $user = $this->findUser($id);
        $address = new Address();
        $address->addUser($user);
        $form = $this->createCreateFormByUser($address, $user->getId());
        $form->submit($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($address);
            $em->flush();

            try {
                $em->refresh($address);
                $this->setLatitudeAndLongitude($address);
                $em->persist($address);
                $em->flush();
            } catch (\Exception $e) {
                
            }

            $this->get('session')->getFlashBag()->add(
                    'success', $this->get('translator')->trans('form.ffa.flashbags.create')
            );

            return $this->redirect($this->generateUrl('front_address_show_with_buttons', array('id' => $address->getId())));
        }

        return new Response($this->get('translator')->trans('toastr.xhr_error.create_address'), 500);
    }

    /**
     * Creates a form to create a Address entity.
     *
     * @param Address $address The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateFormByUser(Address $address, $id) {
        $form = $this->createForm(new AddressType(), $address, array(
            'action' => $this->generateUrl('front_address_user_create', array('id' => $id)),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => /** @Ignore */ $this->get('translator')->trans('create')));

        return $form;
    }

    /**
     * Displays a form to create a new Address entity.
     *
     */
    public function newByUserAction($id) {

        if (!$this->getUser())
            return $this->redirect($this->generateUrl('fos_user_security_login'));

        $user = $this->findUser($id);

        $address = new Address();
        $address->addUser($user);
        $form = $this->createCreateFormByUser($address, $user->getId());

        return $this->render('FrontFrontBundle:Address:new.html.twig', array(
                    'address' => $address,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Address entity.
     *
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $address = $em->getRepository('FrontFrontBundle:Address')->find($id);

        if (!$address) {
            throw $this->createNotFoundException('Unable to find Address entity.');
        }

        return $this->render('FrontFrontBundle:Address:show.html.twig', array(
                    'address' => $address,
        ));
    }

    public function showWithButtonsAction($id) {
        $em = $this->getDoctrine()->getManager();

        $address = $em->getRepository('FrontFrontBundle:Address')->find($id);

        if (!$address) {
            throw $this->createNotFoundException('Unable to find Address entity.');
        }

        return $this->render('FrontFrontBundle:Address:showWithButtons.html.twig', array(
                    'address' => $address,
        ));
    }

    /**
     * Displays a form to edit an existing Address entity.
     *
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $address = $em->getRepository('FrontFrontBundle:Address')->find($id);

        if (!$address) {
            throw $this->createNotFoundException('Unable to find Address entity.');
        }

        if (!$this->getUser() or $address->getUser() != $this->getUser())
            return new Response('', 403);

        $editForm = $this->createEditForm($address);

        return $this->render('FrontFrontBundle:Address:edit.html.twig', array(
                    'address' => $address,
                    'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Address entity.
     *
     * @param Address $address The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Address $address) {
        $form = $this->createForm(new AddressType(), $address, array(
            'action' => $this->generateUrl('front_address_update', array('id' => $address->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => /** @Ignore */ $this->get('translator')->trans('update')));

        return $form;
    }

    /**
     * Edits an existing Address entity.
     *
     */
    public function updateAction(Request $request, $id) {

        if (!$this->getUser())
            return $this->redirect($this->generateUrl('fos_user_security_login'));

        $em = $this->getDoctrine()->getManager();

        $address = $em->getRepository('FrontFrontBundle:Address')->find($id);

        if (!$address) {
            throw $this->createNotFoundException('Unable to find Address entity.');
        }

        if (!$this->getUser() or $address->getUser() != $this->getUser())
            return new Response('', 403);

        $editForm = $this->createEditForm($address);
        $editForm->submit($request);

        if ($editForm->isValid()) {

            try {
                $this->setLatitudeAndLongitude($address);
                $em->persist($address);
                $em->flush();
            } catch (\Exception $e) {
                
            }

            $em->flush();

            $this->get('session')->getFlashBag()->add(
                    'success', $this->get('translator')->trans('form.ffa.flashbags.update')
            );

        }
        else
             $this->get('session')->getFlashBag()->add(
                    'error', $this->get('translator')->trans('form.ffa.flashbags.error')
            );

        return $this->redirect($this->generateUrl('front_address_show_with_buttons', array('id' => $id)));

    }

    /**
     * Deletes a Address entity.
     *
     */
    public function deleteAction(Request $request, $id) {

        if (!$this->getUser())
            return $this->redirect($this->generateUrl('fos_user_security_login'));

        $em = $this->getDoctrine()->getManager();
        $address = $em->getRepository('FrontFrontBundle:Address')->find($id);

        if (!$address) {
            throw $this->createNotFoundException('Unable to find Address entity.');
        }

        $event = $address->getEvent();
        $user = $address->getUser();

        if ($user && $user != $this->getUser()) {
            throw $this->createNotFoundException('Error : not yours.');
        }
        if ($event && $event->getUser() != $this->getUser()) {
            throw $this->createNotFoundException('Error : not yours.');
        }

        $em->remove($address);
        $em->flush();

        return new Response(/** @Ignore */ $this->get('translator')->trans('toastr.xhr_success.delete_address'), 200);
    }

    private function setLatitudeAndLongitude($address = null) {
        if (!$address)
            return;
        try {

            if (!$address OR ! $address->stringForGoogleMaps())
                return;

            $geocodeAddresses = $this->container
                    ->get('bazinga_geocoder.geocoder')
                    ->using('google_maps')
                    ->geocode($address->stringForGoogleMaps());

            if (!count($geocodeAddresses))
                return;

            foreach ($geocodeAddresses as $geocodeAddress) {
                $address->setLatitude($geocodeAddress->getLatitude());
                $address->setLongitude($geocodeAddress->getLongitude());
                return;
            }
        } catch (\Exception $e) {
            throw $e;
        }
    }

}
