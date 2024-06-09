<?php

use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Mail\OTPEmail;

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
    Mail::to('faidfadjri.ti@gmail.com')->send(new OTPEmail(58530));
    return view('welcome');
});


Route::prefix('auth')->group(function () {
    Route::get('login', fn () => view('auth.login'));
    Route::get('register', fn () => view('auth.register'));

    Route::prefix("verification")->group(function () {
        Route::post('register', [RegisterController::class, 'save']);
    });
});
