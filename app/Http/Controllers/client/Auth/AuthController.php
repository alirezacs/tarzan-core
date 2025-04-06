<?php

namespace App\Http\Controllers\Client\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('client.auth.login');
    }

    public function authentication(LoginRequest $request)
    {
        if(auth()->check()){
            return redirect()->route('dashboard');
        }
        $credentials = $request->only('phone', 'password');

        if($request->login_type === 'password'){
            if(Auth::attempt($credentials)){
                return redirect()->route('dashboard');
            }else{
                session()->flash('notification', 'اطلاعات وارد شده معتبر نمیباشد');
                return redirect()->back();
            }
        }
    }

    public function register(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'unique:users,phone'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        /* Register User */
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);
        /* Register User */

        /* Create Basket */
        $user->basket()->create([]);
        /* Create Basket */

        /* Login User */
        \auth()->login($user);
        /* Login User */

        return redirect(route('dashboard'));
    }
}
