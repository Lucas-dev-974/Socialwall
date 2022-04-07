<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class SettingsController extends Controller
{

    public function __construct(){
        $this->user = JWTAuth::user();
    }

    public function get(Request $request){
        $Settings = Setting::where(['user_id' => $this->user->id, 'wall_id' => $request->wallid])->get();
        foreach($Settings as $setting){
            if($this->isJson($setting->value)){
                  $settings[$setting->name] = json_decode($setting->value);
            }else $settings[$setting->name] = $setting->value;
        }

        return response()->json($settings);
    }

    public function all(Request $request){
        $wallid = $request->wallid;
        if(empty($wallid)) return response()->json(['error' => 'L\'id du mur est menquant']);
        
        $settings = Setting::where(['wall_id' => $wallid])->get();
        return response()->json($settings);
    }

    public function UpdateOrCreate(Request $request){
        $user = JWTAuth::user();
        $validator = Validator::make($request->all(), [
            'name'    => 'required|string',
            'value'   => 'required|string',
            'wallid'  => 'required|integer'
        ]);
        if($validator->fails()) return response()->json(['error' => $validator->errors()]);
        $setting = Setting::where(['name' => $validator->validated()['name'], 'user_id' => $user->id])->first();

        if($setting){
            $setting->value   = $validator->validated()['value'];
            $setting->save();
        }else{
            $setting = new Setting();
            // Insert data
            $setting->name    = $validator->validated()['name'];
            $setting->user_id = $user->id;
            $setting->wall_id = $validator->validated()['wallid'];
            $setting->type    =  'wall-style';
            $setting->value   = $validator->validated()['value'];
            $setting->save();
        }
        return response()->json('Parametre mis à jour');
    }

    // public function delete(Request $request, $id){
    //     if(isset($id) && !empty($id)){
    //         $user = JWTAuth::user();
            
    //         if($id == 0 || !is_int($id)) return response()->json(['error' => 'Déolser l\'id renseigner n\'est pas correct']);

    //         $wallSetting = Setting::where(['id' => $id])->delete();
    //         return $wall;
    //     }
    // }

    private function isJson($string){
        return is_string($string) && is_array(json_decode($string, true)) && (json_last_error() == JSON_ERROR_NONE) ? true : false;
    }

}
