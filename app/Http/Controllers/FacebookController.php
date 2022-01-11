<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\FacebookServices;

class FacebookController extends Controller
{

    protected $facebook;

    public function __construct()
    {
        $this->facebook = new FacebookServices();
    }

    public function index(Request $request){
        return response()->json(['url' => $this->facebook->getRedirectLoginurl()]);
    }
}


// https://stackoverflow.com/questions/42945596/how-to-integrate-facebook-php-sdk-with-laravel-5-4t"ranch 