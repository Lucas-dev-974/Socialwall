<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\FacebookRepository;

class FacebookController extends Controller
{

    protected $facebook;

    public function __construct()
    {
        $this->facebook = new FacebookRepository();
    }

    public function index(Request $request){
        // return redirect($this->facebook->redirectTo());
    }

    public function callbacb(Request $request){

    }
}


// https://stackoverflow.com/questions/42945596/how-to-integrate-facebook-php-sdk-with-laravel-5-4t"ranch 