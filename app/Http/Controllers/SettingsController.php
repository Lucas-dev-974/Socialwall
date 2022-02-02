<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class SettingsController extends Controller
{
    public function get(Request $request, $wallid = null){
        $user = JWTAuth::user();

        $wallSetting = Setting::where([
            'wall_id' => $wallid
        ])->with('wall')->first();
        
        if($wallSetting->wall->user_id == $user->id || $user->role_id == 1){
            return response()->json($wallSetting);
        }else{
            return response()->json(['error' => 'Vous n\'êtes pas autorisé à accédé à cet ressource !']);
        }
        return $wallSetting;
    }
    
    // public function create(Request $request){
    //     $user = JWTAuth::user();

    //     $validator = Validator::make($request->all(), [
    //         'wallname' => 'required:string', 
    //     ]);

    //     if($validator->fails()) return response()->json(['error' => $validator->errors()]);

    //     // Setting::create([
    //     //     ''
    //     // ]);

    //     // return response()->json(['wall' => $wall]);
    // }

    public function update(Request $request){
        $user = JWTAuth::user();
        
        $validator = Validator::make($request->all(), [
            'fields'  => 'required:string',
            'wallid'  => 'required:int',
            'values'  => 'required:string',
            'options' => 'string',
        ]);
        if($validator->fails()) return response()->json(['error' => $validator->errors()]);

        $wallSettings = Setting::where(['wall_id' => 'wallid'])->with('wall')->first();

        if($wallSettings->wall->user_id == $user->id || $user->role_id == 1){
            switch($validator->validated()['field']){
                case 'hashtag':
                    $wallSettings->hashtag = $validator->validated()['value'];
                    $wallSettings->save();
                    break;

                case 'blocked_user':
                    if($validator->validated()['options']) {}

                    break;

                case 'suspect_words':
                    break;

                default: 
                    return response()->json(['error' => 'Désoler impossible d\'effectuer cet action']);
            }


        }else return response()->json(['error' => 'Vous n\'êtes pas autorisé à modifier cet ressource !']);


    }

    // public function delete(Request $request, $id){
    //     if(isset($id) && !empty($id)){
    //         $user = JWTAuth::user();
            
    //         if($id == 0 || !is_int($id)) return response()->json(['error' => 'Déolser l\'id renseigner n\'est pas correct']);

    //         $wallSetting = Setting::where(['id' => $id])->delete();
    //         return $wall;
    //     }
    // }

}
