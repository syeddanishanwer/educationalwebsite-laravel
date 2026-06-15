<?php

use App\Http\Controllers\InstructorController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PageController;


// 1. Public Landing Homepage
Route::get('/', [PageController::class,'home'])->name('homepage');

// 2. Protected User Dashboard Area
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard')->middleware('auth');

// 3. Display Visual Login Page Form
Route::get('/login', function () {
    return view('login');
})->name('loginpage');


Route::get('/add-instructor', [PageController::class, 'addinstructor']) ->name('add.instructor')->middleware('auth');

Route::get('/all-instructor', [PageController::class, 'showinstructor']) ->name('show.instructors')->middleware('auth');


Route::post('/login-attempt', [LoginController::class, 'match'])->name('login.match');

Route::post('/save-instructor', [InstructorController::class, 'save'])->name('instructor.save')->middleware('auth');

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

// Route to show the edit form
Route::get('/edit-instructor/{id}', [PageController::class, 'editinstructor'])->name('instructors.edit')->middleware('auth');

// Route to handle the update action
Route::put('/update-instructor/{id}', [InstructorController::class, 'update'])->name('instructors.update')->middleware('auth');

// Route to handle the delete action
Route::delete('/delete-instructor/{id}', [InstructorController::class, 'delete'])->name('instructors.delete')->middleware('auth');
