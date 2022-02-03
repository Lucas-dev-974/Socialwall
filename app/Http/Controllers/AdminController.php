<?php

namespace App\Http\Controllers;

use App\Models\AdminSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AdminController extends Controller
{
    public function __construct(Request $request)
    {
        $user = JWTAuth::user();

        // abort(response()->json(['ok' => $request->input('name')]));   
    }


    public function get(Request $request){}

    public function set(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required:string',
            'type' => 'required:string',
            'value' => 'required:string'
        ]);

        if($validator->fails()) return response()->json(['error' => $validator->failed()]);
        $adminSettings = AdminSettings::where([
            'name' => $validator->validated(['name'])
        ]);
        if($adminSettings) return response()->json(['error' => 'ce parametre existe déjà']);
        $adminSettings = new AdminSettings();
        $adminSettings['name'] = $validator->validated(['name']);
        $adminSettings['type'] = $validator->validated(['type']);
        $adminSettings['value'] = $validator->validated(['value']);
        $adminSettings->save(); 


        return response()->json(['adminsettings' => $adminSettings]);
    }

    public function update(Request $request){
        
    }
}
