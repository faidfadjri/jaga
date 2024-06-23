<?php

namespace App\Http\Controllers;

use App\Models\Auth\Users;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $userId = $request->input('userId') ?? session('user')->id;
        $user     = Users::find($userId);

        session()->put('active', 'menu');

        return view('pages.menu', [
            'user' => $user
        ]);
    }
}
