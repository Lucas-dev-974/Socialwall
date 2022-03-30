<?php

namespace App\Providers;

use Facebook\Facebook;
use Tymon\JWTAuth\Facades\JWTAuth;

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

    public function SetupProfile(){
        $user = JWTAuth::user();
        $fields_type = [ 'facebook_profile', 'facebook_pages' ];

        
        
    }

    public function getProfile($accessToken){
        try{
            $response = $this->facebook->get('/me', $accessToken);
            $me       = $response->getGraphUser();
            return $me;
        }catch(\Facebook\Exceptions\FacebookResponseException $e) {
            return $e->getErrorType();
            exit;
        } catch(\Facebook\Exceptions\FacebookSDKException $e) {
            return $e->getMessage();
            exit;
        }
    }

    public function getPages($accessToken){
        try{
            $pages = $this->facebook->get('/me/accounts', $accessToken);
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