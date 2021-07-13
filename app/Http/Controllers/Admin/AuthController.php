<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AccessToken;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function signup()
    {
        return view('landing.signup');
    }

    public function handleSignup(Request $request)
    {
        $input = $request->except('_token');
        $rules = array(
            'name'   => 'required|min:4|max:40',
            'email'      => 'required|email|unique:users,email',
            'password' => 'required|alpha_num|min:6|max:20');

        $messages = array(
            'min' => 'Hmm, that looks short.',
            'max' => 'Oops, that too long you might forget.',
            'alpha_num'  => 'Use alphabet or alphabet with numbers to secure your password.');


        $validator = Validator::make($input, $rules, $messages);

        if (!$validator->passes()) {
            flash('Something is wrong with your entries')->warning();
            return back()->withInput()->withErrors($validator);
        }

        $input['name'] = ucfirst($input['name']);
        $input['password'] = Hash::make($input['password']);
        User::create($input);
        flash('Account created successfully')->success();
        $credentials = $request->except('_token', 'name');


        if (Auth::attempt($credentials,true))
        {
            $bytes = random_bytes(10);
            $user = auth()->user();
            $accessData['user_id'] = $user->id;
            $accessData['token'] = "ACT-".bin2hex($bytes);
            AccessToken::create($accessData);


//            if($user->hasRole('admin') || $user->hasRole('admin2')){
//                return redirect('admin/dashboard');
//            }else{
//                Auth::logout();
//                flash('Access denied! Unauthorised login')->warning();
//                return redirect('/admin/login');
//            }
            return redirect('/admin/dashboard');

        }
        else
        {
            flash('Hey! Contact admin, could not login')->warning();
            return back();
        }


    }

    public function login()
    {
        if(Auth::check()) {
            return redirect('admin/dashboard');
        }
        else {
            flash('Access denied! Unauthorised login')->warning();
            return redirect('/');

        }
    }

    public function handleLogin(Request $request)
    {
        $credentials = $request->except('_token');
        $rules = array(
            'email'      => 'required|email',
            'password' => 'required');

        $validator = Validator::make($credentials, $rules);

        if (!$validator->passes()) {
            flash('Something is wrong with your entries')->warning();
            return back()->withInput()->withErrors($validator);
        }

        if (Auth::attempt($credentials,true)) {
            $user = auth()->user();
            flash('Welcome back '.$user->name)->success ();
            return redirect('admin/dashboard');
        }
        else {
            flash('Awh! Incorrect login details')->warning();
            return back()->withInput()->withErrors($validator);
        }

    }

    public function handleLogout ()
    {
        Auth::logout();
        flash('You have successfully log out')->success();
        return redirect('/');
    }
}
