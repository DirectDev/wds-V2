<?php

namespace Front\FrontBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Front\FrontBundle\Entity\Video;
use Front\FrontBundle\Form\VideoType;
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
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $videos = $em->getRepository('FrontFrontBundle:Video')->findAll();

        return $this->render('FrontFrontBundle:Video:index.html.twig', array(
                    'videos' => $videos,
        ));
    }

    public function movesAction() {
        $em = $this->getDoctrine()->getManager();

        $videos = $em->getRepository('FrontFrontBundle:Video')->findAll();
        $tags = $em->getRepository('FrontFrontBundle:Tag')->findAll();

        return $this->render('FrontFrontBundle:Move:moves.html.twig', array(
                    'videos' => $videos,
                    'tags' => $tags,
        ));
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
        $form = $this->createCreateForm($video, $id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $video->setName($video->getTitle());
            $em->persist($video);
            $em->flush();

            $user = $video->getUser();
            if ($user)
                return $this->redirect($this->generateUrl('front_video_show_with_buttons', array('id' => $video->getId())));
        }

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
            'action' => $this->generateUrl('front_video_create', array('id' => $id)),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => /** @Ignore */ $this->get('translator')->trans('create')));

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

        $video = $em->getRepository('FrontFrontBundle:Video')->find($id);

        if (!$video) {
            throw $this->createNotFoundException('Unable to find Video entity.');
        }

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

        $editForm = $this->createEditForm($video);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $video->setName($video->getTitle());
            $em->flush();

            return $this->redirect($this->generateUrl('front_video_show_with_buttons', array('id' => $id)));
        }

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

}
