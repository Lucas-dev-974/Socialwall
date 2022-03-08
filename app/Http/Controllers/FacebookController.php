<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Providers\FacebookRepository;
use Error;
use GuzzleHttp\Psr7\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class FacebookController extends Controller
{

    protected $facebook;

    public function __construct()
    {   
        $this->user = JWTAuth::user();
        if(!$this->user) return abort(response()->json(['error' => 'Veuillez vous connectez !']));


        $this->middleware('jwt.verify', ['except' => ['index', 'callback']]);
        $this->facebook       = new FacebookRepository();
        $facebook_token_infos = Setting::where(['user_id' => $this->user->id, 'name' => 'facebook_token_infos'])->first();
        $this->facebook_token_infos = json_decode($facebook_token_infos['value']);
    }

    public function getPages(){
        $response = $this->facebook->getPages($this->facebook_token_infos->token);
        if(!is_array($response) && is_string($response) && $response == 'OAuthException') // Si le token est invalide
            return response()->json(['error' => 'Vous n\'ête plus connecter'], 401);
    }
}


// https://stackoverflow.com/questions/42945596/how-to-integrate-facebook-php-sdk-with-laravel-5-4t"ranch 