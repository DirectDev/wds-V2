<?php

namespace Front\FrontBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use User\UserBundle\Entity\User;
use Front\FrontBundle\Form\UserType;
use Front\FrontBundle\Form\UserDescriptionType;
use Front\FrontBundle\Form\UserProfileType;
use Front\FrontBundle\Form\UserLinkType;
use User\UserBundle\Entity\UserFile;
use Front\FrontBundle\Form\UserFilterType;
use Front\FrontBundle\Form\EventFilterType;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * User controller.
 *
 */
class UserController extends Controller {

    /**
     * Lists all User entities.
     *
     */
    public function indexAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $page = $this->getDoctrine()->getRepository('AdminAdminBundle:Page')->findOneByName('users');
        if (!$page)
            throw new \Exception('Page not found!');

        $query = $em->getRepository('UserUserBundle:User')->findForUserIndex();
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $query, $request->query->get('page', 1), $this->getParameter('pagination_line_number')
        );

        $filterForm = $this->createFilterUserForm();
        $filterForm->handleRequest($request);

        return $this->render('FrontFrontBundle:User:index.html.twig', array(
                    'page' => $page,
                    'pagination' => $pagination,
                    'filterForm' => $filterForm->createView(),
        ));
    }

    public function filterAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $page = $this->getDoctrine()->getRepository('AdminAdminBundle:Page')->findOneByName('users');
        if (!$page)
            throw new \Exception('Page not found!');

        $filterForm = $this->createFilterUserForm();
        $filterForm->handleRequest($request);

        $filterData = array();

        if ($filterForm->isValid()) {
            $filterData = $filterForm->getData();
        }

        $query = $em->getRepository('UserUserBundle:User')->filter($filterData, $request->getLocale());

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $query, $request->query->get('page', 1), $this->getParameter('pagination_line_number')
        );

        return $this->render('FrontFrontBundle:User:index.html.twig', array(
                    'page' => $page,
                    'pagination' => $pagination,
                    'filterForm' => $filterForm->createView(),
        ));
    }

    private function createFilterUserForm() {
        $form = $this->createForm(new UserFilterType(), null, array(
            'action' => $this->generateUrl('front_user_filter'),
            'method' => 'GET',
        ));

        return $form;
    }

    /**
     * Finds and displays a User entity.
     *
     */
    public function showPublicAction($username, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UserUserBundle:User')->findOneById($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        $this->get('displayCounters.services')->updateUserDisplayCounter($entity);

        $nextEvents = $em->getRepository('FrontFrontBundle:Event')->getNextEventByUser($entity, $limit = 10);

        return $this->render('FrontFrontBundle:User:showPublic.html.twig', array(
                    'user' => $entity,
                    'nextEvents' => $nextEvents,
        ));
    }

    /**
     * Finds and displays a User entity.
     *
     */
    public function showPrivateAction() {

        if (!$this->getUser())
            return $this->redirect($this->generateUrl('fos_user_security_login'));

        $entity = $this->get('security.context')->getToken()->getUser();
        if (!$entity)
            return new Response('', 404);

        return $this->redirect($this->generateUrl('front_user_show_public', array(
                            'id' => $entity->getId(),
                            'username' => $entity->getUsername()
                                )
        ));
    }

    /**
     * Displays a form to edit an existing User entity.
     *
     */
    public function editAction($id) {

        if (!$this->getUser() or $id != $this->getUser()->getId())
            return $this->redirect($this->generateUrl('fos_user_security_login'));

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UserUserBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        $editProfileForm = $this->createEditProfileForm($entity);
        $editDescriptionForm = $this->createEditDescriptionForm($entity);
        $editLinkForm = $this->createEditLinkForm($entity);
        $deleteForm = $this->createDeleteForm($id);


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

        return $this->render('FrontFrontBundle:User:edit.html.twig', array(
                    'entity' => $entity,
                    'delete_form' => $deleteForm->createView(),
                    'edit_profile_form' => $editProfileForm->createView(),
                    'edit_description_form' => $editDescriptionForm->createView(),
                    'edit_link_form' => $editLinkForm->createView(),
                    'editId' => $editId,
                    'existingFiles' => $existingFiles,
        ));
    }

    private function createEditProfileForm(User $entity) {
        $form = $this->createForm(new UserProfileType(), $entity, array(
            'action' => $this->generateUrl('front_user_update_profile', array('id' => $entity->getId())),
            'method' => 'PUT',
            'attr' => array('locale' => $this->get('request')->getLocale())
        ));

        $form->add('submit', 'submit', array('label' => /** @Ignore */ $this->get('translator')->trans('update'), 'attr' => array('class' => 'btn-u pull-right')));

        return $form;
    }

    private function createEditDescriptionForm(User $entity) {
        $form = $this->createForm(new UserDescriptionType(), $entity, array(
            'action' => $this->generateUrl('front_user_update_description', array('id' => $entity->getId())),
            'method' => 'PUT',
            'attr' => array('locale' => $this->get('request')->getLocale())
        ));

        $form->add('submit', 'submit', array('label' => /** @Ignore */ $this->get('translator')->trans('update'), 'attr' => array('class' => 'btn-u pull-right')));

        return $form;
    }

    private function createEditLinkForm(User $entity) {
        $form = $this->createForm(new UserLinkType(), $entity, array(
            'action' => $this->generateUrl('front_user_update_link', array('id' => $entity->getId())),
            'method' => 'PUT',
            'attr' => array('locale' => $this->get('request')->getLocale())
        ));

        $form->add('submit', 'submit', array('label' => /** @Ignore */ $this->get('translator')->trans('update'), 'attr' => array('class' => 'btn-u pull-right')));

        return $form;
    }

    /**
     * Edits an existing User entity.
     *
     */
    public function updateProfileAction(Request $request, $id) {

        if (!$this->getUser() or $id != $this->getUser()->getId())
            return $this->redirect($this->generateUrl('fos_user_security_login'));

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UserUserBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        $editProfileForm = $this->createEditProfileForm($entity);
        $editProfileForm->handleRequest($request);

        if ($editProfileForm->isValid()) {
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                    'success', $this->get('translator')->trans('form.ffup.flashbags.update')
            );
        }

        return $this->render('FrontFrontBundle:User:profileForm.html.twig', array(
                    'entity' => $entity,
                    'edit_profile_form' => $editProfileForm->createView(),
        ));
    }

    public function updateDescriptionAction(Request $request, $id) {

        if (!$this->getUser() or $id != $this->getUser()->getId())
            return $this->redirect($this->generateUrl('fos_user_security_login'));

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UserUserBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        $editDescriptionForm = $this->createEditDescriptionForm($entity);
        $editDescriptionForm->handleRequest($request);

        if ($editDescriptionForm->isValid()) {
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                    'success', $this->get('translator')->trans('form.ffud.flashbags.update')
            );
        }

        return $this->render('FrontFrontBundle:User:descriptionForm.html.twig', array(
                    'entity' => $entity,
                    'edit_description_form' => $editDescriptionForm->createView(),
        ));
    }

    public function updateLinkAction(Request $request, $id) {

        if (!$this->getUser() or $id != $this->getUser()->getId())
            return $this->redirect($this->generateUrl('fos_user_security_login'));

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UserUserBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        $editLinkForm = $this->createEditLinkForm($entity);
        $editLinkForm->handleRequest($request);

        if ($editLinkForm->isValid()) {
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                    'success', $this->get('translator')->trans('form.fful.flashbags.update')
            );
        }

        return $this->render('FrontFrontBundle:User:linkForm.html.twig', array(
                    'entity' => $entity,
                    'edit_link_form' => $editLinkForm->createView(),
        ));
    }

    private function handleFiles($entity, $editId = null) {
        /*
         * UPLOAD FILE FORM
         * remplacer le User par entite souhaitee
         *  Voir ajout dans showAction
         * 
         */

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
            $UserFile = $em->getRepository('UserUserBundle:UserFile')->findOneBy(array('name' => $file_name, 'user' => $entity));
            if (!$UserFile) {
                $UserFile = new UserFile();
                $UserFile->setName($file_name)
                        ->setUser($entity);
                $em->persist($UserFile);
            }
        }
        foreach ($entity->getUserFiles() as $UserFile)
            if (!in_array($UserFile->getName(), $existingFiles))
                $em->remove($UserFile);

        $em->flush();

        $this->get('punk_ave.file_uploader')->removeFiles(array('folder' => 'attachments/' . $editId));

        return $arrayFile;
        /*
         * UPLOAD FILE FORM END
         */
    }

    public function importFacebookEventAction() {

        $user = $this->get('security.context')->getToken()->getUser();
        if (!$user)
            return new Response('', 404);

        $facebookServices = $this->get('facebook.services');
        $facebookServices->importEvents();

        return new Response();
    }

    public function showOverviewsAction($id) {
        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('UserUserBundle:User')->findOneById($id);
        if (!$user) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        $this->get('displayCounters.services')->updateUserDisplayCounter($user);

        $count_events = $em->getRepository('FrontFrontBundle:Event')->countByUser($user);
        $count_videos = $em->getRepository('FrontFrontBundle:Video')->countByUser($user);
        $count_musics = $em->getRepository('FrontFrontBundle:Music')->countByUser($user);
        $count_photos = $em->getRepository('UserUserBundle:UserFile')->countByUser($user);
        $count_lovesme = $em->getRepository('UserUserBundle:User')->countLovesMeByUser($user);

        return $this->render('FrontFrontBundle:User:showOverviews.html.twig', array(
                    'user' => $user,
                    'count_events' => $count_events,
                    'count_videos' => $count_videos,
                    'count_musics' => $count_musics,
                    'count_photos' => $count_photos,
                    'count_lovesme' => $count_lovesme,
        ));
    }

    public function showOverviewsProfileAction($id) {
        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('UserUserBundle:User')->findOneById($id);
        if (!$user) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        $this->get('displayCounters.services')->updateUserDisplayCounter($user);

        $count_events = $em->getRepository('FrontFrontBundle:Event')->countByUser($user);
        $count_videos = $em->getRepository('FrontFrontBundle:Video')->countByUser($user);
        $count_musics = $em->getRepository('FrontFrontBundle:Music')->countByUser($user);
        $count_photos = $em->getRepository('UserUserBundle:UserFile')->countByUser($user);
        $count_lovesme = $em->getRepository('UserUserBundle:User')->countLovesMeByUser($user);

        return $this->render('FrontFrontBundle:User:showOverviewsProfile.html.twig', array(
                    'user' => $user,
                    'count_events' => $count_events,
                    'count_videos' => $count_videos,
                    'count_musics' => $count_musics,
                    'count_photos' => $count_photos,
                    'count_lovesme' => $count_lovesme,
        ));
    }

    public function showOverviewsIndexAction($id) {
        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('UserUserBundle:User')->findOneById($id);
        if (!$user) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        $this->get('displayCounters.services')->updateUserDisplayCounter($user);

        $count_events = $em->getRepository('FrontFrontBundle:Event')->countByUser($user);
        $count_videos = $em->getRepository('FrontFrontBundle:Video')->countByUser($user);
        $count_musics = $em->getRepository('FrontFrontBundle:Music')->countByUser($user);
        $count_photos = $em->getRepository('UserUserBundle:UserFile')->countByUser($user);
        $count_lovesme = $em->getRepository('UserUserBundle:User')->countLovesMeByUser($user);

        return $this->render('FrontFrontBundle:User:showOverviewsIndex.html.twig', array(
                    'user' => $user,
                    'count_events' => $count_events,
                    'count_videos' => $count_videos,
                    'count_musics' => $count_musics,
                    'count_photos' => $count_photos,
                    'count_lovesme' => $count_lovesme,
        ));
    }

    private function createLoveForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('front_user_love', array('id' => $id)))
                        ->setMethod('POST')
                        ->add('submit', 'submit', array(
                            'label' => /** @Ignore */ $this->get('translator')->trans('I Like'),
                            'attr' => array(
                                'class' => 'btn-u btn-block love_button'
                            )
                        ))
                        ->getForm()
        ;
    }

    private function createUnLoveForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('front_user_unlove', array('id' => $id)))
                        ->setMethod('POST')
                        ->add('submit', 'submit', array(
                            'label' => /** @Ignore */ $this->get('translator')->trans("I don't like"),
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
            $entity = $em->getRepository('UserUserBundle:User')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find User entity.');
            }
            if (!$entity->getLovesMe()->contains($this->getUser()))
                $entity->addLovesMe($this->getUser());

            $em->persist($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('front_user_loves', array('id' => $id)));
    }

    public function unLoveAction(Request $request, $id) {

        if (!$this->getUser())
            return $this->redirect($this->generateUrl('fos_user_security_login'));

        $form = $this->createUnLoveForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('UserUserBundle:User')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find User entity.');
            }

            $User = $this->getUser();
            if ($User->getLoves()->contains($entity))
                $User->removeLove($entity);

            $em->persist($User);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('front_user_loves', array('id' => $id)));
    }

    public function lovesAction($id) {
        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('UserUserBundle:User')->find(array('id' => $id));
        if (!$user) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        $loveForm = $this->createLoveForm($id);
        $unLoveForm = $this->createUnLoveForm($id);

        $usersLoveUser = $em->getRepository('UserUserBundle:User')->getUsersLoveUser($user, 8);

        return $this->render('FrontFrontBundle:User:loves.html.twig', array(
                    'user' => $user,
                    'usersLoveUser' => $usersLoveUser,
                    'love_form' => $loveForm->createView(),
                    'unlove_form' => $unLoveForm->createView(),
        ));
    }

    public function passedEventsAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        if (!$this->getUser())
            return $this->redirect($this->generateUrl('fos_user_security_login'));

        $entity = $this->get('security.context')->getToken()->getUser();
        if (!$entity)
            return new Response('', 404);

        $startdate = date('Y-m-d');
        $query = $em->getRepository('FrontFrontBundle:Event')->getPassedEventByUserQuery($entity);
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $query, $request->query->get('page', 1), $this->getParameter('pagination_line_number')
        );

        return $this->render('FrontFrontBundle:User:passedEvents.html.twig', array(
                    'user' => $entity,
                    'pagination' => $pagination,
                    'startdate' => $startdate
        ));
    }

    public function nextEventsAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        if (!$this->getUser())
            return $this->redirect($this->generateUrl('fos_user_security_login'));

        $entity = $this->get('security.context')->getToken()->getUser();
        if (!$entity)
            return new Response('', 404);

        $startdate = date('Y-m-d');
        $query = $em->getRepository('FrontFrontBundle:Event')->getNextEventByUserQuery($entity);
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $query, $request->query->get('page', 1), $this->getParameter('pagination_line_number')
        );

        return $this->render('FrontFrontBundle:User:nextEvents.html.twig', array(
                    'user' => $entity,
                    'pagination' => $pagination,
                    'startdate' => $startdate
        ));
    }

    public function listForVideoSearchAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('UserUserBundle:User')->findWithVideo();

        return $this->render('FrontFrontBundle:User:listForVideoSearch.html.twig', array(
                    'users' => $users,
        ));
    }

    public function listForMoveSearchAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('UserUserBundle:User')->findWithMove();

        return $this->render('FrontFrontBundle:User:listForVideoSearch.html.twig', array(
                    'users' => $users,
        ));
    }

    public function listForMusicSearchAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('UserUserBundle:User')->findWithMusic();

        return $this->render('FrontFrontBundle:User:listForMusicSearch.html.twig', array(
                    'users' => $users,
        ));
    }

    public function eventsAction(Request $request) {

        if (!$this->getUser())
            return $this->redirect($this->generateUrl('fos_user_security_login'));

        $em = $this->getDoctrine()->getManager();

        $query = $em->getRepository('FrontFrontBundle:Event')->findBy(array('user' => $this->getUser()));
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $query, $request->query->get('page', 1), $this->getParameter('pagination_line_number')
        );

        $filterForm = $this->createFilterEventForm();
        $filterForm->handleRequest($request);

        return $this->render('FrontFrontBundle:User:events.html.twig', array(
                    'pagination' => $pagination,
                    'filterForm' => $filterForm->createView(),
        ));
    }

    public function filterEventsAction(Request $request) {

        if (!$this->getUser())
            return $this->redirect($this->generateUrl('fos_user_security_login'));

        $em = $this->getDoctrine()->getManager();

        $filterForm = $this->createFilterEventForm();
        $filterForm->handleRequest($request);

        $filterData = array();

        if ($filterForm->isValid()) {
            $filterData = $filterForm->getData();
        }

        $filterData['user'] = $this->getUser();

        $query = $em->getRepository('FrontFrontBundle:Event')->filter($filterData, $request->getLocale());

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $query, $request->query->get('page', 1), $this->getParameter('pagination_line_number')
        );

        return $this->render('FrontFrontBundle:User:events.html.twig', array(
                    'pagination' => $pagination,
                    'filterForm' => $filterForm->createView(),
        ));
    }

    private function createFilterEventForm() {
        $form = $this->createForm(new EventFilterType($this->getUser()), null, array(
            'action' => $this->generateUrl('front_user_filter_events'),
            'method' => 'GET',
        ));

        return $form;
    }

    /**
     * Deletes a User entity.
     *
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if (!$id or ! $this->getUser())
            throw $this->createNotFoundException('Unable to find User entity.');

        if ($this->getUser() && $this->getUser()->getId() != $id)
            throw $this->createNotFoundException('Wrong User.');

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('UserUserBundle:User')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find User entity.');
            }

            foreach ($entity->getEvents() as $event) {
                $event->setPublishedBy(null);
                $event->setOrganizedBy(null);
                $em->persist($event);
            }
            $em->flush();
            $em->refresh($entity);

            foreach ($entity->getEventsPublished() as $event) {
                $event->setPublishedBy(null);
                $em->persist($event);
            }

            foreach ($entity->getEventsOrganized() as $event) {
                $event->setOrganizedBy(null);
                $em->persist($event);
            }
            $em->flush();
            $em->refresh($entity);

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('fos_user_security_logout'));
    }

    /**
     * Creates a form to delete a User entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        $form = $this->createFormBuilder()
                ->setAction($this->generateUrl('front_user_delete', array('id' => $id)))
                ->setMethod('DELETE')
                ->getForm();

        $form->add('submit', 'submit', array(
            'label' => /** @Ignore */ $this->get('translator')->trans('user.delete.button'), 'attr' => array('class' => 'btn btn-default pull-right')));

        return $form;
    }

}
