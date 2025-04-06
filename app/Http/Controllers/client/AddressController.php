<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AddressController extends Controller
{
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string'],
            'latitude' => ['required', 'string', 'max:255'],
            'longitude' => ['required', 'string', 'max:255']
        ]);

        if($validation->fails()){
            $validation->errors()->all();
        }

        /* Create Address */
        auth()->user()->addresses()->create($validation->validated());
        /* Create Address */

        return redirect(route('dashboard') . '#profile-addresses');
    }

    public function destroy(Address $address)
    {
        // check for exists PetController
        if($address->requests->count()){
            session()->flash('notification', 'این ادرس در یکی از درخواست های شما ثبت شده است. شما نمیتوانید این ادرس را حذف کنید.');
            return redirect(route('dashboard') . '#profile-addresses');
        }

        $address->delete();

        session()->flash('notification-success');
        session()->flash('notification', 'ادرس با موفقیت حذف شد');
        return redirect(route('dashboard') . '#profile-addresses');
    }
}
