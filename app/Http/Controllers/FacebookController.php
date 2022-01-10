<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Providers\Faceb  ookServiceProvider;

class FacebookController extends Controller
{
    public function index(Request $request){
       
        return response()->json(['test' => 'test']);

        // $fields = "id,cover,name,first";
        // $fb_user = $fb->get('/me?fields='.$fields);
        // return response()->json($fb_user);
    }
}


// https://stackoverflow.com/questions/42945596/how-to-integrate-facebook-php-sdk-with-laravel-5-4