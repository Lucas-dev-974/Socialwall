<?php

namespace App\Http;

use Facebook\Facebook;

class FacebookServices {

    protected $facebook;
    
    public function __construct(){
        $this->facebook = new Facebook([
            'app_id'     => getenv('FACEBOOK_APP_ID'),
            'app_secret' => getenv('FACEBOOK_APP_SECRET'),
            'default_graph_version' => getenv('FACEBOOK_DEFAULT_GRAPH_VERSION')
        ]);
    }

    public function getRedirectLoginurl(){
        $helper = $this->facebook->getRedirectLoginHelper();
        $permission = [
            'pages_manage_posts',
            'pages_read_engagement',
        ];
        $redirectUri = config('app.url') . '/auth/facebook/callback';
        return $helper->getLoginUrl($redirectUri, $permission);
    }
}