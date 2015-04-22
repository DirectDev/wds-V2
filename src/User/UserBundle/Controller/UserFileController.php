<?php

namespace User\UserBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use User\UserBundle\Entity\UserFile;
use User\UserBundle\Form\UserFileType;

/**
 * UserFile controller.
 *
 */
class UserFileController extends Controller
{

    /**
     * Lists all UserFile entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('UserUserBundle:UserFile')->findAll();

        return $this->render('UserUserBundle:UserFile:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new UserFile entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new UserFile();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_userfile_show', array('id' => $entity->getId())));
        }

        return $this->render('UserUserBundle:UserFile:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a UserFile entity.
     *
     * @param UserFile $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(UserFile $entity)
    {
        $form = $this->createForm(new UserFileType(), $entity, array(
            'action' => $this->generateUrl('admin_userfile_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new UserFile entity.
     *
     */
    public function newAction()
    {
        $entity = new UserFile();
        $form   = $this->createCreateForm($entity);

        return $this->render('UserUserBundle:UserFile:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a UserFile entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UserUserBundle:UserFile')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find UserFile entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('UserUserBundle:UserFile:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing UserFile entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UserUserBundle:UserFile')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find UserFile entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('UserUserBundle:UserFile:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a UserFile entity.
    *
    * @param UserFile $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(UserFile $entity)
    {
        $form = $this->createForm(new UserFileType(), $entity, array(
            'action' => $this->generateUrl('admin_userfile_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing UserFile entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UserUserBundle:UserFile')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find UserFile entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_userfile_edit', array('id' => $id)));
        }

        return $this->render('UserUserBundle:UserFile:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a UserFile entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('UserUserBundle:UserFile')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find UserFile entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_userfile'));
    }

    /**
     * Creates a form to delete a UserFile entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_userfile_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
