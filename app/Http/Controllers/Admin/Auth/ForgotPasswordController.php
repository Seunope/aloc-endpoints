<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{

    public function showForgetPasswordForm()
    {
        return view('landing.auth.forget_password');
    }

    public function submitForgetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = Str::random(64);
        $input['email'] = $request->email;
        $input['token'] = $token;

        PasswordReset::create($input);

        try{
            Mail::send('landing.emails.forget_password', ['token' => $token], function($message) use($request){
                $message->to($request->email);
                $message->subject('ALOC Endpoints Reset Password');
            });
        }catch (\Exception $e){
            //dd($e);
            flash('Could not send email. Please try again')->error();
            return back();
        }

        flash('We have e-mailed your password reset link!')->success();
        return redirect('/');

    }


    public function showResetPasswordForm($token) {
        return view('landing.auth.forget_password_link', ['token' => $token]);
    }

    public function submitResetPasswordForm(Request $request)
    {

        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);


        $updatePassword = PasswordReset::where([
                'email' => $request->email,
                'token' => $request->token])->first();

        if(!$updatePassword){
            flash('Invalid token!')->error();
            return back()->withInput()->with('error', 'Invalid token!');
        }

        $user = User::where('email', $request->email)
                      ->update(['password' => Hash::make($request->password)]);

        PasswordReset::where(['email'=> $request->email])->delete();

        flash('Your password has been changed!')->success();
        return redirect('/');

    }
}
