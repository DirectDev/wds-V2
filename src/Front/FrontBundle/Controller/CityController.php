<?php

namespace Front\FrontBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Front\FrontBundle\Entity\City;
use Front\FrontBundle\Form\CityType;

/**
 * City controller.
 *
 */
class CityController extends Controller
{

    /**
     * Lists all City entities.
     *
     */
    public function indexAction()
    {
        
        return $this->redirect($this->generateUrl('home'));
        
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('FrontFrontBundle:City')->findAll();

        return $this->render('FrontFrontBundle:City:index.html.twig', array(
            'entities' => $entities,
        ));
    }
//    /**
//     * Creates a new City entity.
//     *
//     */
//    public function createAction(Request $request)
//    {
//        $entity = new City();
//        $form = $this->createCreateForm($entity);
//        $form->handleRequest($request);
//
//        if ($form->isValid()) {
//            $em = $this->getDoctrine()->getManager();
//            $em->persist($entity);
//            $em->flush();
//            
//            try {
//                $em->refresh($entity);
//                $this->setLatitudeAndLongitude($entity);
//                $em->persist($entity);
//                $em->flush();
//            } catch (\Exception $e) {
//                
//            }
//
//            return $this->redirect($this->generateUrl('front_city_show', array('id' => $entity->getId())));
//        }
//
//        return $this->render('FrontFrontBundle:City:new.html.twig', array(
//            'entity' => $entity,
//            'form'   => $form->createView(),
//        ));
//    }
//
//    /**
//     * Creates a form to create a City entity.
//     *
//     * @param City $entity The entity
//     *
//     * @return \Symfony\Component\Form\Form The form
//     */
//    private function createCreateForm(City $entity)
//    {
//        $form = $this->createForm(new CityType(), $entity, array(
//            'action' => $this->generateUrl('front_city_create'),
//            'method' => 'POST',
//        ));
//
//        $form->add('submit', 'submit', array('label' => 'Create'));
//
//        return $form;
//    }
//
//    /**
//     * Displays a form to create a new City entity.
//     *
//     */
//    public function newAction()
//    {
//        $entity = new City();
//        $form   = $this->createCreateForm($entity);
//
//        return $this->render('FrontFrontBundle:City:new.html.twig', array(
//            'entity' => $entity,
//            'form'   => $form->createView(),
//        ));
//    }
//
//    /**
//     * Finds and displays a City entity.
//     *
//     */
//    public function showAction($id)
//    {
//        $em = $this->getDoctrine()->getManager();
//
//        $entity = $em->getRepository('FrontFrontBundle:City')->find($id);
//
//        if (!$entity) {
//            throw $this->createNotFoundException('Unable to find City entity.');
//        }
//
//        $deleteForm = $this->createDeleteForm($id);
//
//        return $this->render('FrontFrontBundle:City:show.html.twig', array(
//            'entity'      => $entity,
//            'delete_form' => $deleteForm->createView(),
//        ));
//    }
//
//    /**
//     * Displays a form to edit an existing City entity.
//     *
//     */
//    public function editAction($id)
//    {
//        $em = $this->getDoctrine()->getManager();
//
//        $entity = $em->getRepository('FrontFrontBundle:City')->find($id);
//
//        if (!$entity) {
//            throw $this->createNotFoundException('Unable to find City entity.');
//        }
//
//        $editForm = $this->createEditForm($entity);
//        $deleteForm = $this->createDeleteForm($id);
//
//        return $this->render('FrontFrontBundle:City:edit.html.twig', array(
//            'entity'      => $entity,
//            'edit_form'   => $editForm->createView(),
//            'delete_form' => $deleteForm->createView(),
//        ));
//    }
//
//    /**
//    * Creates a form to edit a City entity.
//    *
//    * @param City $entity The entity
//    *
//    * @return \Symfony\Component\Form\Form The form
//    */
//    private function createEditForm(City $entity)
//    {
//        $form = $this->createForm(new CityType(), $entity, array(
//            'action' => $this->generateUrl('front_city_update', array('id' => $entity->getId())),
//            'method' => 'PUT',
//        ));
//
//        $form->add('submit', 'submit', array('label' => 'Update'));
//
//        return $form;
//    }
//    /**
//     * Edits an existing City entity.
//     *
//     */
//    public function updateAction(Request $request, $id)
//    {
//        $em = $this->getDoctrine()->getManager();
//
//        $entity = $em->getRepository('FrontFrontBundle:City')->find($id);
//
//        if (!$entity) {
//            throw $this->createNotFoundException('Unable to find City entity.');
//        }
//
//        $deleteForm = $this->createDeleteForm($id);
//        $editForm = $this->createEditForm($entity);
//        $editForm->handleRequest($request);
//
//        if ($editForm->isValid()) {
//            
//            try {
//                $this->setLatitudeAndLongitude($entity);
//                $em->persist($entity);
//                $em->flush();
//            } catch (\Exception $e) {
//                
//            }
//            
//
//            return $this->redirect($this->generateUrl('front_city_edit', array('id' => $id)));
//        }
//
//        return $this->render('FrontFrontBundle:City:edit.html.twig', array(
//            'entity'      => $entity,
//            'edit_form'   => $editForm->createView(),
//            'delete_form' => $deleteForm->createView(),
//        ));
//    }
//    /**
//     * Deletes a City entity.
//     *
//     */
//    public function deleteAction(Request $request, $id)
//    {
//        $form = $this->createDeleteForm($id);
//        $form->handleRequest($request);
//
//        if ($form->isValid()) {
//            $em = $this->getDoctrine()->getManager();
//            $entity = $em->getRepository('FrontFrontBundle:City')->find($id);
//
//            if (!$entity) {
//                throw $this->createNotFoundException('Unable to find City entity.');
//            }
//
//            $em->remove($entity);
//            $em->flush();
//        }
//
//        return $this->redirect($this->generateUrl('front_city'));
//    }
//
//    /**
//     * Creates a form to delete a City entity by id.
//     *
//     * @param mixed $id The entity id
//     *
//     * @return \Symfony\Component\Form\Form The form
//     */
//    private function createDeleteForm($id)
//    {
//        return $this->createFormBuilder()
//            ->setAction($this->generateUrl('front_city_delete', array('id' => $id)))
//            ->setMethod('DELETE')
//            ->add('submit', 'submit', array('label' => 'Delete'))
//            ->getForm()
//        ;
//    }
//    
//    private function setLatitudeAndLongitude($entity) {
//        try {
//            $geocode = $this->container
//                    ->get('bazinga_geocoder.geocoder')
//                    ->using('google_maps')
//                    ->geocode($entity->stringForGoogleMaps());
//
//            $entity->setLatitude($geocode['latitude']);
//            $entity->setLongitude($geocode['longitude']);
//            
//        } catch (\Exception $e) {
//            throw $e;
//        }
//    }
}
