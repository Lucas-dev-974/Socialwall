<?php

namespace App\Http\Controllers;

use App\Models\AdminSettings;
use Illuminate\Http\Request;
use App\Providers\FacebookRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FacebookController extends Controller
{

    protected $facebook;

    public function __construct()
    {
        $this->middleware('jwt.verify', ['except' => ['index', 'callback']]);
        $this->facebook = new FacebookRepository();
    }

    public function index(Request $request){
        return redirect()->secure($this->facebook->redirectTo());
    }

    public function callback(Request $request){
        if (request('error') == 'access_denied') return response()->json(['error' => 'l\'accès vous à été refusé']); 
        //handle error 

        $accessToken = $this->facebook->handleCallback();
        
        return response()->json([
            'access_token' => $accessToken,
            'user'         => Auth::user()
        ]);
    }

    public function getPages(Request $request){
        $token = AdminSettings::where([ 'name' => 'facebook_app_token' ])->first();
        
        $datas = $this->facebook->getPages($token);
        return response()->json([ 'token' => $token ]);
    }
}


// https://stackoverflow.com/questions/42945596/how-to-integrate-facebook-php-sdk-with-laravel-5-4t"ranch 