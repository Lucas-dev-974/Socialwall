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

    public function __construct()
    {
        $this->middleware('jwt.verify',  ['except' => ['public_wall']]);
        $this->user = JWTAuth::user();
    }
    
    public function public_wall(Request $request){
        $wallid = $request->wallid;
        if(empty($wallid)) return response()->json(['error' => 'Veuillez renseigner l\'id du mur']);

        $wall = Wall::where([ 'id' => $wallid])->with(['posts', 'settings'])->first();
        return response()->json($wall, 200);
    }




    public function get(Request $request, $wallid = null){
        $walls = Wall::where(['user_id' => $this->user->id])->with(['settings', 'views'])->get();
        if(sizeof($walls) == 1) return response()->json($walls[0]);
        else return response()->json($walls);
    }
    
    public function create(Request $request){
        $validator = Validator::make($request->all(), [ 'wallname' => 'required:string' ]);

        if($validator->fails()) return response()->json(['error' => $validator->errors()]);

        // Create wall in database
        $wall = Wall::create([
            'user_id' =>  $this->user->id,
            'moderated' => true,
            'name'      => $validator->validated()['wallname'],
        ]);

        return response()->json($wall);
    }

    public function update(Request $request){
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
        if($wall->user_id == $this->user->id || $this->user->role == 1){
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
            // return response()->json($id);
            if($this->user['role_id'] == 1 || $this->user['id'] == $id) {
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

    public function add_Moderator(){
        
    }

    public function remove_Moderator(){

    }
}
