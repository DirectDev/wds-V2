<?php

namespace Front\FrontBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Front\FrontBundle\Entity\MusicType;
use Front\FrontBundle\Form\MusicTypeType;

/**
 * MusicType controller.
 *
 */
class MusicTypeController extends Controller {

    public function filtersAction() {
        $em = $this->getDoctrine()->getManager();

        $musicTypes = $em->getRepository('FrontFrontBundle:MusicType')->findAll();

        return $this->render('FrontFrontBundle:MusicType:filters.html.twig', array(
                    'musicTypes' => $musicTypes,
        ));
    }
    
    public function listForUserSearchAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $musicTypes = $em->getRepository('FrontFrontBundle:MusicType')->findAll();

        return $this->render('FrontFrontBundle:MusicType:listForUserSearch.html.twig', array(
                    'musicTypes' => $musicTypes,
        ));
    }

//
//    /**
//     * Lists all MusicType entities.
//     *
//     */
//    public function indexAction()
//    {
//        $em = $this->getDoctrine()->getManager();
//
//        $entities = $em->getRepository('FrontFrontBundle:MusicType')->findAll();
//
//        return $this->render('FrontFrontBundle:MusicType:index.html.twig', array(
//            'entities' => $entities,
//        ));
//    }
//    /**
//     * Creates a new MusicType entity.
//     *
//     */
//    public function createAction(Request $request)
//    {
//        $entity = new MusicType();
//        $form = $this->createCreateForm($entity);
//        $form->handleRequest($request);
//
//        if ($form->isValid()) {
//            $em = $this->getDoctrine()->getManager();
//            $em->persist($entity);
//            $em->flush();
//
//            return $this->redirect($this->generateUrl('front_musictype_show', array('id' => $entity->getId())));
//        }
//
//        return $this->render('FrontFrontBundle:MusicType:new.html.twig', array(
//            'entity' => $entity,
//            'form'   => $form->createView(),
//        ));
//    }
//
//    /**
//     * Creates a form to create a MusicType entity.
//     *
//     * @param MusicType $entity The entity
//     *
//     * @return \Symfony\Component\Form\Form The form
//     */
//    private function createCreateForm(MusicType $entity)
//    {
//        $form = $this->createForm(new MusicTypeType(), $entity, array(
//            'action' => $this->generateUrl('front_musictype_create'),
//            'method' => 'POST',
//        ));
//
//        $form->add('submit', 'submit', array('label' => /** @Ignore */ 'Create'));
//
//        return $form;
//    }
//
//    /**
//     * Displays a form to create a new MusicType entity.
//     *
//     */
//    public function newAction()
//    {
//        $entity = new MusicType();
//        $form   = $this->createCreateForm($entity);
//
//        return $this->render('FrontFrontBundle:MusicType:new.html.twig', array(
//            'entity' => $entity,
//            'form'   => $form->createView(),
//        ));
//    }
//
//    /**
//     * Finds and displays a MusicType entity.
//     *
//     */
//    public function showAction($id)
//    {
//        $em = $this->getDoctrine()->getManager();
//
//        $entity = $em->getRepository('FrontFrontBundle:MusicType')->find($id);
//
//        if (!$entity) {
//            throw $this->createNotFoundException('Unable to find MusicType entity.');
//        }
//
//        $deleteForm = $this->createDeleteForm($id);
//
//        return $this->render('FrontFrontBundle:MusicType:show.html.twig', array(
//            'entity'      => $entity,
//            'delete_form' => $deleteForm->createView(),
//        ));
//    }
//
//    /**
//     * Displays a form to edit an existing MusicType entity.
//     *
//     */
//    public function editAction($id)
//    {
//        $em = $this->getDoctrine()->getManager();
//
//        $entity = $em->getRepository('FrontFrontBundle:MusicType')->find($id);
//
//        if (!$entity) {
//            throw $this->createNotFoundException('Unable to find MusicType entity.');
//        }
//
//        $editForm = $this->createEditForm($entity);
//        $deleteForm = $this->createDeleteForm($id);
//
//        return $this->render('FrontFrontBundle:MusicType:edit.html.twig', array(
//            'entity'      => $entity,
//            'edit_form'   => $editForm->createView(),
//            'delete_form' => $deleteForm->createView(),
//        ));
//    }
//
//    /**
//    * Creates a form to edit a MusicType entity.
//    *
//    * @param MusicType $entity The entity
//    *
//    * @return \Symfony\Component\Form\Form The form
//    */
//    private function createEditForm(MusicType $entity)
//    {
//        $form = $this->createForm(new MusicTypeType(), $entity, array(
//            'action' => $this->generateUrl('front_musictype_update', array('id' => $entity->getId())),
//            'method' => 'PUT',
//        ));
//
//        $form->add('submit', 'submit', array('label' => /** @Ignore */ 'Update'));
//
//        return $form;
//    }
//    /**
//     * Edits an existing MusicType entity.
//     *
//     */
//    public function updateAction(Request $request, $id)
//    {
//        $em = $this->getDoctrine()->getManager();
//
//        $entity = $em->getRepository('FrontFrontBundle:MusicType')->find($id);
//
//        if (!$entity) {
//            throw $this->createNotFoundException('Unable to find MusicType entity.');
//        }
//
//        $deleteForm = $this->createDeleteForm($id);
//        $editForm = $this->createEditForm($entity);
//        $editForm->handleRequest($request);
//
//        if ($editForm->isValid()) {
//            $em->flush();
//
//            return $this->redirect($this->generateUrl('front_musictype_edit', array('id' => $id)));
//        }
//
//        return $this->render('FrontFrontBundle:MusicType:edit.html.twig', array(
//            'entity'      => $entity,
//            'edit_form'   => $editForm->createView(),
//            'delete_form' => $deleteForm->createView(),
//        ));
//    }
//    /**
//     * Deletes a MusicType entity.
//     *
//     */
//    public function deleteAction(Request $request, $id)
//    {
//        $form = $this->createDeleteForm($id);
//        $form->handleRequest($request);
//
//        if ($form->isValid()) {
//            $em = $this->getDoctrine()->getManager();
//            $entity = $em->getRepository('FrontFrontBundle:MusicType')->find($id);
//
//            if (!$entity) {
//                throw $this->createNotFoundException('Unable to find MusicType entity.');
//            }
//
//            $em->remove($entity);
//            $em->flush();
//        }
//
//        return $this->redirect($this->generateUrl('front_musictype'));
//    }
//
//    /**
//     * Creates a form to delete a MusicType entity by id.
//     *
//     * @param mixed $id The entity id
//     *
//     * @return \Symfony\Component\Form\Form The form
//     */
//    private function createDeleteForm($id)
//    {
//        return $this->createFormBuilder()
//            ->setAction($this->generateUrl('front_musictype_delete', array('id' => $id)))
//            ->setMethod('DELETE')
//            ->add('submit', 'submit', array('label' => /** @Ignore */ 'Delete'))
//            ->getForm()
//        ;
//    }
}
