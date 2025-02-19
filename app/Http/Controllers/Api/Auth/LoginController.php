<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Models\ActiveCode;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function authentication(LoginRequest $request)
    {
        $credentials = $request->only('phone', 'password');

        if($request->login_type === 'password'){
            if(Auth::attempt($credentials)){
                $user = User::query()->where('phone', $credentials['phone'])->first();
                $token = $user->createToken('Client Api Token')->plainTextToken;

                return apiResponse([
                    'user' => $user,
                    'token' => $token
                ], 'با موفقیت وارد شدید');
            }else{
                return apiResponse([], 'رمزعبور اشتباه میباشد', 422, false);
            }
        }else{
            $user = User::query()->where('phone', $request->phone)->first();

            /* Generate Login Code */
            $code = ActiveCode::generateCode($user);
            /* Generate Login Code */

            /* Notify To User */
//            $user->notify(new LoginCodeNotification($code));
            /* Notify To User */

            return apiResponse([], 'کد یکبار مصرف برای شما ارسال شد');
        }
    }
}
