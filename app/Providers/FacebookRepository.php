<?php

namespace App\Providers;

use Error;
use Facebook\Facebook;

class FacebookRepository
{
    protected $facebook;

    public function __construct()
    {
        $this->facebook = new Facebook([
            'app_id'     => config('providers.facebook.app_id'),
            'app_secret' => config('providers.facebook.app_secret'),
            'default_graph_version' => 'v12.0'
        ]);
    }

    public function getPages($accessToken){
        try{
            $pages = $this->facebook->get('/me', $accessToken);
            return $pages;
            // $pages = $pages->getGraphEdge()->asArray();

            // return array_map(function ($page) {
            //     return [
            //         'provider'     => 'facebook',
            //         'access_token' => $page['access_token'],
            //         'id'           => $page['id'],
            //         'name'         => $page['name'],
            //         'image'        => "https://graph.facebook.com/{$page->id}/picture?type=large"
            //     ];
            // }, $pages);
        }catch(\Facebook\Exceptions\FacebookResponseException $e) {
            // return var_dump($e);
            return 'Une erreur c\'est produite: ' . $e->getErrorType();
            exit;
        } catch(\Facebook\Exceptions\FacebookSDKException $e) {
            return $e;
            return 'Une erreur c\'est produite: ' . $e->getMessage();
            exit;
        }
        

    }


}