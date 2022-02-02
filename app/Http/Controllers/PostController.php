<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class PostController extends Controller
{
    public function get(Request $request, $hashtag = null){
        $user = JWTAuth::user();
        if(!$hashtag){               // Check if wall id is
            $posts = Post::where([ 'hashtag' => $user['id'] ])->get();

            return $posts;
        }

        $post = Post::where([ 'id' => $hashtag])->first();
        return response()->json(['post' => $post]);
    }
    
    public function create(Request $request){
        $user = JWTAuth::user();
        
        $validator = Validator::make($request->all(), [
            'fb_user_id' => 'required:string', 
            'platform'   => 'required:string',
            
        ]);

        if($validator->fails()) return response()->json(['error' => $validator->errors()]);

       

        return response()->json(['wall' => '']);
    }

    public function update(Request $request){
        $user = JWTAuth::user();
        
        $validator = Validator::make($request->all(), [
            'fields' => 'required:string',
            'postid' => 'required:int',
            'values'  => 'required:string'
        ]);
        if($validator->fails()) return response()->json(['error' => $validator->errors()]);

        // Splite the string to get array of fields and values
        $fields = explode(":", $validator->validated()['fields']);
        $values = explode(':', $validator->validated()['values']);

        // Get wall where id is id given
        $post = Post::where([ 'id' => $validator->validate()['postid']])->first();
        if($post->user_id == $user->id){
            foreach($fields as $key => $field){
                return response()->json($post[$fields[$key]]);
                if($post[$fields[$key]]){
                    return response()->json($fields[$key]);
                    // return response()->json($values[$key]);
                    // $post[$field] = $values[$key];
                    $post->save();
                }

            }
            // return response()->json([ 'updated' => true, 'wall' => $wall ]);
        }else return response()->json([ 'error' => 'Vous n\'avez pas accès à la modification de cet ressource !']);

    }

    public function delete(Request $request, $id){
        if(isset($id) && !empty($id)){
            $user = JWTAuth::user();
            // return response()->json($id);
            if($user['role_id'] == 1 || $user['id'] == $id) {
                $post = Post::where('id', $id)->first();
                if(!$post) return response()->json(['error' => 'Le post n\'existe pas !']);

                $post->delete();
                return response()->json(['deleted' => true]);
            }else{
                return response()->json([
                    'error' => 'vous n\'ête pas autorisé à modifié cet ressource !',
                ]);
            }
        }
    }
}
