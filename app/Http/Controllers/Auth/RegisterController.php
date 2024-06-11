<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Auth\Users;
use App\Mail\OTPEmail;
use Exception;
use Illuminate\Support\Facades\Hash;

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
                'password'  => Hash::make($request->input('password')),
                'avatar'    => $avatarName,
                'username'  => $username
            ];

            Users::create($user);

            // Generate a random 6-digit OTP & save to session
            $otp = mt_rand(100000, 999999);
            session()->put('email', $user['email']);
            session()->put('otp', $otp);

            // Send OTP
            Mail::to($user['email'])->send(new OTPEmail($otp));

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

    public function emailVerification(Request $request)
    {
        $otp = '';
        for ($i = 1; $i <= 6; $i++) {
            $otp = $otp . $request->input('otp-' . $i);
        }

        $validOTP = session()->get('otp');
        $email = session()->get('email');

        if ($otp != $validOTP) {
            return redirect()->back()->withErrors(['Your OTP code is not valid']);
        }

        Users::where("email", $email)->update([
            'isEmailVerified' => true
        ]);

        return redirect('/auth/login')->with('success', 'Email is verified, please login first');
    }
}
