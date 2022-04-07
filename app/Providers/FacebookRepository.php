<?php

namespace App\Providers;

use Facebook\Facebook;
use Facebook\GraphNodes\GraphNodeFactory;
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

    public function getLongLiveToken($accessToken){
        try{
            // $response = $this->facebook->get('/oauth/access_token?grant_type=fb_exchange_token&client_id=' . config('providers.facebook.app_id') . '&client_secret=' . config('providers.facebook.app_secret') . '&fb_exchange_token=' . $accessToken, $accessToken);
            // $response = $response->getGraphSessionInfo();

            $this->facebook->setDefaultAccessToken($accessToken);
            $oauth = $this->facebook->getOAuth2Client();
            $token = $oauth->getLongLivedAccessToken($accessToken);

            $response = $this->facebook->get('/oauth/access_token?grant_type=fb_exchange_token&client_id' . config('providers.facebook.app_id') . '&client_secret=' . config('providers.facebook.app_secret') . '&fb_exchange_token=' . $accessToken)->getGraphEdge();
            return $token;

        }catch(\Facebook\Exceptions\FacebookResponseException $e) {
            // return var_dump($e);
            return ['Facebook response' => $e->getErrorType()];
            exit;
        } catch(\Facebook\Exceptions\FacebookSDKException $e) {
            return ['sdk' => $e->getMessage()];
            exit;
        }catch(\Facebook\Exceptions\FacebookAuthenticationException $e){
            return ['authentication' => $e->getMessage()];
            exit;
        }
        catch(\Facebook\Exceptions\FacebookOtherException $e){
            return ['other' => $e->getMessage()];
            exit;
        }
    }


}