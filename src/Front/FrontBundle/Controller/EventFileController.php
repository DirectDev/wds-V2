<?php

namespace Front\FrontBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Front\FrontBundle\Entity\EventFile;
use Symfony\Component\HttpFoundation\Response;

/**
 * EventFile controller.
 *
 */
class EventFileController extends Controller {

    /**
     * Deletes a EventFile entity.
     *
     */
    public function deleteAction(Request $request, $id) {

        if (!$this->getUser())
                return $this->redirect($this->generateUrl('fos_user_security_login'));

        $em       = $this->getDoctrine()->getManager();
        $eventFile = $em->getRepository('FrontFrontBundle:EventFile')->find($id);

        if (!$eventFile) {
            throw $this->createNotFoundException('Unable to find EventFile entity.');
        }

        $event  = $eventFile->getEvent();

        if ($event && !$event->allowModificationByUser($this->getUser())) {
            throw $this->createNotFoundException('Error : not yours.');
        }

        $em->remove($eventFile);
        $em->flush();

        return new Response(/** @Ignore */ $this->get('translator')->trans('toastr.xhr_success.delete_userfile'), 200);
    }
}