<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class userController extends Controller
{
    //
    public function store(Request $request)
    {
        return dd($request);
    }
    public function login()
    {
        return view('layouts.login');
    }
}
