<?php

namespace App\Http\Controllers;

use App\Models\AdminSettings;
use Illuminate\Http\Request;
use App\Providers\FacebookRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class FacebookController extends Controller
{

    protected $facebook;

    public function __construct()
    {
        $this->middleware('jwt.verify', ['except' => ['index', 'callback']]);
        $this->facebook = new FacebookRepository();

        $user = JWTAuth::user();
        if(!$user) return abort(response()->json(['error' => 'Veuillez vous connectez !']));
        
        // $token = AdminSettings::where
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
            'user'         => JWTAuth::user()
        ]);
    }

    public function getPages(Request $request){
        $token = AdminSettings::where([ 'name' => 'facebook_app_token' ])->first();
        
        $datas = $this->facebook->getPages($token);
        return response()->json([ 'token' => $token ]);
    }

    public function getProfile(Request $request){
        // $token = 
    }
}


// https://stackoverflow.com/questions/42945596/how-to-integrate-facebook-php-sdk-with-laravel-5-4t"ranch 