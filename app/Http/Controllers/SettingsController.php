<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class SettingsController extends Controller
{
    public function get(Request $request){
        $user = JWTAuth::user();
        $user_settings = Setting::where(['user_id' => $user->id ])->get();

        if(!$user_settings) return response()->json(['error' => 'Pas de paramètre pour cet utilisateur'], 403);
        return response()->json($user_settings, 200);
    }
    
    public function set_Settings(Request $request){
        $user = JWTAuth::user();
        $validator = Validator::make($request->all(), [
            // 'user_id' => 'required|number',
            'type'    => 'required|string',
            'name'    => 'required|string',
            'value'   => 'required|string'
        ]);

        if($validator->fails()) return response()->json(['error' => $validator->errors()]);
        
        // Setting::create(array( 
        //     'name'    => $validator->validated()['name'], 
        //     'user_id' => $user->id, 
        //     'type'    => $validator->validated()['type'], 
        //     'value'   => $validator->validated()['value'] 
        // ));

        $setting = new Setting();
        $setting->name = $validator->validated()['name'];
        $setting->user_id = $user->id;
        $setting->type    =  $validator->validated()['type'];
        $setting->value   = $validator->validated()['value'];
        $setting->save();
        
        return response()->json('Parametre mis à jour');
    }

    public function update(Request $request){
        $user = JWTAuth::user();
        $validator = Validator::make($request->all(), [
            // 'user_id'  => 'required:int',
            'value'   => 'required:string',
            'name'    => 'string:required',
        ]);

        if($validator->fails()) return response()->json(['error' => $validator->errors()]);

        $setting = Setting::where(['user_id' => $user->id, 'name' => $validator->validated()['name']])->first();
        $setting->value = $validator->validated()['value'];

        return response()->json('Données mis à jour avec succès', 200);
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
