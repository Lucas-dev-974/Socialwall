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
        return redirect()->secure($this->facebook->redirectTo());
    }

    public function callback(Request $request){
        if (request('error') == 'access_denied') return response()->json(['error' => 'l\'accès vous à été refusé']); 
        //handle error 

        $accessToken = $this->facebook->handleCallback();
        // return redirect()->route('token')->with('token', $accessToken);
        return response()->json(['access_token' =>$accessToken]);
    }

    public function getPages(Request $request){

    }
}


// https://stackoverflow.com/questions/42945596/how-to-integrate-facebook-php-sdk-with-laravel-5-4t"ranch 