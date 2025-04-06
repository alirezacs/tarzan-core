<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use Illuminate\Http\Request;

class PetController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'pet_category_id' => ['required', 'exists:pet_categories,id'],
            'breed_id' => ['required', 'exists:breeds,id'],
            'name' => ['required', 'string', 'max:255'],
            'birthdate' => ['required', 'date'],
            'gender' => ['required', 'in:male,female'],
            'skin_color' => ['required', 'color'],
        ]);
    }

    public function destroy(Pet $pet)
    {
        if($pet = auth()->user()->pets->find($pet->id)){
            if($pet->requests()->where('status', 'pending_pay')->orWhere('status', null)->count()){
                session()->flash('notification', 'پت شما در حال حاضر در یک درخواست فعال موجود میباشد.');
                return redirect(route('dashboard') . '#profile-pets');
            }
            $pet->delete();

            session()->flash('notification-success');
            session()->flash('notification', 'پت شما با موفقیت از لیست حذف شد');
            return redirect(route('dashboard') . '#profile-pets');
        }
        return redirect(route('dashboard') . '#profile-pets');
    }
}
