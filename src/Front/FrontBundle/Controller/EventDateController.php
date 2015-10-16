<?php

namespace Front\FrontBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Front\FrontBundle\Entity\EventDate;
use Front\FrontBundle\Form\EventDateType;

/**
 * EventDate controller.
 *
 * @Route("/front/eventdate")
 */
class EventDateController extends Controller {

    /**
     * Creates a new EventDate entity.
     *
     */
    public function createAction(Request $request, $id) {

        if (!$this->getUser())
            return $this->redirect($this->generateUrl('fos_user_security_login'));

        $em = $this->getDoctrine()->getManager();

        $event = $em->getRepository('FrontFrontBundle:Event')->find($id);
        if (!$event) {
            throw $this->createNotFoundException('Unable to find Event entity.');
        }

        $entity = new EventDate();
        $entity->addEvent($event);
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {

            if ($event->hasEventDateForDate($entity->getStartdate()->format('Y-m-d')))
                throw $this->createNotFoundException('EventDate already entity.');

            $em->persist($entity);
            $em->flush();
            $em->refresh($event);
        }

        if ($request->isMethod('POST'))
            return $this->render('FrontFrontBundle:EventDate:list_tagbox.html.twig', array(
                        'event' => $event,
            ));

        return $this->render('FrontFrontBundle:EventDate:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
                        )
        );
    }

    /**
     * Creates a form to create a EventDate entity.
     *
     * @param EventDate $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(EventDate $entity) {
        $form = $this->createForm(new EventDateType(), $entity, array(
            'action' => $this->generateUrl('front_eventdate_create', array('id' => $entity->getEvent()->getId())),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => /** @Ignore */ $this->get('translator')->trans('front.add_date'), 'attr' => array('class' => 'btn btn-success btn-md pull-right')));

        return $form;
    }

    /**
     * Displays a form to create a new EventDate entity.
     *
     */
    public function newAction($id) {

        if (!$this->getUser())
            return $this->redirect($this->generateUrl('fos_user_security_login'));

        $em = $this->getDoctrine()->getManager();

        $event = $em->getRepository('FrontFrontBundle:Event')->find($id);
        if (!$event) {
            throw $this->createNotFoundException('Unable to find Event entity.');
        }

        $entity = new EventDate();
        $entity->addEvent($event);
        $form = $this->createCreateForm($entity);

        return $this->render('FrontFrontBundle:EventDate:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
                        )
        );
    }

    /**
     * Finds and displays a EventDate entity.
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FrontFrontBundle:EventDate')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EventDate entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('FrontFrontBundle:EventDate:show.html.twig', array(
                    'entity' => $entity,
                    'delete_form' => $deleteForm->createView(),
                        )
        );
    }

    /**
     * Finds and displays a EventDate entity.
     */
    public function showTagboxAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FrontFrontBundle:EventDate')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EventDate entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('FrontFrontBundle:EventDate:show_tagbox.html.twig', array(
                    'entity' => $entity,
                    'delete_form' => $deleteForm->createView(),
                        )
        );
    }

    /**
     * Displays a form to edit an existing EventDate entity.
     *
     * @Route("/{id}/edit", name="front_eventdate_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FrontFrontBundle:EventDate')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EventDate entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Creates a form to edit a EventDate entity.
     *
     * @param EventDate $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(EventDate $entity) {
        $form = $this->createForm(new EventDateType(), $entity, array(
            'action' => $this->generateUrl('front_eventdate_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => /** @Ignore */ $this->get('translator')->trans('update'), 'attr' => array('class' => 'btn btn-success btn-md pull-right')));

        return $form;
    }

    /**
     * Edits an existing EventDate entity.
     *
     * @Route("/{id}", name="front_eventdate_update")
     * @Method("PUT")
     * @Template("FrontFrontBundle:EventDate:edit.html.twig")
     */
    public function updateAction(Request $request, $id) {

        if (!$this->getUser())
            return $this->redirect($this->generateUrl('fos_user_security_login'));

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

            $event = $entity->getEvent();
            if ($event)
                return $this->render('FrontFrontBundle:EventDate:list_tagbox.html.twig', array(
                            'event' => $event,
                ));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a EventDate entity.
     *
     * @Route("/{id}", name="front_eventdate_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id) {

        if (!$this->getUser())
            return $this->redirect($this->generateUrl('fos_user_security_login'));

        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('FrontFrontBundle:EventDate')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find EventDate entity.');
            }

            $event = $entity->getEvent();

            $em->remove($entity);
            $em->flush();
        }


        if ($event)
            return $this->redirect($this->generateUrl('front_event_show', array('id' => $event->getId(), 'uri' => $event->getURI())));
    }

    /**
     * Creates a form to delete a EventDate entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('front_eventdate_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('submit', 'submit', array('label' => /** @Ignore */ $this->get('translator')->trans('delete')))
                        ->getForm()
        ;
    }

    public function addByWeekdayAction(Request $request, $id) {

        if (!$this->getUser())
            return $this->redirect($this->generateUrl('fos_user_security_login'));

        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository('FrontFrontBundle:Event')->find($id);
        if (!$event) {
            throw $this->createNotFoundException('Unable to find Event entity.');
        }

        $form = $this->createWeekdayForm($id);

        if ($request->isMethod('POST')) {
            $form->bind($request);

            $data = $form->getData();
            $end = $data['stopdate'];
            $today = new \DateTime();

            for ($i = 1; $i <= 365; $i ++) {

                $day_number = $today->format('N');
                if (in_array($day_number, $data['weekday']))
                    $this->createEventDate($event, $today, $data['time']);

                if ($today->format('y-m-d') == $end->format('y-m-d'))
                    break;

                $today->add(new \DateInterval('P1D'));
            }

            return $this->render('FrontFrontBundle:EventDate:list_tagbox.html.twig', array(
                        'event' => $event,
            ));
        }

        return $this->render('FrontFrontBundle:EventDate:dailyForm.html.twig', array(
                    'form' => $form->createView()
        ));
    }

    private function createWeekdayForm($id) {

        $choices = array();
        $today = new \DateTime();

        $locale = $this->get('request')->getLocale();
        $double_locale = $locale . '_' . strtoupper($locale);

        if (!setlocale(LC_TIME, $locale))
            setlocale(LC_TIME, $double_locale);

        for ($i = 1; $i <= 7; $i ++) {
            $choices[$today->format('N')] = ucfirst(strftime("%A", $today->getTimestamp()));
            $today->add(new \DateInterval('P1D'));
        }
        ksort($choices);

        $form = $this->createFormBuilder(array())
                ->add('weekday', 'choice', array(
                    'choices' => $choices,
                    'multiple' => true,
                    'expanded' => true,
                    'label_attr' => array('class' => 'control-label'),
                ))
                ->add('stopdate', 'date', array(
                    'widget' => 'single_text',
                    'input' => 'datetime',
                    'format' => 'yyyy-MM-dd',
                    'attr' => array('class' => 'datepicker')
                ))
                ->add('time', 'time', array(
                    'input' => 'datetime',
                    'widget' => 'choice',
                    'with_seconds' => false
                ))
                ->setAction($this->generateUrl('front_eventdate_add_by_weekday', array('id' => $id)))
                ->setMethod('POST')
                ->getForm();

        return $form;
    }

    private function createEventDate($event, $startdate, $starttime) {

        $em = $this->getDoctrine()->getManager();

        if (!$event)
            throw $this->createNotFoundException('Unable to find Event entity.');

        if ($event->hasEventDateForDate($startdate))
            return;

        $eventDate = new EventDate();
        $eventDate->addEvent($event);
        $eventDate->setStartdate($startdate);
        $eventDate->setStarttime($starttime);
        $em->persist($eventDate);
        $em->flush();
    }

}
