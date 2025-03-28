<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
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
        return view('client.dashboard', compact('orders', 'requests', 'addresses', 'pets', 'favorites'));
    }
}
