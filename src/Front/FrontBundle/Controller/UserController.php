<?php

namespace Front\FrontBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use User\UserBundle\Entity\User;
use Front\FrontBundle\Form\UserType;
use User\UserBundle\Entity\UserFile;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * User controller.
 *
 */
class UserController extends Controller {


    /**
     * Finds and displays a User entity.
     *
     */
    public function showPublicAction($username, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UserUserBundle:User')->findOneById($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        return $this->render('FrontFrontBundle:User:showPrivate.html.twig', array(
                    'user' => $entity,
                ));
    }

    /**
     * Finds and displays a User entity.
     *
     */
    public function showPrivateAction() {
        
        if(!$this->getUser())
            return $this->redirect($this->generateUrl('fos_user_security_login'));

        $entity = $this->get('security.context')->getToken()->getUser();
        if (!$entity)
            return new Response('', 404);

        /*
         * UPLOAD FILE FORM
         * remplacer le User par entite souhaitee
         * ajouter au render  
          'editId' => $editId,
          'existingFiles' => $existingFiles,
         * ajouter fonction handleFiles
         * 
         */
        $editId = $this->getRequest()->get('editId');
        $arrayFile = $this->handleFiles($entity, $this->getRequest()->get('editId'));
        $editId = $arrayFile ['editId'];
        $existingFiles = $arrayFile ['existingFiles'];
        /*
         * UPLOAD FILE FORM END
         */


        return $this->render('FrontFrontBundle:User:showPrivate.html.twig', array(
                    'user' => $entity,
                    'editId' => $editId,
                    'existingFiles' => $existingFiles,
                ));
    }

    /**
     * Displays a form to edit an existing User entity.
     *
     */
    public function editAction($id) {
        
        if(!$this->getUser())
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UserUserBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        $editForm = $this->createEditForm($entity);


        /*
         * UPLOAD FILE FORM
         * remplacer le User par entite souhaitee
         * ajouter au render  
          'editId' => $editId,
          'existingFiles' => $existingFiles,
         * ajouter fonction handleFiles
         * 
         */
        $editId = $this->getRequest()->get('editId');
        $arrayFile = $this->handleFiles($entity, $this->getRequest()->get('editId'));
        $editId = $arrayFile ['editId'];
        $existingFiles = $arrayFile ['existingFiles'];
        /*
         * UPLOAD FILE FORM END
         */

        return $this->render('FrontFrontBundle:User:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'editId' => $editId,
                    'existingFiles' => $existingFiles,
                ));
    }

    /**
     * Creates a form to edit a User entity.
     *
     * @param User $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(User $entity) {
        $form = $this->createForm(new UserType(), $entity, array(
            'action' => $this->generateUrl('front_user_update', array('id' => $entity->getId())),
            'method' => 'PUT',
            'attr' => array('locale' => $this->get('request')->getLocale())
                ));

        $form->add('submit', 'submit', array('label' => $this->get('translator')->trans('update'), 'attr' => array('class' => 'btn btn-success btn-lg pull-right')));

        return $form;
    }

    /**
     * Edits an existing User entity.
     *
     */
    public function updateAction(Request $request, $id) {
        
        if(!$this->getUser())
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UserUserBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }
        
        $originalAddresses = new ArrayCollection();
        foreach ($entity->getAddresses() as $address) 
            $originalAddresses->add($address);

        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            
            foreach ($originalAddresses as $address) 
                if ($entity->getAddresses()->contains($address) == false) 
                     $em->remove($address);
            
            $em->flush();
            
            try {
                $em->refresh($entity);
                $address = $entity->getAddress();
                $this->setLatitudeAndLongitude($address);
                $em->persist($address);
                $em->flush();
            } catch (\Exception $e) {
                
            }

            return $this->redirect($this->generateUrl('front_user_show_private', array('id' => $id)));
        }

        return $this->render('FrontFrontBundle:User:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                ));
    }


    private function handleFiles($entity, $editId = null) {
        /*
         * UPLOAD FILE FORM
         * remplacer le User par entite souhaitee
         *  Voir ajout dans showAction
         * 
         */

        $entityName = substr(get_class($entity), (strrpos(get_class($entity), "\\", -1)) + 1) . 'File';
        $arrayFile = $this->get('image_bundle.get_editiId_and_existingFiles')->getEditIdAndExistingFiles(
                array(
                    'editId' => $editId,
                    'entityName' => $entityName,
                    'entityId' => $entity->getId(),
                )
        );

        $editId = $arrayFile ['editId'];
        $existingFiles = $arrayFile ['existingFiles'];

        $em = $this->getDoctrine()->getManager();

        foreach ($existingFiles as $file_name) {
            $UserFile = $em->getRepository('UserUserBundle:UserFile')->findOneBy(array('name' => $file_name, 'user' => $entity));
            if (!$UserFile) {
                $UserFile = new UserFile();
                $UserFile->setName($file_name)
                        ->setUser($entity);
                $em->persist($UserFile);
            }
        }
        foreach ($entity->getUserFiles() as $UserFile)
            if (!in_array($UserFile->getName(), $existingFiles))
                $em->remove($UserFile);

        $em->flush();

        $this->get('punk_ave.file_uploader')->removeFiles(array('folder' => 'attachments/' . $editId));

        return $arrayFile;
        /*
         * UPLOAD FILE FORM END
         */
    }
    
    private function setLatitudeAndLongitude($entity) {
        try {
            
            if(!$entity OR !$entity->stringForGoogleMaps())
                return;
            
            $geocode = $this->container
                    ->get('bazinga_geocoder.geocoder')
                    ->using('google_maps')
                    ->geocode($entity->stringForGoogleMaps());

            $entity->setLatitude($geocode['latitude']);
            $entity->setLongitude($geocode['longitude']);
            
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function importFacebookEventAction() {

        $user = $this->get('security.context')->getToken()->getUser();
        if (!$user)
            return new Response('', 404);

        $facebookServices = $this->get('facebook.services');
        $facebookServices->importEvents();

        return new Response();
    }

}
