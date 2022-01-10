<?php

namespace App\Providers;

use Facebook\Facebook;

class FacebookServices {
    public function __construct(){
        $this->facebook = new Facebook(config('facebook.config'));
        $this->test = 'test';
    }

    public function test(){
        return $this->test;
    }
}