<?php

namespace App\Http\Controllers\Menu;

use App\Http\Controllers\Controller;
use App\Models\Auth\Attachment;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class VerifController extends Controller
{
    public function store(Request $request)
    {
        try {
            // Validate the request
            $validatedData = $request->validate([
                'ktp' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            if ($request->file('ktp')) {
                $ktp = $request->file('ktp');
                $uniqueName = uniqid() . '_' . $ktp->getClientOriginalName();
                $ktp->storeAs('users', $uniqueName, 'public');

                // save to database
                Attachment::create([
                    'fileName' => $uniqueName,
                    'fileType' => $ktp->getClientOriginalExtension(),
                    'userId'  => session()->get('user')->id
                ]);
            }

            return redirect()->back()->with('message', 'KTP uploaded successfully!');
        } catch (Exception $error) {
            Log::critical($error->getMessage());
            return response()->json([
                'message' => "we're experiencing an issue"
            ], 500);
        }
    }
}
