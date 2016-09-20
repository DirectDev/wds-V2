<?php

namespace Front\FrontBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Front\FrontBundle\Entity\Video;
use Front\FrontBundle\Form\VideoType;
use Front\FrontBundle\Form\VideoFilterType;
use Symfony\Component\HttpFoundation\Response;

/**
 * Video controller.
 *
 */
class VideoController extends Controller {

    /**
     * Lists all Video entities.
     *
     */
    public function indexAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $page = $this->getDoctrine()->getRepository('AdminAdminBundle:Page')->findOneByName('videos');
        if (!$page)
            throw new \Exception('Page not found!');

        $query = $em->getRepository('FrontFrontBundle:Video')->findForVideoIndex();
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $query, $request->query->get('page', 1), $this->getParameter('pagination_line_number')
        );

        $filterForm = $this->createFilterVideoForm();
        $filterForm->submit($request);

        return $this->render('FrontFrontBundle:Video:index.html.twig', array(
                    'page' => $page,
                    'pagination' => $pagination,
                    'filterForm' => $filterForm->createView(),
        ));
    }

    public function movesAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $page = $this->getDoctrine()->getRepository('AdminAdminBundle:Page')->findOneByName('moves');
        if (!$page)
            throw new \Exception('Page not found!');

        $query = $em->getRepository('FrontFrontBundle:Video')->findForMoveIndex();
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $query, $request->query->get('page', 1), $this->getParameter('pagination_line_number')
        );

        $filterForm = $this->createFilterMoveForm();
        $filterForm->submit($request);

        return $this->render('FrontFrontBundle:Move:index.html.twig', array(
                    'page' => $page,
                    'pagination' => $pagination,
                    'filterForm' => $filterForm->createView(),
        ));
    }

    public function filterVideoAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $page = $this->getDoctrine()->getRepository('AdminAdminBundle:Page')->findOneByName('videos');
        if (!$page)
            throw new \Exception('Page not found!');

        $filterForm = $this->createFilterVideoForm();
        $filterForm->submit($request);

        $filterData = array();

        if ($filterForm->isValid()) {
            $filterData = $filterForm->getData();
        }

        $query = $em->getRepository('FrontFrontBundle:Video')->filter($filterData, $request->getLocale());

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $query, $request->query->get('page', 1), $this->getParameter('pagination_line_number')
        );

        $userInFilter = null;
        if($filterData['user'])
            $userInFilter = $em->getRepository('UserUserBundle:User')->find($filterData['user']);

        return $this->render('FrontFrontBundle:Video:index.html.twig', array(
                    'page' => $page,
                    'pagination' => $pagination,
                    'filterForm' => $filterForm->createView(),
                    'userInFilter' => $userInFilter
        ));
    }

    public function filterMoveAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $page = $this->getDoctrine()->getRepository('AdminAdminBundle:Page')->findOneByName('moves');
        if (!$page)
            throw new \Exception('Page not found!');

        $filterForm = $this->createFilterMoveForm();
        $filterForm->submit($request);

        $filterData = array();

        if ($filterForm->isValid()) {
            $filterData = $filterForm->getData();
        }

        $query = $em->getRepository('FrontFrontBundle:Video')->filter($filterData, $request->getLocale());

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $query, $request->query->get('page', 1), $this->getParameter('pagination_line_number')
        );

        $userInFilter = null;
        if($filterData['user'])
            $userInFilter = $em->getRepository('UserUserBundle:User')->find($filterData['user']);

        return $this->render('FrontFrontBundle:Move:index.html.twig', array(
                    'page' => $page,
                    'pagination' => $pagination,
                    'filterForm' => $filterForm->createView(),
                    'userInFilter' => $userInFilter
        ));
    }

    private function createFilterVideoForm() {
        $form = $this->createForm(new VideoFilterType(), null, array(
            'action' => $this->generateUrl('front_video_filter_video'),
            'method' => 'GET',
        ));

        return $form;
    }

    private function createFilterMoveForm() {
        $form = $this->createForm(new VideoFilterType(true), null, array(
            'action' => $this->generateUrl('front_video_filter_move'),
            'method' => 'GET',
        ));

        return $form;
    }

    private function findUser($id) {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('UserUserBundle:User')->find($id);
        if (!$user)
            throw $this->createNotFoundException('Unable to find User entity.');
        return $user;
    }

    /**
     * Creates a new Video entity.
     *
     */
    public function createAction(Request $request, $id) {

        if (!$this->getUser())
            return $this->redirect($this->generateUrl('fos_user_security_login'));

        $user = $this->findUser($id);

        $video = new Video();
        $video->setUser($user);
        $video->setCreatedAt(new \DateTime());
        $form = $this->createCreateForm($video, $id);
        $form->submit($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $video->setName($video->getTitle());
            $em->persist($video);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                    'success', $this->get('translator')->trans('form.ffv.flashbags.create')
            );

            $user = $video->getUser();
            if ($user)
                return $this->redirect($this->generateUrl('front_video_show_with_buttons', array('id' => $video->getId())));
        }
        else
            $this->get('session')->getFlashBag()->add(
                    'error', $this->get('translator')->trans('form.ffv.flashbags.error')
            );

        return $this->render('FrontFrontBundle:Video:new.html.twig', array(
                    'video' => $video,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Video entity.
     *
     * @param Video $video The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Video $video, $id) {
        $form = $this->createForm(new VideoType(), $video, array(
            'attr' => array('locale' => $this->get('request')->getLocale()),
            'action' => $this->generateUrl('front_video_create', array('id' => $id)),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => /** @Ignore */ $this->get('translator')->trans('form.ffv.button.create')));

        return $form;
    }

    /**
     * Displays a form to create a new Video entity.
     *
     */
    public function newAction($id) {

        if (!$this->getUser())
            return $this->redirect($this->generateUrl('fos_user_security_login'));

        $user = $this->findUser($id);

        $video = new Video();
        $video->setUser($user);
        $form = $this->createCreateForm($video, $user->getId());

        return $this->render('FrontFrontBundle:Video:new.html.twig', array(
                    'video' => $video,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Video entity.
     *
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $video = $em->getRepository('FrontFrontBundle:Video')->find($id);

        if (!$video) {
            throw $this->createNotFoundException('Unable to find Video entity.');
        }

        return $this->render('FrontFrontBundle:Video:show.html.twig', array(
                    'video' => $video,
        ));
    }

    public function showWithButtonsAction($id) {
        $em = $this->getDoctrine()->getManager();

        $video = $em->getRepository('FrontFrontBundle:Video')->find($id);

        if (!$video) {
            throw $this->createNotFoundException('Unable to find Video entity.');
        }

        return $this->render('FrontFrontBundle:Video:showWithButtons.html.twig', array(
                    'video' => $video,
        ));
    }

    /**
     * Displays a form to edit an existing Video entity.
     *
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        if (!$this->getUser())
            return $this->redirect($this->generateUrl('fos_user_security_login'));

        $video = $em->getRepository('FrontFrontBundle:Video')->find($id);

        if (!$video) {
            throw $this->createNotFoundException('Unable to find Video entity.');
        }

        if (!$this->getUser() or $video->getUser() != $this->getUser())
            return new Response('', 403);

        $editForm = $this->createEditForm($video);

        return $this->render('FrontFrontBundle:Video:edit.html.twig', array(
                    'video' => $video,
                    'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Video entity.
     *
     * @param Video $video The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Video $video) {
        $form = $this->createForm(new VideoType(), $video, array(
            'attr' => array('locale' => $this->get('request')->getLocale()),
            'action' => $this->generateUrl('front_video_update', array('id' => $video->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => /** @Ignore */ 'Update'));

        return $form;
    }

    /**
     * Edits an existing Video entity.
     *
     */
    public function updateAction(Request $request, $id) {

        if (!$this->getUser())
            return $this->redirect($this->generateUrl('fos_user_security_login'));

        $em = $this->getDoctrine()->getManager();

        $video = $em->getRepository('FrontFrontBundle:Video')->find($id);

        if (!$video) {
            throw $this->createNotFoundException('Unable to find Video entity.');
        }

        if (!$this->getUser() or $video->getUser() != $this->getUser())
            return new Response('', 403);

        $editForm = $this->createEditForm($video);
        $editForm->submit($request);

        if ($editForm->isValid()) {
            $video->setName($video->getTitle());
            $em->persist($video);
            $em->flush();

             $this->get('session')->getFlashBag()->add(
                    'success', $this->get('translator')->trans('form.ffv.flashbags.update')
            );

            return $this->redirect($this->generateUrl('front_video_show_with_buttons', array('id' => $id)));
        }
        else
             $this->get('session')->getFlashBag()->add(
                    'error', $this->get('translator')->trans('form.ffv.flashbags.error')
            );

        return $this->render('FrontFrontBundle:Video:edit.html.twig', array(
                    'video' => $video,
                    'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a Video entity.
     *
     */
    public function deleteAction(Request $request, $id) {
        if (!$this->getUser())
            return $this->redirect($this->generateUrl('fos_user_security_login'));

        $em = $this->getDoctrine()->getManager();
        $video = $em->getRepository('FrontFrontBundle:Video')->find($id);

        if (!$video) {
            throw $this->createNotFoundException('Unable to find Video entity.');
        }

        if (!$this->getUser()->getVideos()->contains($video)) {
            throw $this->createNotFoundException('Error : not yours.');
        }

        $em->remove($video);
        $em->flush();

        return new Response('', 200);
    }

    public function loveAction(Request $request, $id) {

        if (!$this->getUser())
            return $this->redirect($this->generateUrl('fos_user_security_login'));

        $em = $this->getDoctrine()->getManager();
        $video = $em->getRepository('FrontFrontBundle:Video')->find($id);

        if (!$video) {
            throw $this->createNotFoundException('Unable to find Video entity.');
        }
        if (!$video->getLovesMe()->contains($this->getUser()))
            $video->addLovesMe($this->getUser());

        $em->persist($video);
        $em->flush();
        $em->refresh($video);

        return $this->render('FrontFrontBundle:Video:linkLoveVideo.html.twig', array(
                    'video' => $video,
        ));
    }

    public function unloveAction(Request $request, $id) {

        if (!$this->getUser())
            return $this->redirect($this->generateUrl('fos_user_security_login'));

        $em = $this->getDoctrine()->getManager();
        $video = $em->getRepository('FrontFrontBundle:Video')->find($id);

        if (!$video) {
            throw $this->createNotFoundException('Unable to find Video entity.');
        }

        $User = $this->getUser();
        if ($User->getVideoloves()->contains($video))
            $User->removeVideolove($video);

        $em->persist($User);
        $em->flush();
        $em->refresh($video);

        return $this->render('FrontFrontBundle:Video:linkLoveVideo.html.twig', array(
                    'video' => $video,
        ));
    }

}
