<?php

namespace App\Http\Controllers;

use App\Models\AdminSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AdminController extends Controller
{
    public function __construct(Request $request)
    {
        $user = JWTAuth::user();
        if($user->role_id !== 1){
            abort(response()->json(['error' => 'Accés refuser']));   
        }
    }


    public function get(Request $request, $name){
        $names = explode('|', $name);
        if(sizeof($names) > 1){
            $admin_settings = AdminSettings::whereIn('name', $names)->get();
            $settings = null;
            // return $admin_settings;
            foreach($admin_settings as $setting){
                $settings[$setting['name']] = $setting['value'];
            }
            if($settings == null) return response()->json(['error' => 'La donnés demander n\'existe pas !'], 403);
            return response()->json(json_encode($settings));

        }else{
            $adminSetting = AdminSettings::where([ 'name' => $name ])->first();
            if($adminSetting == null) return response()->json(['error' => 'Désoler ressource non disponible']);
            return response()->json($adminSetting);
        }

    }

    public function set(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required:string',
            'type' => 'required:string',
            'value' => 'required:string'
        ]);

        
        if($validator->fails()) return response()->json(['error' => $validator->failed()]);
        $adminSetting = AdminSettings::where([
            'name' => $validator->validated(['name'])
        ])->first();
        
        // return response()->json(['setting admin' => $adminSetting]);

        if($adminSetting == null) $adminSetting = new AdminSettings();

        
        $adminSetting['name']  = $validator->validated()['name'];
        $adminSetting['type']  = $validator->validated()['type'];
        

        // if($validator->validated()['type'] == 'password') $adminSetting['value'] = Hash::make($validator->validated()['value'], [
        //     'rounds' => 7,
        // ]);
        $adminSetting['value'] = $validator->validated()['value'];
        $adminSetting->save(); 


        return response()->json(['adminsettings' => $adminSetting]);
    }

    public function update(Request $request){
        
    }
}
