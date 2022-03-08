<?php

namespace App\Providers;

use Error;
use Facebook\Facebook;

class FacebookRepository
{
    protected $facebook;

    public function __construct(){
        $this->facebook = new Facebook([
            'app_id'     => config('providers.facebook.app_id'),
            'app_secret' => config('providers.facebook.app_secret'),
            'default_graph_version' => 'v12.0'
        ]);
    }

    private function SetupProfile($facebook_profile){
        
    }

    public function getProfile($accessToken){
        try{
            $response = $this->facebook->get('/me', $accessToken);
            $me       = $response->getGraphUser();
            return $me;
        }catch(\Facebook\Exceptions\FacebookResponseException $e) {
            // return var_dump($e);
            return $e->getErrorType();
            exit;
        } catch(\Facebook\Exceptions\FacebookSDKException $e) {
            return $e->getMessage();
            exit;
        }
        
    }

    public function getPages($accessToken){
        try{
            $pages = $this->facebook->get('/me', $accessToken);
            $pages = $pages->getGraphPage();
            return $pages;
        }catch(\Facebook\Exceptions\FacebookResponseException $e) {
            // return var_dump($e);
            return $e->getErrorType();
            exit;
        } catch(\Facebook\Exceptions\FacebookSDKException $e) {
            return $e->getMessage();
            exit;
        }
        

    }


}