<?php

namespace Front\FrontBundle\Services;

use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\GraphUser;
use Facebook\FacebookRequestException;

class FacebookServices {

    private $facebook;
    private $user;
    private $access_token;

    public function __construct($em, $securityContext, $facebook_app_id, $facebook_app_secret) {
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
        /*
         * Node
         */


        $request = $this->facebook->request('GET', '/' . $facebook_event_id);
        try {
            $response = $this->facebook->getClient()->sendRequest($request);
        } catch (\Facebook\Exceptions\FacebookResponseException $e) {
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch (\Facebook\Exceptions\FacebookSDKException $e) {
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        $event_node = $response->getGraphNode();
//        var_dump($event_node);
//        var_dump($event_node->getField('id'));

        $place_node = $event_node->getField('place');
//        var_dump($place_node);
        $address_node = $place_node->getField('location');
//        var_dump($address_node);



        /*
         * 
         * Edges
         */
        $request = $this->facebook->request('GET', '/' . $facebook_event_id . '/admins');
        $response = $this->facebook->getClient()->sendRequest($request);


        $event_admins_edge = $response->getGraphEdge();
        var_dump($event_admins_edge);

        var_dump($response);
    }

}

?>
