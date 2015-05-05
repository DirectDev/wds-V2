<?php

namespace Front\FrontBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Front\FrontBundle\Entity\Address;
use Front\FrontBundle\Form\AddressType;

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
        $entity = new Address();
        $entity->addEvent($event);
        $form = $this->createCreateFormByEvent($entity, $event->getId());
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            try {
                $em->refresh($entity);
                $this->setLatitudeAndLongitude($entity);
                $em->persist($entity);
                $em->flush();
            } catch (\Exception $e) {
                
            }

            $event = $entity->getEvent();
            if ($event)
                return $this->redirect($this->generateUrl('front_event_edit', array('id' => $event->getId(), 'uri' => $event->getURI())));

            return $this->redirect($this->generateUrl('front_address_show', array('id' => $entity->getId())));
        }

        return $this->render('FrontFrontBundle:Address:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Address entity.
     *
     * @param Address $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateFormByEvent(Address $entity, $id) {
        $form = $this->createForm(new AddressType(), $entity, array(
            'action' => $this->generateUrl('front_address_event_create', array('id' => $id)),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => $this->get('translator')->trans('create'), 'attr' => array('class' => 'btn btn-success btn-md pull-right')));

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

        $entity = new Address();
        $entity->addEvent($event);
        $form = $this->createCreateFormByEvent($entity, $event->getId());

        return $this->render('FrontFrontBundle:Address:new.html.twig', array(
                    'entity' => $entity,
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
        $entity = new Address();
        $entity->addUser($user);
        $form = $this->createCreateFormByUser($entity, $user->getId());
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            try {
                $em->refresh($entity);
                $this->setLatitudeAndLongitude($entity);
                $em->persist($entity);
                $em->flush();
            } catch (\Exception $e) {
                
            }

            $user = $entity->getUser();
            if ($user)
                return $this->redirect($this->generateUrl('front_user_show_private', array('id' => $user->getId())));

            return $this->redirect($this->generateUrl('front_address_show', array('id' => $entity->getId())));
        }

        return $this->render('FrontFrontBundle:Address:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Address entity.
     *
     * @param Address $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateFormByUser(Address $entity, $id) {
        $form = $this->createForm(new AddressType(), $entity, array(
            'action' => $this->generateUrl('front_address_user_create', array('id' => $id)),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => $this->get('translator')->trans('create'), 'attr' => array('class' => 'btn btn-success btn-md pull-right')));

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

        $entity = new Address();
        $entity->addUser($user);
        $form = $this->createCreateFormByUser($entity, $user->getId());

        return $this->render('FrontFrontBundle:Address:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Address entity.
     *
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FrontFrontBundle:Address')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Address entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('FrontFrontBundle:Address:show.html.twig', array(
                    'entity' => $entity,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Address entity.
     *
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FrontFrontBundle:Address')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Address entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('FrontFrontBundle:Address:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Address entity.
     *
     * @param Address $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Address $entity) {
        $form = $this->createForm(new AddressType(), $entity, array(
            'action' => $this->generateUrl('front_address_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => $this->get('translator')->trans('update'), 'attr' => array('class' => 'btn btn-success btn-md pull-right')));

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

        $entity = $em->getRepository('FrontFrontBundle:Address')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Address entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {

            try {
                $this->setLatitudeAndLongitude($entity);
                $em->persist($entity);
                $em->flush();
            } catch (\Exception $e) {
                
            }

            $em->flush();

            $event = $entity->getEvent();
            if ($event)
                return $this->redirect($this->generateUrl('front_event_edit', array('id' => $event->getId(), 'uri' => $event->getURI())));

            $user = $entity->getUser();
            if ($user)
                return $this->redirect($this->generateUrl('front_user_show_private', array('id' => $user->getId())));

            return $this->redirect($this->generateUrl('front_address_edit', array('id' => $id)));
        }

        return $this->render('FrontFrontBundle:Address:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Address entity.
     *
     */
    public function deleteAction(Request $request, $id) {

        if (!$this->getUser())
            return $this->redirect($this->generateUrl('fos_user_security_login'));

        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('FrontFrontBundle:Address')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Address entity.');
            }

            $event = $entity->getEvent();
            $user = $entity->getUser();

            $em->remove($entity);
            $em->flush();
        }

        if ($event)
            return $this->redirect($this->generateUrl('front_event_edit', array('id' => $event->getId(), 'uri' => $event->getURI())));

        if ($user)
            return $this->redirect($this->generateUrl('front_user_show_private', array('id' => $user->getId())));

        return $this->redirect($this->generateUrl('front_address'));
    }

    /**
     * Creates a form to delete a Address entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('front_address_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('submit', 'submit', array('label' => $this->get('translator')->trans('delete'), 'attr' => array('class' => 'btn btn-danger btn-sm pull-left')))
                        ->getForm()
        ;
    }

    private function setLatitudeAndLongitude($entity) {
        try {

            if (!$entity OR ! $entity->stringForGoogleMaps())
                return;

            $geocode = $this->container
                    ->get('bazinga_geocoder.geocoder')
                    ->using('google_maps')
                    ->geocode($entity->stringForGoogleMaps());

            $entity->setLatitude($geocode['latitude']);
            $entity->setLongitude($geocode['longitude']);
        } catch (\Exception $e) {
            throw $e;
        }
    }

}
