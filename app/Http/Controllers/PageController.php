<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class PageController extends Controller
{
    public function addinstructor(){
    return view('addinstructor');
}

    public function showinstructor(){
    return view('allinstructor.blade.php');
}

}