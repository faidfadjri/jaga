<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu\Record;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $username = $request->input('username') ?? session('user')->username;
        session()->put('active', 'menu');
        
        $records = DB::table('criminal_records')
            ->where('userId', session('user')->id)
            ->select('id', 'userId', 'crimeType', 'description', 'date', 'location')
            ->get();


        return view('pages.menu', [
            'username' => $username, 'records' => $records
        ]);
    }
}
