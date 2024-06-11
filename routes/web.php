<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::prefix('auth')->group(function () {
    Route::get('login', fn () => view('auth.login'));
    Route::get('register', fn () => view('auth.register'));
    Route::get('otp', function () {
        $email = session()->get('email') ?? 'test@gmail.com';
        return view('auth.otp', [
            'email' => $email
        ]);
    });

    Route::prefix("verification")->group(function () {
        Route::post('login', [LoginController::class, 'save']);
        Route::post('register', [RegisterController::class, 'save']);
        Route::post('otp', [RegisterController::class, 'emailVerification']);
    });
});
