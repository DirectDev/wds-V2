<?php

namespace Contact\ContactBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Contact\ContactBundle\Entity\Enquiry;
use Contact\ContactBundle\Form\EnquiryType;

class DefaultController extends Controller {

    public function contactAction() {
        $enquiry = new Enquiry();
        $form = $this->createCreateForm($enquiry);

        $request = $this->getRequest();
        $form->submit($request);

        if ($form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($enquiry);
            $em->flush();

            try {
                $message = \Swift_Message::newInstance()
                        ->setContentType('text/html')
                        ->setSubject($enquiry->getSubject())
                        ->setFrom($enquiry->getEmail())
                        ->setTo($this->container->getParameter('contact_email'))
                        ->setBody($this->renderView('ContactContactBundle:Mail:contact.txt.twig', array('enquiry' => $enquiry)));

                if ($this->get('mailer')->send($message)) {
                    $this->get('session')->getFlashBag()->add('contact-notice-success', 'contact.contact_alert_success');
                    return $this->redirect($this->generateUrl('contact_contact_contact'));
                }
                else
                    $this->get('session')->getFlashBag()->add('contact-notice-warning', 'contact.contact_alert_warning');
            } catch (\Exception $e) {
                
            }
        }

        return $this->render('ContactContactBundle:Default:contact.html.twig', array(
                    'form' => $form->createView()
                ));
    }

    /**
     * Creates a form to create a Enquiry entity.
     *
     * @param Enquiry $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Enquiry $entity) {
        $form = $this->createForm(new EnquiryType(), $entity, array(
            'action' => $this->generateUrl('contact_contact_contact'),
            'method' => 'POST',
                ));

        $form->add('submit', 'submit');

        return $form;
    }

}
