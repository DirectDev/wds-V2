<?php

namespace Front\FrontBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Front\FrontBundle\Entity\Music;
use Front\FrontBundle\Form\MusicType;

/**
 * Music controller.
 *
 */
class MusicController extends Controller {

    private function findUser($id) {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('UserUserBundle:User')->find($id);
        if (!$user)
            throw $this->createNotFoundException('Unable to find User entity.');
        return $user;
    }

    /**
     * Lists all Music entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('FrontFrontBundle:Music')->findAll();

        return $this->render('FrontFrontBundle:Music:index.html.twig', array(
                    'entities' => $entities,
        ));
    }

    /**
     * Creates a new Music entity.
     *
     */
    public function createAction(Request $request, $id) {

        if (!$this->getUser())
            return $this->redirect($this->generateUrl('fos_user_security_login'));

        $user = $this->findUser($id);

        $entity = new Music();
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

        return $this->render('FrontFrontBundle:Music:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Music entity.
     *
     * @param Music $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Music $entity, $id) {
        $form = $this->createForm(new MusicType(), $entity, array(
            'action' => $this->generateUrl('front_music_create', array('id' => $id)),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => $this->get('translator')->trans('create'), 'attr' => array('class' => 'btn btn-success btn-md pull-right')));

        return $form;
    }

    /**
     * Displays a form to create a new Music entity.
     *
     */
    public function newAction($id) {

        if (!$this->getUser())
            return $this->redirect($this->generateUrl('fos_user_security_login'));

        $user = $this->findUser($id);

        $entity = new Music();
        $entity->setUser($user);
        $form = $this->createCreateForm($entity, $user->getId());

        return $this->render('FrontFrontBundle:Music:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Music entity.
     *
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FrontFrontBundle:Music')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Music entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('FrontFrontBundle:Music:show.html.twig', array(
                    'entity' => $entity,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Music entity.
     *
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FrontFrontBundle:Music')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Music entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('FrontFrontBundle:Music:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Music entity.
     *
     * @param Music $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Music $entity) {
        $form = $this->createForm(new MusicType(), $entity, array(
            'action' => $this->generateUrl('front_music_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing Music entity.
     *
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FrontFrontBundle:Music')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Music entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('front_music_edit', array('id' => $id)));
        }

        return $this->render('FrontFrontBundle:Music:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Music entity.
     *
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('FrontFrontBundle:Music')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Music entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('front_music'));
    }

    /**
     * Creates a form to delete a Music entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('front_music_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('submit', 'submit', array('label' => 'Delete'))
                        ->getForm()
        ;
    }

}
