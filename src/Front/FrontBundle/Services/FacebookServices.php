<?php

namespace Front\FrontBundle\Services;

use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\GraphUser;
use Facebook\FacebookRequestException;
use Doctrine\ORM\EntityManager;
use Front\FrontBundle\Entity\Event;
use Front\FrontBundle\Entity\EventDate;
use Front\FrontBundle\Entity\EventFile;
use Front\FrontBundle\Entity\Address;

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

        if (!$this->allowImportEvent())
            return;
// recherche si event existe
        // si existe .... 
        // met a jour
        // si existe pas cree event
        $this->createEvent();

//        $place_node = $this->eventNode->getField('place');
//        var_dump($place_node);
//        $address_node = $place_node->getField('location');
//        var_dump($address_node);
//        var_dump('cover'.$this->getNodeData('cover'));
//        var_dump($this->getNodeData('place'));
//        $admins = $this->getEdge('photo');
//        var_dump($admins);
//        $node = $this->getEdge('picture');
//        var_dump($node);
//        foreach ($node->getIterator() as $picture) {
////        $graphpicture = $node->getGraphPicture();
//            var_dump($picture);
//        }
//        ;
//        foreach ($admins->getIterator() as $item) {
//            var_dump($item->getField('id'));
//            var_dump($item->getField('name'));
//        }
//        var_dump($this->eventNode);
        $this->em->persist($this->event);
        $this->em->flush();
    }

    private function allowImportEvent() {
        $musicTypes = $this->em->getRepository('FrontFrontBundle:MusicType')->findAll();
        foreach ($musicTypes as $musicType) {
            $music_title = $musicType->translate($this->locale)->getTitle();
            if (stripos($this->getNodeData('name'), $music_title) !== false)
                return true;
            if (stripos($this->getNodeData('description'), $music_title) !== false)
                return true;
        }
        return false;
    }

    private function createEvent() {
        $this->event = new Event();
        $this->setEventData();
        $this->setEventTranslations();
        $this->setEventDate();
        $this->setEventAddress();
        $this->setEventMusicTypes();
        $this->setEventEventTypes();
        $this->setEventPresences();
        $this->setEventPictureUrl();
        $this->createEventFile();
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

    private function setEventDate() {
        $eventDate = new EventDate();
        $startTime = $this->getNodeData('start_time');
        if ($startTime) {
            $eventDate->setStartdate($startTime);
            $eventDate->setStarttime($startTime);
        } else
            return;
        $stopTime = $this->getNodeData('end_time');
        if ($stopTime) {
            $eventDate->setStopdate($stopTime);
            $eventDate->setStoptime($stopTime);
        }
        $this->event->addEventDate($eventDate);
    }

    private function setEventAddress() {
        $address = $this->findAddressByFacebookIdOrAddressFields();
        if (!$address)
            $address = $this->createAddress();
        if ($address)
            $this->event->addAddress($address);
    }

    private function getNodeData($type) {
        if (!$this->eventNode)
            return;
        if (!$type)
            return;
        $nodes = array('id', 'attending_count', 'can_guests_invite', 'category', 'cover',
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
//        $this->locale = 'fr';

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
        $edges = array('admins', 'attending', 'comments', 'declined', 'interested',
            'live_videos', 'maybe', 'noreply', 'photos', 'picture', 'roles', 'video', 'feed');
        if (!in_array($type, $edges))
            return;

        $request = $this->facebook->request('GET', '/' . $this->facebook_event_id . '/' . $type);
        $response = $this->facebook->getClient()->sendRequest($request);
        return $response->getGraphEdge();
    }

    private function setEventPictureUrl() {
        if (!$this->facebook or ! $this->facebook_event_id)
            return;
        $request = $this->facebook->request('GET', '/' . $this->facebook_event_id . '/?fields=cover');
        $response = $this->facebook->getClient()->sendRequest($request);
        $node = $response->getGraphNode();
        if($node->getField('cover') && $node->getField('cover')->getField('source') )
            $this->event->setFacebookPictureUrl($node->getField('cover')->getField('source'));
    }

    private function createEventFile() {
        if (!$this->event->getFacebookPictureUrl())
            return;

        try {
            $this->em->persist($this->event);
            $this->em->flush();
            $this->em->refresh($this->event);

            $eventFile = new EventFile();
            $eventFile->setEvent($this->event);

            $path = $eventFile->getGeneralPath();
            if (!is_dir($path))
                mkdir($path);
            $path = $path . 'large/';
            if (!is_dir($path))
                mkdir($path);
            $url = $this->event->getFacebookPictureUrl();

            $name = 'img_facebook.jpg';
            if (stripos($url, '.png') !== false)
                $name = 'img_facebook.png';
            if (stripos($url, '.gif') !== false)
                $name = 'img_facebook.gif';

            $file = file_get_contents($url);
            file_put_contents($path . $name, $file);

            if (is_file($path . $name)) {
                $eventFile->setName($name);
                $this->em->persist($eventFile);
            }
        } catch (\Exception $e) {
            
        }
    }

    private function findUserByFacebookOwnerOrFacebookAdmins() {
        $owner = $this->getNodeData('owner');
        if ($owner)
            return $this->findUserByFacebookId($owner->getField('id'));
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

    private function findAddressByFacebookIdOrAddressFields() {
        $place = $this->getNodeData('place');
        if (!$place)
            return;
        $address = $this->findAddressByFacebookId($place->getField('id'));
        if ($address)
            return $address;

        $location = $place->getField('location');
        if (!$location)
            return;
        $address = $this->em->getRepository('FrontFrontBundle:Address')->findOneBy(
                array(
                    'name' => $place->getField('name'),
                    'street' => $location->getField('street'),
                    'city' => $location->getField('city'),
                    'postcode' => $location->getField('zip'),
                )
        );
        return $address;
    }

    private function createAddress() {
        $place = $this->getNodeData('place');
        if (!$place)
            return null;
        $location = $place->getField('location');
        if (!$location)
            return null;

        $address = new Address();
        $address->setName($place->getField('name'));
        $address->setStreet($location->getField('street'));
        $address->setCity($location->getField('city'));
        $address->setPostcode($location->getField('zip'));
        $address->setLatitude($location->getField('latitude'));
        $address->setLongitude($location->getField('longitude'));
        $address->setFacebookId($place->getField('id'));

        $country = $this->em->getRepository('FrontFrontBundle:Country')->findOneByTitle($location->getField('country'));
        if ($country)
            $address->setCountry($country);

        return $address;
    }

    private function findAddressByFacebookId($facebook_id = null) {
        if (!$facebook_id)
            return;
        return $this->em->getRepository('FrontFrontBundle:Address')->findOneBy(array('facebook_id' => $facebook_id));
    }

    private function setEventMusicTypes() {
        $musicTypes = $this->em->getRepository('FrontFrontBundle:MusicType')->findAll();
        foreach ($musicTypes as $musicType) {
            $music_title = $musicType->translate($this->locale)->getTitle();
            if (stripos($this->getNodeData('name'), $music_title) !== false) {
                if ($this->event->getMusicTypes()->contains($musicType) == false)
                    $this->event->addMusicType($musicType);
            }
            if (stripos($this->getNodeData('description'), $music_title) !== false) {
                if ($this->event->getMusicTypes()->contains($musicType) == false)
                    $this->event->addMusicType($musicType);
            }
        }
    }

    private function setEventEventTypes() {
        $eventTypes = $this->em->getRepository('FrontFrontBundle:EventType')->findAll();
        foreach ($eventTypes as $eventType) {
            $eventtype_title = $eventType->translate($this->locale)->getTitle();
            if (stripos($this->getNodeData('name'), $eventtype_title) !== false) {
                if ($this->event->getEventTypes()->contains($eventType) == false)
                    $this->event->addEventType($eventType);
            }
            if (stripos($this->getNodeData('description'), $eventtype_title) !== false) {
                if ($this->event->getEventTypes()->contains($eventType) == false)
                    $this->event->addEventType($eventType);
            }
        }
        if (!count($this->event->getEventTypes())) {
            $eventType = $this->em->getRepository('FrontFrontBundle:EventType')->findOneByName('Party');
            if ($this->event->getEventTypes()->contains($eventType) == false)
                $this->event->addEventType($eventType);
        }
    }

    private function setEventPresences() {
        $array = array();
        $attending = $this->getEdge('attending');
        foreach ($attending->getIterator() as $node_attending)
            if ($node_attending->getField('id'))
                $array[] = $node_attending->getField('id');

        $users = $this->em->getRepository('UserUserBundle:User')->findByArrayFacebookIds($array);
        foreach ($users as $user)
            if ($this->event->getUserPresents()->contains($user) == false)
                $this->event->addUserPresent($user);
    }

}

?>
