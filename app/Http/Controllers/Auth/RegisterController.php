<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\Auth\Users;
use Exception;

class RegisterController extends Controller
{
    public function save(RegisterRequest $request)
    {
        try {
            // Get the uploaded avatar file
            $avatar = $request->file('avatar');
            $avatarName = uniqid('avatar_') . '.' . $avatar->getClientOriginalExtension();
            $avatar->storeAs('public/assets/users', $avatarName);

            $username = Str::slug($request->input('fullName'));

            $suffix = 1;
            $originalUsername = $username;
            while (Users::where('username', $username)->exists()) {
                $username = $originalUsername . '-' . $suffix++;
            }

            // Prepare user data
            $user = [
                'email'     => $request->input('email'),
                'fullName'  => $request->input('fullName'),
                'phone'     => $request->input('phone'),
                'password'  => $request->input('password'),
                'avatar'    => $avatarName,
                'username'  => $username
            ];

            Users::create($user);

            return response()->json([
                'user'    => $user,
                'message' => 'Proses pendaftaran akun berhasil'
            ], 201);
        } catch (Exception $error) {
            return response()->json([
                'message' => "We're experiencing an issue",
                'errors'  => $error->getMessage()
            ], 500);
        }
    }
}
