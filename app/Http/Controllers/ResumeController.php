<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resume;

class ResumeController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'resume' => 'required|mimes:pdf,doc,docx|max:2048', // Validate file type and size
        ]);

        if ($request->file('resume')->isValid()) {
            $path = $request->file('resume')->store('resumes'); // Store the file in storage/app/resumes directory

            // Save resume details to database
            Resume::create([
                'user_id' => auth()->id(),
                'file_name' => $request->file('resume')->getClientOriginalName(),
                'file_path' => $path,
            ]);

            return redirect()->back()->with('success', 'Resume uploaded successfully.');
        }

        return redirect()->back()->with('error', 'Failed to upload resume.');
    }
}

