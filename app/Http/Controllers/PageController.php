<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\instructor;
class PageController extends Controller
{
    public function addinstructor(){
    return view('addinstructor');
}

    public function showinstructor(){
    return view('allinstructor');
}

public function home() {
    $ins = Instructor::get();
    return view('welcome', compact('ins'));
}

}