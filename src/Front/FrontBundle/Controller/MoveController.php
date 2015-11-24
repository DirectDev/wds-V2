<?php

namespace Front\FrontBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Front\FrontBundle\Entity\Move;
use Front\FrontBundle\Form\MoveType;

/**
 * Move controller.
 *
 */
class MoveController extends Controller {

    /**
     * Lists all Move entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $moves = $em->getRepository('FrontFrontBundle:Move')->findAll();

        return $this->render('FrontFrontBundle:Move:moves.html.twig', array(
                    'moves' => $moves,
        ));
    }

    /**
     * Creates a new Move entity.
     *
     */
    public function createAction(Request $request) {
        $move = new Move();
        $form = $this->createCreateForm($move);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($move);
            $em->flush();

            return $this->redirect($this->generateUrl('front_move_show', array('id' => $move->getId())));
        }

        return $this->render('FrontFrontBundle:Move:new.html.twig', array(
                    'move' => $move,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Move entity.
     *
     * @param Move $move The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Move $move) {
        $form = $this->createForm(new MoveType(), $move, array(
            'action' => $this->generateUrl('front_move_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => /** @Ignore */ 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Move entity.
     *
     */
    public function newAction() {
        $move = new Move();
        $form = $this->createCreateForm($move);

        return $this->render('FrontFrontBundle:Move:new.html.twig', array(
                    'move' => $move,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Move entity.
     *
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $move = $em->getRepository('FrontFrontBundle:Move')->find($id);

        if (!$move) {
            throw $this->createNotFoundException('Unable to find Move entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('FrontFrontBundle:Move:show.html.twig', array(
                    'move' => $move,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Move entity.
     *
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $move = $em->getRepository('FrontFrontBundle:Move')->find($id);

        if (!$move) {
            throw $this->createNotFoundException('Unable to find Move entity.');
        }

        $editForm = $this->createEditForm($move);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('FrontFrontBundle:Move:edit.html.twig', array(
                    'move' => $move,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Move entity.
     *
     * @param Move $move The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Move $move) {
        $form = $this->createForm(new MoveType(), $move, array(
            'action' => $this->generateUrl('front_move_update', array('id' => $move->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => /** @Ignore */ 'Update'));

        return $form;
    }

    /**
     * Edits an existing Move entity.
     *
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $move = $em->getRepository('FrontFrontBundle:Move')->find($id);

        if (!$move) {
            throw $this->createNotFoundException('Unable to find Move entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($move);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('front_move_edit', array('id' => $id)));
        }

        return $this->render('FrontFrontBundle:Move:edit.html.twig', array(
                    'move' => $move,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Move entity.
     *
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $move = $em->getRepository('FrontFrontBundle:Move')->find($id);

            if (!$move) {
                throw $this->createNotFoundException('Unable to find Move entity.');
            }

            $em->remove($move);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('front_move'));
    }

    /**
     * Creates a form to delete a Move entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('front_move_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('submit', 'submit', array('label' => /** @Ignore */ 'Delete'))
                        ->getForm()
        ;
    }

}
