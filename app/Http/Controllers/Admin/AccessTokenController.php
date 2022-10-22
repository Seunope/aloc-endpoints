<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AccessToken;
use Illuminate\Http\Request;

class AccessTokenController extends Controller
{
    public function index (){

        $access = AccessToken::whereUserId(auth()->user()->id)->first();
        $data['token'] = $access->token;
        $data['count'] = $access->count;
        $data['lastUsed'] = $access->updated_at;

        return view('admin.access_token')->with($data);
    }

    public function generateNewToken (){

        $access = AccessToken::whereUserId(auth()->user()->id)->first();
        $bytes = random_bytes(10);
        $token = "QB-".bin2hex($bytes);
        $access->update(['token'=> $token]);
        flash('New token created successfully')->success();

        return redirect('admin/access-token');
    }
}
