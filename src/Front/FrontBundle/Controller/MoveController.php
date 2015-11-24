<?php

namespace Front\FrontBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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

        if (!$this->getUser())
            return $this->redirect($this->generateUrl('fos_user_security_login'));

        $move = new Move();
        $form = $this->createCreateForm($move);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $move->setUser($this->getUser());
            $em->persist($move);
            $em->flush();

            $user = $move->getUser();
            if ($user)
                return $this->redirect($this->generateUrl('front_move_show_with_buttons', array('id' => $move->getId())));
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

        return $this->render('FrontFrontBundle:Move:show.html.twig', array(
                    'move' => $move,
        ));
    }

    public function showWithButtonsAction($id) {
        $em = $this->getDoctrine()->getManager();

        $move = $em->getRepository('FrontFrontBundle:Move')->find($id);

        if (!$move) {
            throw $this->createNotFoundException('Unable to find Move entity.');
        }


        return $this->render('FrontFrontBundle:Move:showWithButtons.html.twig', array(
                    'move' => $move,
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

        return $this->render('FrontFrontBundle:Move:edit.html.twig', array(
                    'move' => $move,
                    'edit_form' => $editForm->createView(),
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
              
        if (!$this->getUser())
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        
        $em = $this->getDoctrine()->getManager();

        $move = $em->getRepository('FrontFrontBundle:Move')->find($id);

        if (!$move) {
            throw $this->createNotFoundException('Unable to find Move entity.');
        }

        $editForm = $this->createEditForm($move);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('front_move_show_with_buttons', array('id' => $id)));
        }

        return $this->render('FrontFrontBundle:Move:edit.html.twig', array(
                    'move' => $move,
                    'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a Move entity.
     *
     */
    public function deleteAction(Request $request, $id) {
        if (!$this->getUser())
            return $this->redirect($this->generateUrl('fos_user_security_login'));

        $em = $this->getDoctrine()->getManager();
        $move = $em->getRepository('FrontFrontBundle:Move')->find($id);

        if (!$move) {
            throw $this->createNotFoundException('Unable to find Move entity.');
        }

        if (!$this->getUser()->getMoves()->contains($move)) {
            throw $this->createNotFoundException('Error : not yours.');
        }

        $em->remove($move);
        $em->flush();

        return new Response('', 200);
    }

}
