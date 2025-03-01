<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function update(Request $request)
    {
        /* Validate Request */
        $data = $request->validate([
            'first_name' => ['required', 'max:255'],
            'last_name' => ['required', 'max:255'],
            'email' => ['required', 'unique:users,email,'.auth()->user()->id],
        ]);
        /* Validate Request */

        /* Update User */
        auth()->user()->update($data);
        /* Update User */

        return apiResponse([], 'کاربر با موفقیت بروزرسانی شد');
    }
}
