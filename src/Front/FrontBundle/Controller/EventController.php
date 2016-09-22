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
class EventController extends Controller {

    /**
     * Creates a new Event entity.
     *
     */
    public function createAction(Request $request) {
        if (!$this->getUser())
            return $this->redirect($this->generateUrl('fos_user_security_login'));

        $entity = new Event();
        $form = $this->createCreateForm($entity);
        $form->submit($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $entity->setName($this->slugify($entity->getTitle()));
            $entity->setUser($this->getUser());
            $entity->setPublishedBy($this->getUser());

            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                    'success', $this->get('translator')->trans('form.ffe.flashbags.create')
            );

            return $this->redirect($this->generateUrl('front_event_edit_addresses', array('id' => $entity->getId(), 'uri' => $entity->getURI())));
        } 
        else
            $this->get('session')->getFlashBag()->add(
                    'error', $this->get('translator')->trans('form.ffe.flashbags.error')
            );

        return $this->render('FrontFrontBundle:Event:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Event entity.
     *
     * @param Event $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Event $entity) {

        $securityContext = $this->container->get('security.context');
        $form = $this->createForm(new EventType($securityContext), $entity, array(
            'action' => $this->generateUrl('front_event_create'),
            'method' => 'POST',
            'attr' => array('locale' => $this->get('request')->getLocale())
        ));

        $form->add('submit', 'submit', array('label' => /** @Ignore */ $this->get('translator')->trans('Continue')));

        return $form;
    }

    /**
     * Displays a form to create a new Event entity.
     *
     */
    public function newAction() {
        if (!$this->getUser())
            return $this->redirect($this->generateUrl('fos_user_security_login'));


        $entity = new Event();
        $form = $this->createCreateForm($entity);

        return $this->render('FrontFrontBundle:Event:new.html.twig', array(
                    'entity' => $entity,
                    'edit_description_form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Event entity.
     *
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $event = $em->getRepository('FrontFrontBundle:Event')->find(array('id' => $id));
        if (!$event) {
            throw $this->createNotFoundException('Unable to find Event entity.');
        }

        return $this->render('FrontFrontBundle:Event:show.html.twig', array(
                    'event' => $event,
        ));
    }

//    /**
//     * Displays a form to edit an existing Event entity.
//     *
//     */
//    public function editAction($id) {
//        if (!$this->getUser())
//            return $this->redirect($this->generateUrl('fos_user_security_login'));
//
//        $em = $this->getDoctrine()->getManager();
//
//        $entity = $em->getRepository('FrontFrontBundle:Event')->find($id);
//
//        if (!$entity) {
//            throw $this->createNotFoundException('Unable to find Event entity.');
//        }
//
//        if (!$this->getUser() or !$entity->allowModificationByUser($this->getUser()))
//                return $this->redirect($this->generateUrl('fos_user_security_login'));
//
//        $editForm = $this->createEditForm($entity);
//        $editLinkForm = $this->createEditLinkForm($entity);
//        $editDescriptionForm = $this->createEditDescriptionForm($entity);
//
//        /*
//         * UPLOAD FILE FORM
//         * remplacer le User par entite souhaitee
//         * ajouter au render
//          'editId' => $editId,
//          'existingFiles' => $existingFiles,
//         * ajouter fonction handleFiles
//         *
//         */
//        $editId = $this->getRequest()->get('editId');
//        $arrayFile = $this->handleFiles($entity, $this->getRequest()->get('editId'));
//        $editId = $arrayFile ['editId'];
//        $existingFiles = $arrayFile ['existingFiles'];
//        /*
//         * UPLOAD FILE FORM END
//         */
//
//        return $this->render('FrontFrontBundle:Event:edit.html.twig', array(
//                    'event' => $entity,
//                    'edit_form' => $editForm->createView(),
//                    'edit_link_form' => $editLinkForm->createView(),
//                    'edit_description_form' => $editDescriptionForm->createView(),
//                    'editId' => $editId,
//                    'existingFiles' => $existingFiles,
//        ));
//    }

    /**
     * Displays a form to edit an existing Event entity.
     *
     */
    public function editAction($id) {
        if (!$this->getUser())
            return $this->redirect($this->generateUrl('fos_user_security_login'));

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FrontFrontBundle:Event')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Event entity.');
        }

        if (!$this->getUser() or !$entity->allowModificationByUser($this->getUser()))
                return $this->redirect($this->generateUrl('fos_user_security_login'));

        if($entity->getOrganizedBy() == $this->getUser())
            $entity->setFormFilledByOrganizator(true);

        $editDescriptionForm = $this->createEditDescriptionForm($entity);

        return $this->render('FrontFrontBundle:Event:editDescription.html.twig', array(
                    'event' => $entity,
                    'edit_description_form' => $editDescriptionForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Event entity.
     *
     */
    public function editDatesAction($id) {
        if (!$this->getUser())
            return $this->redirect($this->generateUrl('fos_user_security_login'));

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FrontFrontBundle:Event')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Event entity.');
        }

        if (!$this->getUser() or !$entity->allowModificationByUser($this->getUser()))
                return $this->redirect($this->generateUrl('fos_user_security_login'));

        return $this->render('FrontFrontBundle:Event:editDates.html.twig', array(
                    'event' => $entity,
        ));
    }

    /**
     * Displays a form to edit an existing Event entity.
     *
     */
    public function editLinksAction($id) {
        if (!$this->getUser())
            return $this->redirect($this->generateUrl('fos_user_security_login'));

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FrontFrontBundle:Event')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Event entity.');
        }

        if (!$this->getUser() or !$entity->allowModificationByUser($this->getUser()))
                return $this->redirect($this->generateUrl('fos_user_security_login'));

        $editLinkForm = $this->createEditLinkForm($entity);

        return $this->render('FrontFrontBundle:Event:editLinks.html.twig', array(
                    'event' => $entity,
                    'edit_link_form' => $editLinkForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Event entity.
     *
     */
    public function editAddressesAction(Request $request, $id) {
        if (!$this->getUser())
            return $this->redirect($this->generateUrl('fos_user_security_login'));

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FrontFrontBundle:Event')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Event entity.');
        }

        if (!$this->getUser() or !$entity->allowModificationByUser($this->getUser()))
                return $this->redirect($this->generateUrl('fos_user_security_login'));


        $query = $em->getRepository('FrontFrontBundle:Address')->filter(array('event' => $entity));

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $query, $request->query->get('page', 1), $this->getParameter('pagination_line_number')
        );

        return $this->render('FrontFrontBundle:Event:editAddresses.html.twig', array(
                    'event' => $entity,
                    'pagination' => $pagination,
        ));
    }

    /**
     * Displays a form to edit an existing Event entity.
     *
     */
    public function editPicturesAction(Request $request, $id) {
        if (!$this->getUser())
            return $this->redirect($this->generateUrl('fos_user_security_login'));

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FrontFrontBundle:Event')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Event entity.');
        }

        if (!$this->getUser() or !$entity->allowModificationByUser($this->getUser()))
                return $this->redirect($this->generateUrl('fos_user_security_login'));

        /*
         * UPLOAD FILE FORM
         * remplacer le User par entite souhaitee
         * ajouter au render
          'editId' => $editId,
          'existingFiles' => $existingFiles,
         * ajouter fonction handleFiles
         *
         */
        $editId = $this->getRequest()->get('editId');
        $arrayFile = $this->handleFiles($entity, $this->getRequest()->get('editId'));
        $editId = $arrayFile ['editId'];
        $existingFiles = $arrayFile ['existingFiles'];
        /*
         * UPLOAD FILE FORM END
         */


        $query = $em->getRepository('FrontFrontBundle:EventFile')->findByEvent($entity);

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $query, $request->query->get('page', 1), $this->getParameter('pagination_line_number')
        );

        return $this->render('FrontFrontBundle:Event:editPictures.html.twig', array(
                    'event' => $entity,
                    'editId' => $editId,
                    'existingFiles' => $existingFiles,
                    'pagination' => $pagination,
        ));
    }

    /**
     * Creates a form to edit a Event entity.
     *
     * @param Event $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Event $entity) {
        $securityContext = $this->container->get('security.context');
        $form = $this->createForm(new EventType($securityContext), $entity, array(
            'action' => $this->generateUrl('front_event_update', array('id' => $entity->getId())),
            'method' => 'PUT',
            'attr' => array('locale' => $this->get('request')->getLocale())
        ));

        $form->add('submit', 'submit', array('label' => /** @Ignore */ $this->get('translator')->trans('update'), 'attr' => array('class' => 'btn btn-success btn-lg pull-right')));

        return $form;
    }

    /**
     * Edits an existing Event entity.
     *
     */
    public function updateAction(Request $request, $id) {
        if (!$this->getUser())
            return $this->redirect($this->generateUrl('fos_user_security_login'));

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FrontFrontBundle:Event')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Event entity.');
        }

        if (!$this->getUser() or !$entity->allowModificationByUser($this->getUser()))
            return new Response('', 403);

        $originalEventDates = new ArrayCollection();
        foreach ($entity->getEventDates() as $eventDate)
            $originalEventDates->add($eventDate);


        $editForm = $this->createEditForm($entity);
        $editForm->submit($request);


        if ($editForm->isValid()) {

            $entity->setName($this->slugify($entity->getTitle()));

            foreach ($originalAddresses as $address)
                if ($entity->getAddresses()->contains($address) == false)
                    $em->remove($address);

            foreach ($originalEventDates as $eventDate)
                if ($entity->getEventDates()->contains($eventDate) == false)
                    $em->remove($eventDate);


            $entity->setUser($this->getUser());

            $em->flush();

            try {
                $em->refresh($entity);
                $address = $entity->getAddress();
                $this->setLatitudeAndLongitude($address);
                $em->persist($address);
                $em->flush();
            } catch (\Exception $e) {
                
            }

            return $this->redirect($this->generateUrl('front_event_edit', array('id' => $id)));
        }


        return $this->render('FrontFrontBundle:Event:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
                    'editId' => $editId,
                    'existingFiles' => $existingFiles,
        ));
    }

    public function updateLinkAction(Request $request, $id) {
        if (!$this->getUser())
            return $this->redirect($this->generateUrl('fos_user_security_login'));

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FrontFrontBundle:Event')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Event entity.');
        }

        if (!$this->getUser() or !$entity->allowModificationByUser($this->getUser()))
            return new Response('', 403);

        $editLinkForm = $this->createEditLinkForm($entity);
        $editLinkForm->submit($request);


        if ($editLinkForm->isValid()) {
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                    'success', $this->get('translator')->trans('form.ffel.flashbags.update')
            );
        }

        return $this->render('FrontFrontBundle:Event:linkForm.html.twig', array(
                    'entity' => $entity,
                    'edit_link_form' => $editLinkForm->createView(),
        ));
    }

    public function updateDescriptionAction(Request $request, $id) {
        if (!$this->getUser())
            return $this->redirect($this->generateUrl('fos_user_security_login'));

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FrontFrontBundle:Event')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Event entity.');
        }

        if (!$this->getUser() or !$entity->allowModificationByUser($this->getUser()))
                return new Response('', 403);

        $editDescriptionForm = $this->createEditDescriptionForm($entity);
        $editDescriptionForm->submit($request);


        if ($editDescriptionForm->isValid()) {

            if($entity->getFormFilledByOrganizator())
                $entity->setOrganizedBy($this->getUser());

            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                    'success', $this->get('translator')->trans('form.ffede.flashbags.update')
            );
        }

        return $this->render('FrontFrontBundle:Event:descriptionForm.html.twig', array(
                    'entity' => $entity,
                    'edit_description_form' => $editDescriptionForm->createView(),
        ));
    }

    /**
     * Deletes a Event entity.
     *
     */
    public function deleteAction(Request $request, $id) {

        return new Response('', 404);

        if (!$this->getUser())
            return $this->redirect($this->generateUrl('fos_user_security_login'));

        $form = $this->createDeleteForm($id);
        $form->submit($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('FrontFrontBundle:Event')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Event entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('front_event'));
    }

    /**
     * get event alerts.
     *
     */
    public function alertsAction($id) {

        if (!$this->getUser())
            return new Response();

        $em = $this->getDoctrine()->getManager();

        $event = $em->getRepository('FrontFrontBundle:Event')->findOneBy(array('id' => $id));

        if (!$event) {
            throw $this->createNotFoundException('Unable to find Event entity.');
        }

        return $this->render('FrontFrontBundle:Event:alerts.html.twig', array(
                    'event' => $event,
        ));
    }

    /**
     * Creates a form to delete a Event entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('front_event_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('submit', 'submit', array('label' => /** @Ignore */ $this->get('translator')->trans('delete')))
                        ->getForm()
        ;
    }

    private function handleFiles($entity, $editId = null) {

        $entityName = substr(get_class($entity), (strrpos(get_class($entity), "\\", -1)) + 1) . 'File';
        $arrayFile = $this->get('image_bundle.get_editiId_and_existingFiles')->getEditIdAndExistingFiles(
                array(
                    'editId' => $editId,
                    'entityName' => $entityName,
                    'entityId' => $entity->getId(),
                )
        );

        $editId = $arrayFile ['editId'];
        $existingFiles = $arrayFile ['existingFiles'];

        $em = $this->getDoctrine()->getManager();

        foreach ($existingFiles as $file_name) {
            $EventFile = $em->getRepository('FrontFrontBundle:EventFile')->findOneBy(array('name' => $file_name, 'event' => $entity));
            if (!$EventFile) {
                $EventFile = new EventFile();
                $EventFile->setName($file_name)
                        ->setEvent($entity);
                $em->persist($EventFile);

                 $this->get('session')->getFlashBag()->add(
                    'success', $this->get('translator')->trans('toastr.load.photo.add', array( '%NAME%' => $file_name))
                );
            }
            else
                $this->get('session')->getFlashBag()->add(
                        'error', $this->get('translator')->trans('toastr.load.photo.already_exist', array( '%NAME%' => $file_name))
                );

        }
//        if ($entity->getEventFiles())
//            foreach ($entity->getEventFiles() as $EventFile)
//                if (!in_array($EventFile->getName(), $existingFiles))
//                    $em->remove($EventFile);

        $em->flush();

        $this->get('punk_ave.file_uploader')->removeFiles(array('folder' => 'attachments/' . $editId));

        return $arrayFile;
    }

    private function setLatitudeAndLongitude($entity = null) {
        if (!$entity)
            return;
        try {

            if (!$entity OR ! $entity->stringForGoogleMaps())
                return;

            $geocodeAddresses = $this->container
                    ->get('bazinga_geocoder.geocoder')
                    ->using('google_maps')
                    ->geocode($entity->stringForGoogleMaps());

            if (!count($geocodeAddresses))
                return;

            foreach ($geocodeAddresses as $geocodeAddress) {
                $entity->setLatitude($geocodeAddress->getLatitude());
                $entity->setLongitude($geocodeAddress->getLongitude());
                return;
            }
        } catch (\Exception $e) {
            throw $e;
        }
    }

    static public function slugify($text) {
        $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
        $text = trim($text, '-');
        if (function_exists('iconv'))
            $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        $text = strtolower($text);
        $text = preg_replace('~[^-\w]+~', '', $text);
        if (empty($text))
            return 'n-a';

        return $text;
    }

    private function createEditLinkForm(Event $entity) {
        $form = $this->createForm(new EventLinkType(), $entity, array(
            'action' => $this->generateUrl('front_event_update_link', array('id' => $entity->getId())),
            'method' => 'PUT',
            'attr' => array('locale' => $this->get('request')->getLocale())
        ));

        $form->add('submit', 'submit', array('label' => /** @Ignore */ $this->get('translator')->trans('update')));

        return $form;
    }

    private function createEditDescriptionForm(Event $entity) {
        $securityContext = $this->container->get('security.context');
        $form = $this->createForm(new EventDescriptionType($securityContext), $entity, array(
            'action' => $this->generateUrl('front_event_update_description', array('id' => $entity->getId())),
            'method' => 'PUT',
            'attr' => array('locale' => $this->get('request')->getLocale())
        ));

        $form->add('submit', 'submit', array('label' => /** @Ignore */ $this->get('translator')->trans('update')));

        return $form;
    }

}
