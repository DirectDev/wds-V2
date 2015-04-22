<?php

namespace Search\SearchBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Search\SearchBundle\Form\UserAdminSearchType;
use User\UserBundle\Entity\User;

use Symfony\Component\HttpFoundation\Response;

class AdminSearchController extends Controller {

    public function UserAdminSearchAction() {

        $request = $this->container->get('request');

        if (!$request->isXmlHttpRequest())
            return new response('', 404);

        $keyword = $request->request->get('keyword');
        if (!$keyword)
            return new response('', 404);

        $em = $this->container->get('doctrine')->getEntityManager();



        $qb = $em->createQueryBuilder();

        $qb->select('u')
                ->from('UserUserBundle:User', 'u')
                ->where("u.username LIKE :keyword")
                ->orderBy('u.username', 'ASC')
                ->setParameter('keyword', '%' . $keyword . '%');

        $query = $qb->getQuery();
        $users = $query->getResult();


        return $this->container->get('templating')->renderResponse('SearchSearchBundle:AdminSearch:userList.html.twig', array('users' => $users));
    }

}
