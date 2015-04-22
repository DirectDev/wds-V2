<?php

namespace Admin\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Front\FrontBundle\Entity\EventDate;
use Admin\AdminBundle\Form\EventDateType;

/**
 * EventDate controller.
 *
 */
class EventDateController extends Controller
{

    /**
     * Lists all EventDate entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('FrontFrontBundle:EventDate')->findAll();

        return $this->render('AdminAdminBundle:EventDate:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new EventDate entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new EventDate();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_eventdate_show', array('id' => $entity->getId())));
        }

        return $this->render('AdminAdminBundle:EventDate:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a EventDate entity.
     *
     * @param EventDate $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(EventDate $entity)
    {
        $form = $this->createForm(new EventDateType(), $entity, array(
            'action' => $this->generateUrl('admin_eventdate_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new EventDate entity.
     *
     */
    public function newAction()
    {
        $entity = new EventDate();
        $form   = $this->createCreateForm($entity);

        return $this->render('AdminAdminBundle:EventDate:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a EventDate entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FrontFrontBundle:EventDate')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EventDate entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AdminAdminBundle:EventDate:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing EventDate entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FrontFrontBundle:EventDate')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EventDate entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AdminAdminBundle:EventDate:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a EventDate entity.
    *
    * @param EventDate $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(EventDate $entity)
    {
        $form = $this->createForm(new EventDateType(), $entity, array(
            'action' => $this->generateUrl('admin_eventdate_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing EventDate entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FrontFrontBundle:EventDate')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EventDate entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_eventdate_edit', array('id' => $id)));
        }

        return $this->render('AdminAdminBundle:EventDate:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a EventDate entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('FrontFrontBundle:EventDate')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find EventDate entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_eventdate'));
    }

    /**
     * Creates a form to delete a EventDate entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_eventdate_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
