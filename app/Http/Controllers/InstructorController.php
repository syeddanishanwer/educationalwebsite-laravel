<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use Illuminate\Http\Request;

class InstructorController extends Controller
{
    public function save(Request $request)
    {
        $request->validate([ 
        "name"=>"required |max:50|min:5|unique:instructors,name",
        "designation"=>"required |max:50|min:5",
        "facebook_link"=>"nullable",
        "twitter_link"=>"nullable",
        "instagram_link"=>"nullable",
        "img"=>"image",

        ]);

        $instructor = new Instructor();
        $instructor->name = $request->name;
        $instructor->designation = $request->designation;
        $instructor->facebook_link = $request->filled('facebook_link') ? $request->facebook_link : null;
        $instructor->twitter_link = $request->filled('twitter_link') ? $request->twitter_link : null;
        $instructor->instagram_link = $request->filled('instagram_link') ? $request->instagram_link : null;
        // Handle Image Upload (Same as Edit logic)
        if ($request->hasFile('img')) {
            $imageName = time() . '_' . $request->img->extension();
            $request->img->move(public_path('uploads'), $imageName);
            $instructor->img = 'uploads/' . $imageName;
        } else {
            $instructor->img = 'img/default.jpg';
        }

        // Standardized Status logic
        $instructor->status = ($request->status == 1) ? 'active' : 'inactive';

        $instructor->save();

        return redirect()->back()->with('success', 'Instructor Added Successfully!');
    }

    public function update(Request $request, $id)
    {
        $instructor = Instructor::findOrFail($id);

        // 1. Handle Image Upload
        if ($request->hasFile('img')) {
            // Optional: delete old image if it exists and isn't the default
            if ($instructor->img && $instructor->img !== 'img/default.jpg' && file_exists(public_path($instructor->img))) {
                unlink(public_path($instructor->img));
            }

            $imageName = time() . '.' . $request->img->extension();
            $request->img->move(public_path('uploads'), $imageName);
            $instructor->img = 'uploads/' . $imageName;
        }

        // 2. Update fields
        $instructor->name = $request->name;
        $instructor->designation = $request->designation;
        $instructor->facebook_link = $request->filled('facebook_link') ? $request->facebook_link : null;
        $instructor->twitter_link = $request->filled('twitter_link') ? $request->twitter_link : null;
        $instructor->instagram_link = $request->filled('instagram_link') ? $request->instagram_link : null;
        // Standardized Status logic (Maps the 1/0 from form to string)
        $instructor->status = ($request->status == 1) ? 'active' : 'inactive';

        $instructor->save();

        return redirect()->route('show.instructors')->with('success', 'Instructor Updated!');
    }

    public function delete($id)
    {
        $instructor = Instructor::findOrFail($id);

        // Delete physical file if it exists
        if ($instructor->img && $instructor->img !== 'img/default.jpg' && file_exists(public_path($instructor->img))) {
            unlink(public_path($instructor->img));
        }

        $instructor->delete();

        return redirect()->route('show.instructors')->with('success', 'Instructor deleted successfully!');
    }
}
