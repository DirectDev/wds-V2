<?php

namespace Admin\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Front\FrontBundle\Entity\EventFile;
use Admin\AdminBundle\Form\EventFileType;
use Admin\AdminBundle\Form\EventFileFilterType;

/**
 * EventFile controller.
 *
 */
class EventFileController extends Controller {

    public function indexAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $query = $em->getRepository('FrontFrontBundle:EventFile')->findForAdmin($request->getLocale());
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $query, $request->query->get('page', 1), $this->getParameter('admin_pagination_line_number')
        );

        $filterForm = $this->createFilterForm();
        $filterForm->handleRequest($request);

        return $this->render('AdminAdminBundle:EventFile:index.html.twig', array(
                    'pagination' => $pagination,
                    'filterForm' => $filterForm->createView(),
        ));
    }

    private function createFilterForm() {
        $form = $this->createForm(new EventFileFilterType(), null, array(
            'action' => $this->generateUrl('admin_event_file_filter'),
            'method' => 'GET',
        ));

        return $form;
    }

    public function filterAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $filterForm = $this->createFilterForm();
        $filterForm->handleRequest($request);

        $filterData = array();

        if ($filterForm->isValid()) {
            $filterData = $filterForm->getData();
        }

        $query = $em->getRepository('FrontFrontBundle:EventFile')->filterAdmin($filterData, $request->getLocale());

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $query, $request->query->get('page', 1), $this->getParameter('admin_pagination_line_number')
        );

        return $this->render('AdminAdminBundle:EventFile:index.html.twig', array(
                    'pagination' => $pagination,
                    'filterForm' => $filterForm->createView(),
        ));
    }

    /**
     * Creates a new EventFile entity.
     *
     */
    public function createAction(Request $request) {
        $entity = new EventFile();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_event_file_show', array('id' => $entity->getId())));
        }

        return $this->render('AdminAdminBundle:EventFile:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a EventFile entity.
     *
     * @param EventFile $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(EventFile $entity) {
        $form = $this->createForm(new EventFileType(), $entity, array(
            'action' => $this->generateUrl('admin_event_file_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new EventFile entity.
     *
     */
    public function newAction() {
        $entity = new EventFile();
        $form = $this->createCreateForm($entity);

        return $this->render('AdminAdminBundle:EventFile:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a EventFile entity.
     *
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FrontFrontBundle:EventFile')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EventFile entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AdminAdminBundle:EventFile:show.html.twig', array(
                    'entity' => $entity,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing EventFile entity.
     *
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FrontFrontBundle:EventFile')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EventFile entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AdminAdminBundle:EventFile:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a EventFile entity.
     *
     * @param EventFile $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(EventFile $entity) {
        $form = $this->createForm(new EventFileType(), $entity, array(
            'action' => $this->generateUrl('admin_event_file_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing EventFile entity.
     *
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FrontFrontBundle:EventFile')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EventFile entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_event_file_edit', array('id' => $id)));
        }

        return $this->render('AdminAdminBundle:EventFile:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a EventFile entity.
     *
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('FrontFrontBundle:EventFile')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find EventFile entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_event_file'));
    }

    /**
     * Creates a form to delete a EventFile entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('admin_event_file_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('submit', 'submit', array('label' => 'Delete'))
                        ->getForm()
        ;
    }

}
