<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\ProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function update(ProfileRequest $request)
    {
        $data = $request->only([
            'first_name',
            'last_name',
            'email',
            'avatar'
        ]);


        /* Check For Avatar */
        if ($request->hasFile('avatar')) {
            auth()->user()->clearMediaCollection('avatar');
            auth()->user()->addMediaFromRequest('avatar')->toMediaCollection('avatar');
        }
        /* Check For Avatar */

        /* Update User */
        auth()->user()->update($data);
        /* Update User */

        return redirect()->route('dashboard');
    }
}
