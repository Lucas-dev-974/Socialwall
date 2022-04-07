<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.verify',  ['except' => ['login', 'register', 'ForgotPassword', 'ResetPassword', 'ViewResetPassword']]);
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

        $user = JWTAuth::user();
        if($user->blocked) return response()->json(['error' => 'Votre compté a été mis en suspend par un admin.'], 401);
        return response()->json([ 'token' => $token, 'user'  => $user ]);
    }


    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|between:2,20',
            'lastname' => 'required|string|between:2,20',
            'email'    => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $registerDatas = $validator->validated();
        $registerDatas['password'] = bcrypt($request->password);
        $registerDatas['role']  = 3;

        $user = User::firstOrCreate($registerDatas);    

        $token = auth()->login($user);
        
        return response()->json(['token' => $token, 'user' => $user ]);
    }


    public function TestToken(Request $request){
        return response()->json(['success' => true]);
    }

    // Email
    public function sendEmailVerification(Request $request){
        if($request->user()->hasVerifiedEmail()){
            return response()->json(['Email déjà vérifié !'], 200);
        }

        $request->user()->sendEmailVerificationNotification();
        return response()->json(['Un mail vous à été envoyer pour confirmer votre adresse email'], 200);
    }

    public function verifyEmail(EmailVerificationRequest $request){
        if($request->user()->hasVerifiedEmail()){
            return response()->json(['Votre email à déjà été vérifié !'], 200);
        }

        if($request->user()->markEmailAsVerified()){

        }
    }
    

    public function ResetPassword(Request $request){
        $validator = Validator::make($request->all(), [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        if($validator->fails()) return response()->json($validator->failed());
        $request->merge(['token' => $validator->validated()['token']['token']]);


        
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
     
                $user->save();
     
                event(new PasswordReset($user));
            }
        );
        
        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', __($status))
                    : back()->withErrors(['email' => [__($status)]]);
    }

    public function ForgotPassword(Request $request){
            
        $validator = Validator::make($request->all(), ['email'=> 'required|email' ]);
        if($validator->fails()) return response()->json($validator->failed(), 422);
        
        $status = Password::sendResetLink($validator->validated());
        
        $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => __($status)])
                    : back()->withErrors(['email' => __($status)]);

        return 'okok';
    }

    public function ViewResetPassword($token){
        return view('App', ['token' => $token]);
    }
}
