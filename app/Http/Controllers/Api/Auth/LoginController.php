<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Models\ActiveCode;
use App\Models\User;
use App\Notifications\LoginCodeNotification;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * @param LoginRequest $request
     * @return Application|Response|\Illuminate\Contracts\Foundation\Application|ResponseFactory
     */
    public function authentication(LoginRequest $request): \Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
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
            $user->notify(new LoginCodeNotification($code));
            /* Notify To User */

            return apiResponse([], 'کد یکبار مصرف برای شما ارسال شد');
        }
    }

    /**
     * @param Request $request
     * @return Application|Response|\Illuminate\Contracts\Foundation\Application|ResponseFactory
     */
    public function verifyCode(Request $request): Application|Response|\Illuminate\Contracts\Foundation\Application|ResponseFactory
    {
        $request->validate([
            'phone' => ['required', 'exists:users,phone'],
            'code' => ['required', 'size:6']
        ]);

        $user = User::query()->where('phone', $request->phone)->first();

        $result = ActiveCode::verifyCode($user, $request->code);

        /* Check For Success Verify */
        if(!$result){
            return apiResponse([], 'کد وارد شده صحیح نمیباشد', 422, false);
        }
        /* Check For Success Verify */

        $token = $user->createToken('Tarzan Api Login Token')->plainTextToken;

        /* Delete User Codes */
        $user->activeCodes()->delete();
        /* Delete User Codes */

        return apiResponse([
            'token' => $token,
            'user' => $user
        ], 'با موفقیت وارد شدید');
    }

    /**
     * @param Request $request
     * @return Application|Response|\Illuminate\Contracts\Foundation\Application|ResponseFactory
     */
    public function me(Request $request): Application|Response|\Illuminate\Contracts\Foundation\Application|ResponseFactory
    {
        return apiResponse([
            'user' => \auth()->user()
        ]);
    }

    public function logout(Request $request): \Illuminate\Contracts\Foundation\Application|ResponseFactory|Application|Response
    {
        $request->user()->currentAccessToken()->delete();

        return apiResponse(message: 'با موفقیت خارج شدید');
    }
}
