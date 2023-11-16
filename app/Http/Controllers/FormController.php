<?php

namespace App\Http\Controllers;

use App\Models\Img;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class FormController extends Controller
{
    public function index(): View 
    {   
        $existingFiles = Img::all();
        return view('boot.home', compact('existingFiles'));
    }

    public function store(Request $request)
    {
        // dd($request->all());

        // return view('boot.home');

        // Handle other form fields if needed
        $data = $request->all();

        // Handle file upload
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            foreach($file as $file) {
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('uploads', $fileName, 'public'); // Adjust the storage path as needed

            // Save file details to the database or perform other actions
            // Example: $data['file_path'] = 'uploads/' . $fileName;
            $img = new Img();
            $img->name = "Test";
            $img->path = 'uploads/' . $fileName;
            $img->user_id = 1;
            $img->save();
            }
        }

        // Save the $data array to the database or perform other actions

        return redirect()->back()->with('success', 'Form submitted successfully!');
    }
}
