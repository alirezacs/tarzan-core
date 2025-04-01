<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        return view('client.request.index', compact('request'));
    }
}
