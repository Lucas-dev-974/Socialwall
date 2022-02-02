<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    public function get_me(Request $request){
        $user = JWTAuth::user();
        return response()->json($user);
    }

    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            'userID' => 'required:int',
            'fields' => 'required:string',
            'values' => 'required:string',
        ]);
        if($validator->failed()) return response()->json(['error' => $validator->failed()]);

        $user = JWTAuth::user();
        $availableFields = ['email', 'password', 'name', 'lastname', 'phone'];

        if($user['role_id'] == 1 || $user['id'] == $validator->validated()['userID']){
            return 'okkokok';
        }
    }

    public function delete(Request $request, $id){
        if(isset($id) && !empty($id)){
            $user = JWTAuth::user();
            // return response()->json($id);
            if($user['role_id'] == 1 || $user['id'] == $id) {
                $userToDel = User::where('id', $id)->first();
                $userToDel->delete();
                return response()->json([
                    'user' => $userToDel
                    // 'utilisateur' => $user
                ]);
            }else{
                return response()->json([
                    'error' => 'vous n\'ête pas autorisé à modifié cet ressource !',
                ]);
            }
        }
    }
}
