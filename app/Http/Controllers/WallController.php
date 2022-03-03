<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Views;
use App\Models\Wall;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class WallController extends Controller
{
    
    public function get(Request $request, $wallid){
        $user = JWTAuth::user();
        if(!$wallid){               // Check if wall id is given is not given return all wall for the connected user
            $walls = Wall::where([ 'user_id' => $user['id'] ])->get();
            return $walls;
        }

        $wall = Wall::where([ 'id' => $wallid])->with(['settings', 'views', 'suspectWords', 'BlockedUsers'])->first();

        if($user['id'] == $wall['user_id'] || $user['role_id'] == 1){
            $wall->settings();
            $wall->views();
            return response()->json(['wall' => $wall]);
        }else return response()->json([ 'error' => 'Vous n\'ête pas autorisé à récuperer cet ressource']);
    }
    
    public function create(Request $request){
        $user = JWTAuth::user();
        $validator = Validator::make($request->all(), [
            'wallname' => 'required:string', 
        ]);

        if($validator->fails()) return response()->json(['error' => $validator->errors()]);

        $wall = Wall::create([
            'user_id' =>  $user['id'],
            'moderated' => true,
            'name'      => $validator->validated()['wallname'],
        ]);

        $views = new Views();
        $views->wall_id = $wall->id;
        $views->date    = date('Y-m-d H:i:s');

        $wall->views    = $views;

        return response()->json($wall);
    }

    public function update(Request $request){
        $user = JWTAuth::user();
        $validator = Validator::make($request->all(), [
            'field' => 'required:string',
            'wallid' => 'required:int',
            'value'  => 'required:string'
        ]);
        if($validator->fails()) return response()->json(['error' => $validator->errors()]);


        $available_fields = ['moderated', 'hashtag', 'name', 'background_url', 'background_color'];
        
        // Get wall where id is id given
        $wall = Wall::where([ 'id' => $validator->validate()['wallid']])->first();

        // return $wall->fillable;
        if($wall->user_id == $user->id || $user->role_id == 1){
            if(in_array($validator->validated()['field'], $available_fields, true)){
                $wall[$validator->validated()['field']] = $validator->validated()['value'];
                $wall->save();
            }else{
                return response()->json(['error' => 'Le paramete ' . $validator->validated()['field'] . ' n\'existe pas !'], 404);
            }
            return response()->json('Le paramete ' . $validator->validated()['field'] . ' à été mis à jours');
        }else return response()->json([ 'error' => 'Vous n\'avez pas accès à la modification de cet ressource !']);

    }

    public function delete(Request $request, $id){
        if(isset($id) && !empty($id)){
            $user = JWTAuth::user();
            // return response()->json($id);
            if($user['role_id'] == 1 || $user['id'] == $id) {
                $wall = Wall::where('id', $id)->first();
                if(!$wall) return response()->json(['error' => 'Le wall n\'existe pas !']);

                $wall->delete();
                return response()->json(['deleted' => true]);
            }else{
                return response()->json([
                    'error' => 'vous n\'ête pas autorisé à modifié cet ressource !',
                ]);
            }
        }
    }
}
