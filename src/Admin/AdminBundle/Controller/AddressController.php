<?php

namespace Admin\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Front\FrontBundle\Entity\Address;
use Admin\AdminBundle\Form\AddressType;
use Admin\AdminBundle\Form\AddressFilterType;

/**
 * Address controller.
 *
 */
class AddressController extends Controller {

    public function indexAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $query = $em->getRepository('FrontFrontBundle:Address')->findForAdmin($request->getLocale());
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $query, $request->query->get('page', 1), $this->getParameter('admin_pagination_line_number')
        );

        $filterForm = $this->createFilterForm();
        $filterForm->submit($request);

        return $this->render('AdminAdminBundle:Address:index.html.twig', array(
                    'pagination' => $pagination,
                    'filterForm' => $filterForm->createView(),
        ));
    }

    private function createFilterForm() {
        $form = $this->createForm(new AddressFilterType(), null, array(
            'action' => $this->generateUrl('admin_address_filter'),
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

        $query = $em->getRepository('FrontFrontBundle:Address')->filterAdmin($filterData, $request->getLocale());

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $query, $request->query->get('page', 1), $this->getParameter('admin_pagination_line_number')
        );

        return $this->render('AdminAdminBundle:Address:index.html.twig', array(
                    'pagination' => $pagination,
                    'filterForm' => $filterForm->createView(),
        ));
    }

    /**
     * Creates a new Address entity.
     *
     */
    public function createAction(Request $request) {
        $entity = new Address();
        $form = $this->createCreateForm($entity);
        $form->submit($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            try {
                $em->refresh($entity);
                $this->setLatitudeAndLongitude($entity);
                $em->persist($entity);
                $em->flush();
            } catch (\Exception $e) {
                
            }

            return $this->redirect($this->generateUrl('admin_address_show', array('id' => $entity->getId())));
        }

        return $this->render('AdminAdminBundle:Address:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Address entity.
     *
     * @param Address $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Address $entity) {
        $form = $this->createForm(new AddressType(), $entity, array(
            'action' => $this->generateUrl('admin_address_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Address entity.
     *
     */
    public function newAction() {
        $entity = new Address();
        $form = $this->createCreateForm($entity);

        return $this->render('AdminAdminBundle:Address:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Address entity.
     *
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FrontFrontBundle:Address')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Address entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AdminAdminBundle:Address:show.html.twig', array(
                    'entity' => $entity,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Address entity.
     *
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FrontFrontBundle:Address')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Address entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AdminAdminBundle:Address:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Address entity.
     *
     * @param Address $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Address $entity) {
        $form = $this->createForm(new AddressType(), $entity, array(
            'action' => $this->generateUrl('admin_address_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing Address entity.
     *
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FrontFrontBundle:Address')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Address entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->submit($request);

        if ($editForm->isValid()) {

            try {
                $this->setLatitudeAndLongitude($entity);
                $em->persist($entity);
                $em->flush();
            } catch (\Exception $e) {
                
            }

            $em->flush();

            return $this->redirect($this->generateUrl('admin_address_edit', array('id' => $id)));
        }

        return $this->render('AdminAdminBundle:Address:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Address entity.
     *
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->submit($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('FrontFrontBundle:Address')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Address entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_address'));
    }

    /**
     * Creates a form to delete a Address entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('admin_address_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('submit', 'submit', array('label' => 'Delete'))
                        ->getForm()
        ;
    }

    private function setLatitudeAndLongitude($entity = null) {
        if (!$entity)
            return;
        try {
            $geocodeAddresses = $this->container
                    ->get('bazinga_geocoder.geocoder')
                    ->using('google_maps')
                    ->geocode($entity->stringForGoogleMaps());

            if (!count($geocodeAddresses))
                return;

            foreach ($geocodeAddresses as $geocodeAddress) {
                $entity->setLatitude($geocodeAddress->getLatitude());
                $entity->setLongitude($geocodeAddress->getLongitude());
                return;
            }
        } catch (\Exception $e) {
            throw $e;
        }
    }

}
