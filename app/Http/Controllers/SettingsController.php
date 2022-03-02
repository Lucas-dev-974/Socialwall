<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class SettingsController extends Controller
{
    public function get(Request $request, $wallid){
        $user = JWTAuth::user();
        $wallSetting = Setting::where(['wall_id' => $wallid ])->with('wall')->first();

        if(!$wallSetting) return response()->json(['error' => 'Pas de paramètre pour ce mur']);
        if($wallSetting->wall->user_id == $user->id || $user->role_id == 1){
            return response()->json($wallSetting);
        }else{
            return response()->json(['error' => 'Vous n\'êtes pas autorisé à accédé à cet ressource !']);
        }
    }
    
    public function set_Settings(Request $request){
        $user = JWTAuth::user();
        $validator = Validator::make($request->all(), [
            'wall_id' => 'required|number',
            'type'   => 'required|string',
            'name'   => 'required|string',
            'value'  => 'required|string'
        ]);
        if($validator->fails()) return response()->json(['error' => $validator->errors()]);
        
        Setting::create(array_merge($validator->validated()));
        return response()->json('Parametre mis à jour');
    }

    public function update(Request $request){
        $user = JWTAuth::user();
        
        $validator = Validator::make($request->all(), [
            'field'  => 'required:string',
            'wallid'  => 'required:int',
            'value'  => 'required:string',
            'name' => 'string:required',

        ]);
        if($validator->fails()) return response()->json(['error' => $validator->errors()]);

        $wallSettings = Setting::where(['wall_id' => 'wallid', 'name' => $validator->validated()['name']])->with('wall')->first();

        if($wallSettings->wall->user_id == $user->id || $user->role_id == 1){
            
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
