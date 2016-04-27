<?php

namespace Front\FrontBundle\Services;

use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\GraphUser;
use Facebook\FacebookRequestException;
use Doctrine\ORM\EntityManager;
use Front\FrontBundle\Entity\Event;

class FacebookServices {

    private $em;
    private $facebook;
    private $user;
    private $access_token;
    private $facebook_event_id;
    private $eventNode;
    private $event;
    private $locale = 'en';

    public function __construct(EntityManager $em, $securityContext, $facebook_app_id, $facebook_app_secret) {
        $this->em = $em;
        $this->user = $securityContext->getToken()->getUser();
        if ($this->user)
            $this->access_token = $this->user->getFacebookAccessToken();

        $this->facebook = new \Facebook\Facebook([
            'app_id' => $facebook_app_id,
            'app_secret' => $facebook_app_secret,
            'default_graph_version' => 'v2.6',
        ]);
        $this->facebook->setDefaultAccessToken((string) $this->access_token);
    }

    public function importEvents() {
        
    }

    public function importEvent($facebook_event_id = null) {
        if (!$facebook_event_id)
            return;

        $this->facebook_event_id = $facebook_event_id;
        $this->getEventNode();

// recherche si event existe
        // si existe .... 
        // met a jour
        // si existe pas cree event
        $this->createEvent();

        $place_node = $this->eventNode->getField('place');
//        var_dump($place_node);
        $address_node = $place_node->getField('location');
//        var_dump($address_node);
//        var_dump($this->getNodeData('owner'));
//        var_dump($this->getNodeData('place'));
//        $admins = $this->getEdge('admins');
//        var_dump($admins);
//        ;
//        foreach ($admins->getIterator() as $item) {
//            var_dump($item->getField('id'));
//            var_dump($item->getField('name'));
//        }
//        var_dump($this->eventNode);
        $this->em->persist($this->event);
        $this->em->flush();
    }

    private function createEvent() {
        $this->event = new Event();
        $this->setEventData();
        $this->setEventTranslations();
    }

    private function setEventData() {
        $this->event->setName($this->getNodeData('name'));
//        $this->event->setFacebookLink(/* ????? */); // ????????????????????????????
        $this->event->setPublished(true);
        $this->event->setUser($this->user);
        $this->event->setPublishedBy($this->user);
        $this->event->setOrganizedBy($this->findUserByFacebookOwnerOrFacebookAdmins());
    }

    private function setEventTranslations() {
        $this->event->translate('en')->setTitle($this->getNodeData('name'));
        $this->event->translate('en')->setDescription($this->getNodeData('description'));
        if ($this->locale != 'en') {
            $this->event->translate($this->locale)->setTitle($this->getNodeData('name'));
            $this->event->translate($this->locale)->setDescription($this->getNodeData('description'));
        }
        $this->event->mergeNewTranslations();
    }

    private function getNodeData($type) {
        if (!$this->eventNode)
            return;
        if (!$type)
            return;
        $nodes = array('id', 'attenting_count', 'can_guests_invite', 'category', 'cover',
            'declined_count', 'description', 'end_time', 'guest_list_enabled', 'interested_count', 'is_page_owned', 'is_viewer_admin',
            'maybe_count', 'name', 'no_reply_count', 'owner', 'parent_group', 'place', 'start_time', 'ticket_uri', 'timezone', 'type', 'updated_time');
        if (!in_array($type, $nodes))
            return;
        return $this->eventNode->getField($type);
    }

    private function getEventNode() {
        if (!$this->facebook or ! $this->facebook_event_id)
            return;

        $request = $this->facebook->request('GET', '/me?fields=locale');
        try {
            $response = $this->facebook->getClient()->sendRequest($request);
        } catch (Facebook\Exceptions\FacebookResponseException $e) {
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        $graphuser = $response->getGraphUser();
        if ($graphuser)
            $this->locale = substr($graphuser['locale'], 0, 2);

        $request = $this->facebook->request('GET', '/' . $this->facebook_event_id);
        try {
            $response = $this->facebook->getClient()->sendRequest($request);
        } catch (\Facebook\Exceptions\FacebookResponseException $e) {
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch (\Facebook\Exceptions\FacebookSDKException $e) {
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

//        var_dump($response);

        $this->eventNode = $response->getGraphNode();
    }

    private function getEdge($type) {
        if (!$this->facebook or ! $this->facebook_event_id)
            return;
        if (!$type)
            return;
        $edges = array('admins', 'attenting', 'comments', 'declined', 'interested',
            'live_videos', 'maybe', 'noreply', 'photos', 'picture', 'roles', 'video', 'feed');
        if (!in_array($type, $edges))
            return;

        $request = $this->facebook->request('GET', '/' . $this->facebook_event_id . '/' . $type);
        $response = $this->facebook->getClient()->sendRequest($request);
        return $response->getGraphEdge();
    }

    private function findUserByFacebookOwnerOrFacebookAdmins() {
        $owner = $this->getNodeData('owner');
        if ($owner)
            return $this->findUserByFacebookId($onwer->getField('id'));
        $admins = $this->getEdge('admins');
        foreach ($admins->getIterator() as $item) {
            $facebook_id = $item->getField('id');
            if ($item->getField('id'))
                $user = $this->findUserByFacebookId($facebook_id);
            if ($user)
                return $user;
        }
    }

    private function findUserByFacebookId($facebook_id = null) {
        if (!$facebook_id)
            return;
        return $this->em->getRepository('UserUserBundle:User')->findOneBy(array('facebook_id' => $facebook_id));
    }

}

?>
