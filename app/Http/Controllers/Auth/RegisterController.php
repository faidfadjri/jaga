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

use function PHPUnit\Framework\returnSelf;

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

            // Generate a random 6-digit OTP & save to session
            $otp = mt_rand(100000, 999999);
            session()->save('email', $user['email']);
            session()->save('otp', $otp);

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
        if (!$request->has('otp')) {
            return response()->json(['error' => 'OTP is missing'], 400);
        }

        $OTP      = $request->input('otp');
        $validOTP = session()->get('otp');
        $email    = session()->get('email');

        if ($OTP != $validOTP) return response()->json([
            'message' => 'Your OTP code not valid'
        ], 403);

        $updated = Users::where("email", $email)->update([
            'isEmailVerified' => true
        ]);

        return response()->json([
            'message' => "Verification email is completed"
        ], 200);
    }
}
