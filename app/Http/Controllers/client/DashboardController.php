<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Breed;
use App\Models\PetCategory;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $orders = auth()->user()->orders->all();
        $requests = auth()->user()->requests->all();
        $addresses = auth()->user()->addresses->all();
        $pets = auth()->user()->pets->all();
        $favorites = auth()->user()->favorites->all();
        $petCategories = PetCategory::query()->where('is_active', 1)->get();
        $breeds = Breed::query()->where('is_active', 1)->get();

        return view('client.dashboard', compact('orders', 'requests', 'addresses', 'pets', 'favorites', 'petCategories', 'breeds'));
    }
}
