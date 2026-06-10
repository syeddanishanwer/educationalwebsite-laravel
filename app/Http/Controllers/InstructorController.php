<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use Illuminate\Http\Request;

class InstructorController extends Controller
{
    public function save(Request $request){

    $instructor = new Instructor();
    $instructor->name=$request->name;  //table name and forum input name
    $instructor->designation=$request->designation; 
    $instructor->facebook_link=$request->facebook_link; 
    $instructor->twitter_link=$request->twitter_link; 
    $instructor->instagram_link=$request->instagram_link; 
    $instructor->img='default.png'; 
    $instructor->status='active'; 
    $instructor->save();

    return redirect()->back()->with('success', 'Instructor Added Successfully!');

    }
}
