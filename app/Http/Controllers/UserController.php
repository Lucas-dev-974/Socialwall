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

    public function get(Request $request){
        $user = JWTAuth::user();
        if($user->role_id !== 1) return response()->json(['error' => 'Vous ne pouvez pas accèdé à cet variable']);

        $users = User::with(['walls'])->get();

        return response()->json(['users' => $users]);
    }

    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            'userid' => 'required|integer',
            'field' => 'required|string',
            'value' => 'required|string',
        ]);

        
        if($validator->failed()) return response()->json(['error' => $validator->fails()]);

        $user = JWTAuth::user();
        $availableFields = ['email', 'password', 'name', 'lastname', 'phone', 'blocked'];

        
        if($user['role_id'] == 1 || $user['id'] == $request['userid']){
            if(in_array($request['field'], $availableFields, true)){
                if($request['field'] == 'email'){
                    if(!filter_var($request['value'], FILTER_VALIDATE_EMAIL)){
                        return response()->json(['is not email']);
                    }
                    $userViaEmail = User::where(['email' => $request['value']])->first();
                    if($userViaEmail) return response()->json(['error' => 'L\'email est déjà enregistrer, connecté vous']);                       
                }

                $user = User::where(['id' => $request['userid']])->first();
                
                // if($user[$request['field']] == 'blocked' && $request['value'] == 1) $request['value'] = !$request['value'];

                $user[$request['field']] = $request['value'];
                $user->save();

                return response()->json(['data ' . $request['field'] . ' was modified']);
            }
            return response()->json(['error' => 'Désoler une erreur est survenue, un mauvais parametre à été renseigner !']);
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

    public function upload(Request $request){

    }

    public function search(Request $request){
        $user = JWTAuth::user();
        if($user->role_id !== 1) return response()->json(['error' => 'Vous ne pouvez accédé à cet ressource']);

        $validator = Validator::make($request->all(), [
            'query' => 'string',
        ]);

        $users = User::where('name', 'like', '%' . $validator->validated()['query'] . '%')
                       ->orWhere('lastname', 'like', '%'  . $validator->validated()['query'] . '%')
                       ->orWhere('email', 'like', '%'  . $validator->validated()['query'] . '%')
                       ->with(['walls'])->get();

        return response()->json(['users' => $users]);
    }
}
