<?php

namespace Admin\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Front\FrontBundle\Entity\MeaFestival;
use Admin\AdminBundle\Form\MeaFestivalType;
use Admin\AdminBundle\Form\MeaFestivalFilterType;

/**
 * MeaFestival controller.
 *
 */
class MeaFestivalController extends Controller
{

    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        
        $query = $em->getRepository('FrontFrontBundle:MeaFestival')->findForAdmin( $request->getLocale()); 
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $query, $request->query->get('page', 1), $this->getParameter('admin_pagination_line_number')
        );

        $filterForm = $this->createFilterForm();
        $filterForm->handleRequest($request);

        return $this->render('AdminAdminBundle:MeaFestival:index.html.twig', array(
                    'pagination' => $pagination,
                    'filterForm' => $filterForm->createView(),
        ));
    }
    
    private function createFilterForm() {
        $form = $this->createForm(new MeaFestivalFilterType(), null, array(
            'action' => $this->generateUrl('admin_mea_festival_filter'),
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

        $query = $em->getRepository('FrontFrontBundle:MeaFestival')->filterAdmin($filterData, $request->getLocale());

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $query, $request->query->get('page', 1), $this->getParameter('admin_pagination_line_number')
        );

        return $this->render('AdminAdminBundle:MeaFestival:index.html.twig', array(
                    'pagination' => $pagination,
                    'filterForm' => $filterForm->createView(),
        ));
    }
    /**
     * Creates a new MeaFestival entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new MeaFestival();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_mea_festival_show', array('id' => $entity->getId())));
        }

        return $this->render('AdminAdminBundle:MeaFestival:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a MeaFestival entity.
     *
     * @param MeaFestival $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(MeaFestival $entity)
    {
        $form = $this->createForm(new MeaFestivalType(), $entity, array(
            'action' => $this->generateUrl('admin_mea_festival_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new MeaFestival entity.
     *
     */
    public function newAction()
    {
        $entity = new MeaFestival();
        $form   = $this->createCreateForm($entity);

        return $this->render('AdminAdminBundle:MeaFestival:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a MeaFestival entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FrontFrontBundle:MeaFestival')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find MeaFestival entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AdminAdminBundle:MeaFestival:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing MeaFestival entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FrontFrontBundle:MeaFestival')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find MeaFestival entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AdminAdminBundle:MeaFestival:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a MeaFestival entity.
    *
    * @param MeaFestival $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(MeaFestival $entity)
    {
        $form = $this->createForm(new MeaFestivalType(), $entity, array(
            'action' => $this->generateUrl('admin_mea_festival_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing MeaFestival entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FrontFrontBundle:MeaFestival')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find MeaFestival entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_mea_festival_edit', array('id' => $id)));
        }

        return $this->render('AdminAdminBundle:MeaFestival:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a MeaFestival entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('FrontFrontBundle:MeaFestival')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find MeaFestival entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_mea_festival'));
    }

    /**
     * Creates a form to delete a MeaFestival entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_mea_festival_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
