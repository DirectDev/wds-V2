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
     * Lists all Event entities.
     *
     */
    public function indexAction() {

        return new Response('', 404);

        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('FrontFrontBundle:Event')->findAll();

        return $this->render('FrontFrontBundle:Event:index.html.twig', array(
                    'entities' => $entities,
        ));
    }

    /**
     * Creates a new Event entity.
     *
     */
    public function createAction(Request $request) {
        if (!$this->getUser())
            return $this->redirect($this->generateUrl('fos_user_security_login'));

        $entity = new Event();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $entity->setName($this->slugify($entity->getTitle()));
            $entity->setUser($this->getUser());

            $em->persist($entity);
            $em->flush();

            try {
                $em->refresh($entity);
                $address = $entity->getAddress();
                $this->setLatitudeAndLongitude($address);
                $em->persist($address);
                $em->flush();
            } catch (\Exception $e) {
                
            }

            return $this->redirect($this->generateUrl('front_event_edit', array('id' => $entity->getId(), 'uri' => $entity->getURI())));
        }

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
        $form = $this->createForm(new EventType(), $entity, array(
            'action' => $this->generateUrl('front_event_create'),
            'method' => 'POST',
            'attr' => array('locale' => $this->get('request')->getLocale())
        ));

        $form->add('submit', 'submit', array('label' => $this->get('translator')->trans('create')));

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

//        $deleteForm = $this->createDeleteForm($id);

        return $this->render('FrontFrontBundle:Event:show.html.twig', array(
                    'event' => $event,
//                    'delete_form' => $deleteForm->createView(),
        ));
    }

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

        $editForm = $this->createEditForm($entity);
        $editLinkForm = $this->createEditLinkForm($entity);
        $editDescriptionForm = $this->createEditDescriptionForm($entity);

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

        return $this->render('FrontFrontBundle:Event:edit.html.twig', array(
                    'event' => $entity,
                    'edit_form' => $editForm->createView(),
                    'edit_link_form' => $editLinkForm->createView(),
                    'edit_description_form' => $editDescriptionForm->createView(),
                    'editId' => $editId,
                    'existingFiles' => $existingFiles,
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
        $form = $this->createForm(new EventType(), $entity, array(
            'action' => $this->generateUrl('front_event_update', array('id' => $entity->getId())),
            'method' => 'PUT',
            'attr' => array('locale' => $this->get('request')->getLocale())
        ));

        $form->add('submit', 'submit', array('label' => $this->get('translator')->trans('update'), 'attr' => array('class' => 'btn btn-success btn-lg pull-right')));

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

        $originalEventDates = new ArrayCollection();
        foreach ($entity->getEventDates() as $eventDate)
            $originalEventDates->add($eventDate);


        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);


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

        $editLinkForm = $this->createEditLinkForm($entity);
        $editLinkForm->handleRequest($request);


        if ($editLinkForm->isValid()) {
            $em->flush();
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

        $editDescriptionForm = $this->createEditDescriptionForm($entity);
        $editDescriptionForm->handleRequest($request);


        if ($editDescriptionForm->isValid()) {
            $em->flush();
        }

        return $this->render('FrontFrontBundle:Event:DescriptionForm.html.twig', array(
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
        $form->handleRequest($request);

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
                        ->add('submit', 'submit', array('label' => $this->get('translator')->trans('delete')))
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
            }
        }
        if ($entity->getEventFiles())
            foreach ($entity->getEventFiles() as $EventFile)
                if (!in_array($EventFile->getName(), $existingFiles))
                    $em->remove($EventFile);

        $em->flush();

        $this->get('punk_ave.file_uploader')->removeFiles(array('folder' => 'attachments/' . $editId));

        return $arrayFile;
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

    private function createLoveForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('front_event_love', array('id' => $id)))
                        ->setMethod('POST')
                        ->add('submit', 'submit', array(
                            'label' => $this->get('translator')->trans('I Like'),
                            'attr' => array(
                                'class' => 'btn-u btn-block love_button'
                            )
                        ))
                        ->getForm()
        ;
    }

    private function createUnLoveForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('front_event_unlove', array('id' => $id)))
                        ->setMethod('POST')
                        ->add('submit', 'submit', array(
                            'label' => $this->get('translator')->trans("I don't like"),
                            'attr' => array(
                                'class' => 'btn-u btn-block love_button'
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

        return $this->redirect($this->generateUrl('front_event_loves', array('id' => $entity->getId())));
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

        return $this->redirect($this->generateUrl('front_event_loves', array('id' => $entity->getId())));
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

    private function createEditLinkForm(Event $entity) {
        $form = $this->createForm(new EventLinkType(), $entity, array(
            'action' => $this->generateUrl('front_event_update_link', array('id' => $entity->getId())),
            'method' => 'PUT',
            'attr' => array('locale' => $this->get('request')->getLocale())
        ));

        $form->add('submit', 'submit', array('label' => $this->get('translator')->trans('update')));

        return $form;
    }

    private function createEditDescriptionForm(Event $entity) {
        $form = $this->createForm(new EventDescriptionType(), $entity, array(
            'action' => $this->generateUrl('front_event_update_description', array('id' => $entity->getId())),
            'method' => 'PUT',
            'attr' => array('locale' => $this->get('request')->getLocale())
        ));

        $form->add('submit', 'submit', array('label' => $this->get('translator')->trans('update')));

        return $form;
    }

}
