<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\AccessToken;
use App\Models\PricePlan;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function signup()
    {
        return redirect()->away('https://aloc.com.ng/register?utm_source=questions_subdomain');
    }

    public function handleSignup(Request $request)
    {
        return redirect()->away('https://aloc.com.ng/register?utm_source=questions_subdomain');
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
        if (\Carbon\Carbon::now()->gte(\Carbon\Carbon::parse('2027-08-01 00:00:00'))) {
            flash('Legacy ALOC Endpoints has reached end-of-life and login is disabled. Please migrate to ALOC Station at aloc.com.ng')->warning();
            return redirect('/');
        }
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
