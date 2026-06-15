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
    $instructors = Instructor::all();
    return view('allinstructor', compact('instructors'));
}

public function home() {
    $ins = Instructor::get();
    return view('welcome', compact('ins'));
}

public function editinstructor($id) 
    {
        $instructor = Instructor::findOrFail($id);
        
        return view('editinstructor', compact('instructor'));
    }

}