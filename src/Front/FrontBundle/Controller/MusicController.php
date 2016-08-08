<?php

namespace Front\FrontBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Front\FrontBundle\Entity\Music;
use Front\FrontBundle\Form\MusicType;
use Front\FrontBundle\Form\MusicFilterType;
use Symfony\Component\HttpFoundation\Response;

/**
 * Music controller.
 *
 */
class MusicController extends Controller {
    
    /**
     * Lists all Music entities.
     *
     */
    public function indexAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        
        $page = $this->getDoctrine()->getRepository('AdminAdminBundle:Page')->findOneByName('musics');
        if (!$page)
            throw new \Exception('Page not found!');

        $query = $em->getRepository('FrontFrontBundle:Music')->findForMusicIndex(); 
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $query, $request->query->get('page', 1), $this->getParameter('pagination_line_number')
        );

        $filterForm = $this->createFilterMusicForm();
        $filterForm->handleRequest($request);

        return $this->render('FrontFrontBundle:Music:index.html.twig', array(
                    'page' => $page,
                    'pagination' => $pagination,
                    'filterForm' => $filterForm->createView(),
        ));
    }

    public function filterMusicAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        
        $page = $this->getDoctrine()->getRepository('AdminAdminBundle:Page')->findOneByName('musics');
        if (!$page)
            throw new \Exception('Page not found!');

        $filterForm = $this->createFilterMusicForm();
        $filterForm->handleRequest($request);

        $filterData = array();

        if ($filterForm->isValid()) {
            $filterData = $filterForm->getData();
        }

        $query = $em->getRepository('FrontFrontBundle:Music')->filter($filterData, $request->getLocale());

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $query, $request->query->get('page', 1), $this->getParameter('pagination_line_number')
        );

        return $this->render('FrontFrontBundle:Music:index.html.twig', array(
                    'page' => $page,
                    'pagination' => $pagination,
                    'filterForm' => $filterForm->createView(),
        ));
    }
    
    private function createFilterMusicForm() {
        $form = $this->createForm(new MusicFilterType(), null, array(
            'action' => $this->generateUrl('front_music_filter'),
            'method' => 'GET',
        ));

        return $form;
    }

    private function findUser($id) {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('UserUserBundle:User')->find($id);
        if (!$user)
            throw $this->createNotFoundException('Unable to find User entity.');
        return $user;
    }

    /**
     * Creates a new Music entity.
     *
     */
    public function createAction(Request $request, $id) {

        if (!$this->getUser())
            return $this->redirect($this->generateUrl('fos_user_security_login'));

        $user = $this->findUser($id);

        $music = new Music();
        $music->setUser($user);
        $music->setCreatedAt(new \DateTime());
        $form = $this->createCreateForm($music, $id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $music->setName($music->getTitle());
            $em->persist($music);
            $em->flush();

            $user = $music->getUser();
            if ($user)
                return $this->redirect($this->generateUrl('front_music_show_with_buttons', array('id' => $music->getId())));
        }

        return $this->render('FrontFrontBundle:Music:new.html.twig', array(
                    'music' => $music,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Music entity.
     *
     * @param Music $music The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Music $music, $id) {
        $form = $this->createForm(new MusicType(), $music, array(
            'attr' => array('locale' => $this->get('request')->getLocale()),
            'action' => $this->generateUrl('front_music_create', array('id' => $id)),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => /** @Ignore */ $this->get('translator')->trans('create'), 'attr' => array('class' => 'btn btn-success btn-md pull-left')));

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

        $music = new Music();
        $music->setUser($user);
        $form = $this->createCreateForm($music, $user->getId());

        return $this->render('FrontFrontBundle:Music:new.html.twig', array(
                    'music' => $music,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Music entity.
     *
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $music = $em->getRepository('FrontFrontBundle:Music')->find($id);

        if (!$music) {
            throw $this->createNotFoundException('Unable to find Music entity.');
        }

        return $this->render('FrontFrontBundle:Music:show.html.twig', array(
                    'music' => $music,
        ));
    }
    
    public function showWithButtonsAction($id) {
        $em = $this->getDoctrine()->getManager();
        
        if (!$this->getUser())
            return $this->redirect($this->generateUrl('fos_user_security_login'));

        $music = $em->getRepository('FrontFrontBundle:Music')->find($id);

        if (!$music) {
            throw $this->createNotFoundException('Unable to find Music entity.');
        }

        return $this->render('FrontFrontBundle:Music:showWithButtons.html.twig', array(
                    'music' => $music,
        ));
    }

    /**
     * Displays a form to edit an existing Music entity.
     *
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();
        
        if (!$this->getUser())
            return $this->redirect($this->generateUrl('fos_user_security_login'));

        $music = $em->getRepository('FrontFrontBundle:Music')->find($id);

        if (!$music) {
            throw $this->createNotFoundException('Unable to find Music entity.');
        }

        if (!$this->getUser() or $music->getUser() != $this->getUser())
            return new Response('', 403);

        $editForm = $this->createEditForm($music);

        return $this->render('FrontFrontBundle:Music:edit.html.twig', array(
                    'music' => $music,
                    'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Music entity.
     *
     * @param Music $music The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Music $music) {
        $form = $this->createForm(new MusicType(), $music, array(
                        'attr' => array('locale' => $this->get('request')->getLocale()),
            'action' => $this->generateUrl('front_music_update', array('id' => $music->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => /** @Ignore */ 'Update'));

        return $form;
    }

    /**
     * Edits an existing Music entity.
     *
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
        
        if (!$this->getUser())
            return $this->redirect($this->generateUrl('fos_user_security_login'));

        $music = $em->getRepository('FrontFrontBundle:Music')->find($id);

        if (!$music) {
            throw $this->createNotFoundException('Unable to find Music entity.');
        }
        
        if (!$this->getUser() or $music->getUser() != $this->getUser())
            return new Response('', 403);

        $editForm = $this->createEditForm($music);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $music->setName($music->getTitle());
            $em->persist($music);
            $em->flush();

            return $this->redirect($this->generateUrl('front_music_show_with_buttons', array('id' => $id)));
        }

        return $this->render('FrontFrontBundle:Music:edit.html.twig', array(
                    'music' => $music,
                    'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a Music entity.
     *
     */
    public function deleteAction(Request $request, $id) {
        if (!$this->getUser())
            return $this->redirect($this->generateUrl('fos_user_security_login'));

        $em = $this->getDoctrine()->getManager();
        $music = $em->getRepository('FrontFrontBundle:Music')->find($id);

        if (!$music) {
            throw $this->createNotFoundException('Unable to find Music entity.');
        }
        
        if(!$this->getUser()->getMusics()->contains($music)){
            throw $this->createNotFoundException('Error : not yours.');
        }

        $em->remove($music);
        $em->flush();


        return new Response('', 200);
    }
    
    
    public function loveAction(Request $request, $id) {

        if (!$this->getUser())
            return $this->redirect($this->generateUrl('fos_user_security_login'));

        $em = $this->getDoctrine()->getManager();
        $music = $em->getRepository('FrontFrontBundle:Music')->find($id);

        if (!$music) {
            throw $this->createNotFoundException('Unable to find Music entity.');
        }
        if (!$music->getLovesMe()->contains($this->getUser()))
            $music->addLovesMe($this->getUser());

        $em->persist($music);
        $em->flush();
        $em->refresh($music);

        return $this->render('FrontFrontBundle:Music:linkLoveMusic.html.twig', array(
                    'music' => $music,
        ));
    }

    public function unloveAction(Request $request, $id) {

        if (!$this->getUser())
            return $this->redirect($this->generateUrl('fos_user_security_login'));

        $em = $this->getDoctrine()->getManager();
        $music = $em->getRepository('FrontFrontBundle:Music')->find($id);

        if (!$music) {
            throw $this->createNotFoundException('Unable to find Music entity.');
        }

        $User = $this->getUser();
        if ($User->getMusicloves()->contains($music))
            $User->removeMusiclove($music);

        $em->persist($User);
        $em->flush();
        $em->refresh($music);

        return $this->render('FrontFrontBundle:Music:linkLoveMusic.html.twig', array(
                    'music' => $music,
        ));
    }

}
