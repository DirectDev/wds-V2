<?php

namespace Front\FrontBundle\Services;

use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\GraphUser;
use Facebook\FacebookRequestException;

class FacebookServices {

//    private $facebookSession;
//    private $user;
//
//    public function __construct($em, $securityContext, $facebook_app_id, $facebook_app_secret) {
//        $user = $securityContext->getToken()->getUser();
//        
//        FacebookSession::setDefaultApplication($facebook_app_id, $facebook_app_secret);
//        $this->facebookSession = new FacebookSession($user->getFacebookAccessToken());
//    }
//
//    public function importEvents() {
//        try {
//            
//            $me = (new FacebookRequest( $this->facebookSession, 'GET', '/me'))
//                    ->execute()
//                    ->getGraphObject(GraphUser::className());
//            echo $me->getName();
//            
//            
//            $me = (new FacebookRequest( $this->facebookSession, 'GET', '/me/events'))
//                    ->execute()
//                    ->getGraphObjectList();
//            var_dump($me);
//            
//            $request = (new FacebookRequest($this->facebookSession, 'GET', '/me/events'));
//            $response = $request->execute();
////            var_dump($response);
//            $graphObject = $response->getGraphObject();
//            var_dump ($graphObject);
//            
//            $request = (new FacebookRequest($this->facebookSession, 'GET', '/me'));
//            $response = $request->execute();
//            $graphObject = $response->getGraphObject();
//            var_dump ($graphObject);
//            
//            
//        } catch (FacebookRequestException $e) {
//            // The Graph API returned an error
//        } catch (\Exception $e) {
//            // Some other error occurred
//        }
//    }

}

?>
