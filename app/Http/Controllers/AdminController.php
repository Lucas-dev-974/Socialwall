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
        $validator = Validator::make($request->all(), [
            'name' => 'required:string',
            'type' => 'required:string',
            'value' => 'required:string'
        ]);
        if($validator->fails()) abort(response()->json(['error' => $validator->failed()]));
        $this->validated = $validator->validated();
        // abort(response()->json(['ok' => $request->input('name')]));   
    }


    public function get(Request $request){}

    public function set(Request $request){
        $adminSettings = AdminSettings::where([
            'name' => $this->validated['name']
        ]);
        if($adminSettings) return response()->json(['error' => 'ce parametre existe déjà']);
        $adminSettings = new AdminSettings();
        $adminSettings['name'] = $this->validated['name'];
        $adminSettings['type'] = $this->validated['type'];
        $adminSettings['value'] = $this->validated['value'];
        $adminSettings->save(); 


        return response()->json(['adminsettings' => $adminSettings]);
    }

    public function update(Request $request){
        
    }
}
