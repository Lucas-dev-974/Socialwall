<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Providers\FacebookRepository;
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
        if(isset($facebook_token_infos) && !empty($facebook_token_infos))
            $this->facebook_token_infos = json_decode($facebook_token_infos['value']);
        else
            abort(response()->json(['error' => 'Veuillez vous connecter à facebook'], 401));
    } 


    public function getProfile(){
        $response = $this->facebook->getProfile($this->facebook_token_infos->token);
        // return $response;s
        if($response == 'OAuthException'){ // Si le token est invalide
            return response()->json(['error' => 'Vous n\'ête plus connecter'], 401);
        }
        return response()->json(json_decode($response), 200);
    }

    public function getPages(){
        if($this->facebook_token_infos != null){
            $response = $this->facebook->getPages($this->facebook_token_infos->token);
            if(!is_array($response) && is_string($response) && $response == 'OAuthException'){ // Si le token est invalide
                return response()->json(['error' => 'Vous n\'ête plus connecter'], 401);
            }
            return var_dump($response);            
        }else return response()->json(['error' => 'Veuillez vous connecter à facebook'], 401);

    }

    public function getPosts($hahstag){
        // $response = $this->facebook->getPosts($h)
    }
}


// https://stackoverflow.com/questions/42945596/how-to-integrate-facebook-php-sdk-with-laravel-5-4t"ranch é