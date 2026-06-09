<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LoginController;

// 1. Public Landing Homepage
Route::get('/', function () {
    return view('welcome');
})->name('homepage');

// 2. Protected User Dashboard Area
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard')->middleware('auth');

// 3. Display Visual Login Page Form
Route::get('/login', function () {
    return view('login');
})->name('loginpage');

Route::post('/login-attempt', [LoginController::class, 'match'])->name('login.match');

// Route::post('/login-attempt', function (Request $request) {       
//   Auth::attempt(['email' => $request->email, 'password' => $request->password]); 
//         return redirect()->route('dashboard');    
// })->name('login.match');

Route::get('/about-us', function () {
    return view('aboutus');
})->name('aboutpage');

Route::get('/contact-us', function () {
    return view('contactus');
})->name('contactpage');