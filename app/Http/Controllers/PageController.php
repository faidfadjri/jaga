<?php

namespace App\Http\Controllers;

use App\Models\Auth\Users;
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

    public function record(Request $request)
    {

        $records = Users::with(['attachment', 'crimes']);

        $keyword = $request->input('search') ?? null;
        $records->where("username", "like", "%$keyword%")->orWhere("email", "like", "%$keyword%");

        session()->put('active', 'record');

        return view('pages.admin.record', [
            'records' => $records->paginate(4)
        ]);
    }

    public function report()
    {
        session()->put('active', 'report');
        return view('pages.admin.report');
    }

    public function user()
    {
        session()->put('active', 'user');
        return view('pages.admin.user');
    }
}
