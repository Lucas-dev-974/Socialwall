<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Providers\FacebookRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class FacebookController extends Controller
{

    protected $facebook;

    public function __construct(Request $request)
    {   

        $currentPath = Route::getFacadeRoot()->current()->uri();
        
        
        // Get connected user
        $this->user = JWTAuth::user();
        if(!$this->user) return abort(response()->json(['error' => 'Veuillez vous connectez !']));

        // Bypass middleware 
        $this->middleware('jwt.verify', ['except' => ['index', 'callback']]);
        $this->facebook       = new FacebookRepository();

        // Get Facebook token for the user
        if(!str_contains($currentPath, 'after-connection')){
            $facebook_token_infos = Setting::where(['user_id' => $this->user->id, 'name' => 'facebook_token_infos'])->first();
            if(isset($facebook_token_infos) && !empty($facebook_token_infos)) // Check if he have token 
                $this->facebook_token_infos = json_decode($facebook_token_infos['value']);
            else
                abort(response()->json(['error' => 'Veuillez vous connecter à facebook'], 401));
        }

    } 


    public function getProfile(){

        $response = $this->facebook->getProfile($this->facebook_token_infos->token);
        
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

    public function afterConnection(Request $request){
        return response()->json('in good method');
        // $validator = Validator::make($request->all(), [
        //     'fb_userid' => 'required|integer',
        //     'fb_username' => 'required|string',
        //     'fb_token'    => 'required|string',

        //     'userid' => 'required|integer',
        //     'wallid' => 'required|integer'
        // ]);

        // if($validator->failed()) return response()->json($validator->fails());
        // return response()->json($validator->validated());
        // $response = $this->facebook->getLongLiveToken($validator->validated()['fb_token']);
        // return response()->json($response);
    }
}


// https://stackoverflow.com/questions/42945596/how-to-integrate-facebook-php-sdk-with-laravel-5-4t"ranch é