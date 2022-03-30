<?php

namespace App\Http\Controllers;

use App\Mail\ConfirmEmail;
use App\Mail\ResetPassword;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

class MailController extends Controller
{
    public function ConfirmMail(Request $request){
        $validator = Validator::make($request->all(), [
            'email'    => "required|email",
            'name'     => 'string',
            'lastname' => 'string'
        ]);

        Mail::to('lucas.lvn97439@gmail.com')->send(new ConfirmEmail(
            $validator->validated()['email'],
            $validator->validated()['name'],
            $validator->validated()['lastname']
        ));

        if (Mail::failures()) {
            return response()->Fail('Sorry! Please try again latter');
       }else{
            return response()->success('Great! Successfully send in your mail');
        }
    }




}
