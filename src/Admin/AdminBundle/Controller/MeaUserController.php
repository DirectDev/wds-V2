<?php

namespace Admin\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Front\FrontBundle\Entity\MeaUser;
use Admin\AdminBundle\Form\MeaUserType;
use Admin\AdminBundle\Form\MeaUserFilterType;

/**
 * MeaUser controller.
 *
 */
class MeaUserController extends Controller
{

    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        
        $query = $em->getRepository('FrontFrontBundle:MeaUser')->findForAdmin( $request->getLocale()); 
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $query, $request->query->get('page', 1), $this->getParameter('admin_pagination_line_number')
        );

        $filterForm = $this->createFilterForm();
        $filterForm->submit($request);

        return $this->render('AdminAdminBundle:MeaUser:index.html.twig', array(
                    'pagination' => $pagination,
                    'filterForm' => $filterForm->createView(),
        ));
    }
    
    private function createFilterForm() {
        $form = $this->createForm(new MeaUserFilterType(), null, array(
            'action' => $this->generateUrl('admin_mea_user_filter'),
            'method' => 'GET',
        ));

        return $form;
    }
    
    public function filterAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        
        $filterForm = $this->createFilterForm();
        $filterForm->submit($request);

        $filterData = array();

        if ($filterForm->isValid()) {
            $filterData = $filterForm->getData();
        }

        $query = $em->getRepository('FrontFrontBundle:MeaUser')->filterAdmin($filterData, $request->getLocale());

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $query, $request->query->get('page', 1), $this->getParameter('admin_pagination_line_number')
        );

        return $this->render('AdminAdminBundle:MeaUser:index.html.twig', array(
                    'pagination' => $pagination,
                    'filterForm' => $filterForm->createView(),
        ));
    }
    /**
     * Creates a new MeaUser entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new MeaUser();
        $form = $this->createCreateForm($entity);
        $form->submit($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_mea_user_show', array('id' => $entity->getId())));
        }

        return $this->render('AdminAdminBundle:MeaUser:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a MeaUser entity.
     *
     * @param MeaUser $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(MeaUser $entity)
    {
        $form = $this->createForm(new MeaUserType(), $entity, array(
            'action' => $this->generateUrl('admin_mea_user_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new MeaUser entity.
     *
     */
    public function newAction()
    {
        $entity = new MeaUser();
        $form   = $this->createCreateForm($entity);

        return $this->render('AdminAdminBundle:MeaUser:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a MeaUser entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FrontFrontBundle:MeaUser')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find MeaUser entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AdminAdminBundle:MeaUser:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing MeaUser entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FrontFrontBundle:MeaUser')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find MeaUser entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AdminAdminBundle:MeaUser:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a MeaUser entity.
    *
    * @param MeaUser $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(MeaUser $entity)
    {
        $form = $this->createForm(new MeaUserType(), $entity, array(
            'action' => $this->generateUrl('admin_mea_user_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing MeaUser entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FrontFrontBundle:MeaUser')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find MeaUser entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->submit($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_mea_user_edit', array('id' => $id)));
        }

        return $this->render('AdminAdminBundle:MeaUser:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a MeaUser entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->submit($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('FrontFrontBundle:MeaUser')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find MeaUser entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_mea_user'));
    }

    /**
     * Creates a form to delete a MeaUser entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_mea_user_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
