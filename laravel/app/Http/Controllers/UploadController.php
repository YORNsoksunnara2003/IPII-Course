<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function showForm()
    {
        return view('upload_file');
    }

    public function uploadFile(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:10240' // 10MB max
        ]);

        $path = $request->file('file')->store('uploads');

        return back()->with('success', 'File uploaded successfully to ' . $path);
    }
}

