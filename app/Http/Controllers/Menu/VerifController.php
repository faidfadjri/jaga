<?php

namespace App\Http\Controllers\Menu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VerifController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'ktp' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // If validation fails, Laravel automatically redirects back with errors.
        // You don't need to manually check for validation errors here.

        // Handle the validated data (e.g., store the file, save the data to the database, etc.)
        if ($request->file('ktp')) {
            $path = $request->file('ktp')->store('ktp_images', 'public');
            // Save the path to the database or perform other actions
        }

        return redirect()->back()->with('message', 'KTP uploaded successfully!');
    }
}
