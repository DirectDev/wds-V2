<?php

namespace Front\FrontBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use User\UserBundle\Entity\User;
use Front\FrontBundle\Form\UserType;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * UserType controller.
 *
 */
class UserTypeController extends Controller {

    public function listForUserSearchAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $userTypes = $em->getRepository('UserUserBundle:UserType')->findAll();

        return $this->render('FrontFrontBundle:UserType:listForUserSearch.html.twig', array(
                    'userTypes' => $userTypes,
        ));
    }

}
