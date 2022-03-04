<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
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
        $this->facebook = new FacebookRepository();
        $facebook_token_infos = Setting::where(['user_id' => $this->user->id, 'name' => 'facebook_token_infos'])->first();
        $this->facebook_token_infos = json_decode($facebook_token_infos['value']);
    }

    public function index(){
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

    public function getPages(){
        return $this->facebook_token_infos;
        $datas = $this->facebook->getPages($this->facebook_token_infos->token);
        return response()->json($datas);
    }

    // public function getProfile(Request $request){
    //     // $token = 
    // }
}


// https://stackoverflow.com/questions/42945596/how-to-integrate-facebook-php-sdk-with-laravel-5-4t"ranch 