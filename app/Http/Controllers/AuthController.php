<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.verify', ['except' => ['login', 'register']]);
    }

    public function login(Request $request){
        $credentials = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if($credentials->fails()) return response()->json(['error' => 'Veuillez saisir touts les champs requis', $credentials->errors()], 403);

        if (! $token = auth()->attempt($credentials->validated())) {
            return response()->json(['error' => 'Email ou mot de passe incorrecte'], 401);
        }
        
        return $this->respondWithToken($token);
    }


    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,20',
            'lastname' => 'required|string|between:2,20',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $registerDatas = $validator->validated();
        $registerDatas['password'] = bcrypt($request->password);
        $registerDatas['role_id']  = 1;

        $user = User::firstOrCreate($registerDatas);    

        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user,
        ], 201);
    }

    protected function respondWithToken($token){
        return response()->json([
            'access_token' => $token,
        ]);
    }

    public function TestToken(Request $request){
        return response()->json(['success' => true]);
    }
}
