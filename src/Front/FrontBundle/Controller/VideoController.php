<?php

namespace Front\FrontBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Front\FrontBundle\Entity\Video;
use Front\FrontBundle\Form\VideoType;

/**
 * Video controller.
 *
 */
class VideoController extends Controller {

    private function findUser($id) {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('UserUserBundle:User')->find($id);
        if (!$user)
            throw $this->createNotFoundException('Unable to find User entity.');
        return $user;
    }

    /**
     * Lists all Video entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('FrontFrontBundle:Video')->findAll();

        return $this->render('FrontFrontBundle:Video:index.html.twig', array(
                    'entities' => $entities,
        ));
    }

    /**
     * Creates a new Video entity.
     *
     */
    public function createAction(Request $request, $id) {

        if (!$this->getUser())
            return $this->redirect($this->generateUrl('fos_user_security_login'));

        $user = $this->findUser($id);

        $entity = new Video();
        $entity->setUser($user);
        $form = $this->createCreateForm($entity, $id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $user = $entity->getUser();
            if ($user)
                return $this->redirect($this->generateUrl('front_user_edit', array('id' => $user->getId())));
        }

        return $this->render('FrontFrontBundle:Video:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Video entity.
     *
     * @param Video $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Video $entity, $id) {
        $form = $this->createForm(new VideoType(), $entity, array(
            'action' => $this->generateUrl('front_video_create', array('id' => $id)),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => $this->get('translator')->trans('create'), 'attr' => array('class' => 'btn btn-success btn-md pull-right')));

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

        $entity = new Video();
        $entity->setUser($user);
        $form = $this->createCreateForm($entity, $user->getId());

        return $this->render('FrontFrontBundle:Video:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Video entity.
     *
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FrontFrontBundle:Video')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Video entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('FrontFrontBundle:Video:show.html.twig', array(
                    'entity' => $entity,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Video entity.
     *
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FrontFrontBundle:Video')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Video entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('FrontFrontBundle:Video:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Video entity.
     *
     * @param Video $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Video $entity) {
        $form = $this->createForm(new VideoType(), $entity, array(
            'action' => $this->generateUrl('front_video_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing Video entity.
     *
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FrontFrontBundle:Video')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Video entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('front_video_edit', array('id' => $id)));
        }

        return $this->render('FrontFrontBundle:Video:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Video entity.
     *
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('FrontFrontBundle:Video')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Video entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('front_video'));
    }

    /**
     * Creates a form to delete a Video entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('front_video_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('submit', 'submit', array('label' => 'Delete'))
                        ->getForm()
        ;
    }

}
