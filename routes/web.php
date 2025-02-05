<?php

use App\Models\RequestType;
use Illuminate\Support\Facades\Route;

Route::get('/',function (){
    $req = \App\Models\RequestType::where('name', 'visit')->first();

    dd($req->handlingTypes);
});
