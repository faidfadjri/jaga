<?php

namespace App\Http\Controllers\Auth;

use App\Models\Auth\Users;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;

class LoginController extends Controller
{
    public function save(LoginRequest $request)
    {
        $email_or_username = $request->input('email_or_username');
        $password          = $request->input('password');

        $user              = Users::where("email", $email_or_username)->orWhere("username", $email_or_username)->first();
        if (!$user) return response()->json([
            'message' => 'Uknown email or username',
            'error'   => 'USER_NOT_FOUND'
        ], 404);

        if (!Hash::check($password, $user->password)) return response()->json([
            'message' => 'Wrong password',
            'error'   => 'INVALID'
        ], 403);


        session()->put('user', $user);
        return response()->json([
            'message' => 'Login succeed',
            'user'    => $user
        ], 200);
    }

    public function logout()
    {
        session()->flush();
        return redirect()->to('/');
    }
}
