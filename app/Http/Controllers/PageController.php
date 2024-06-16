<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        session()->put('active', 'home');
        return view('pages.index');
    }

    public function about()
    {
        session()->put('active', 'about');
        return view('pages.about');
    }
}
