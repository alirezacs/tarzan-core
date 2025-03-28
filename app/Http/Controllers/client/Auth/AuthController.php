<?php

namespace App\Http\Controllers\Client\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Auth\LoginRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('client.auth.login');
    }

    public function authentication(LoginRequest $request)
    {
        $credentials = $request->only('phone', 'password');

        if($request->login_type === 'password'){
            if(Auth::attempt($credentials)){
                return redirect()->route('dashboard');
            }else{
                return redirect()->back()->withErrors(['message' => 'اطلاعات وارد شده درست نمیباشد']);
            }
        }
    }
}
