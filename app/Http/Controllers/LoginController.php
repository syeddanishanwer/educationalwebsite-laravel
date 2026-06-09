<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function match(Request $request){
       Auth::attempt(['email' => $request->email, 'password' => $request->password]); 
         return redirect()->route('dashboard');    

    }
}
