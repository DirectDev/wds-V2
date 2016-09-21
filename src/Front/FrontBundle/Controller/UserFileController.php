<?php

namespace Front\FrontBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use User\UserBundle\Entity\UserFile;
use User\UserBundle\Form\UserFileType;
use Symfony\Component\HttpFoundation\Response;

/**
 * UserFile controller.
 *
 */
class UserFileController extends Controller {

    /**
     * Deletes a UserFile entity.
     *
     */
    public function deleteAction(Request $request, $id) {

        if (!$this->getUser())
                return $this->redirect($this->generateUrl('fos_user_security_login'));

        $em       = $this->getDoctrine()->getManager();
        $userFile = $em->getRepository('UserUserBundle:UserFile')->find($id);

        if (!$userFile) {
            throw $this->createNotFoundException('Unable to find UserFile entity.');
        }

        $user  = $userFile->getUser();

        if ($user && $user != $this->getUser()) {
            throw $this->createNotFoundException('Error : not yours.');
        }

        $em->remove($userFile);
        $em->flush();

        return new Response(/** @Ignore */ $this->get('translator')->trans('toastr.xhr_success.delete_userfile'), 200);
    }
}