<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $username = $request->input('username');
        session()->put('active', 'menu');
        return view('pages.menu');
    }
}
