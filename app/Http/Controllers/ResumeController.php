<?php

namespace App\Http\Controllers;

use App\Models\Resume;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ResumeController extends Controller
{
    public function showUploadForm()
    {
        return view('job_seeker.resume');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'resume' => 'required|mimes:pdf,jpg,png|max:6048', // PDF file, max 2MB
        ]);

        $user = Auth::user();
        $resumeFile = $request->file('resume');
        $resumeFilename = $resumeFile->getClientOriginalName();
        $resumePath = $request->file('resume')->store('public/resumes');

        $user->resume()->create([
            'filename' => $resumeFilename,
            'path' => $resumePath,
        ]);

        return redirect()->back()->with('success', 'Resume uploaded successfully!');
    }

    public function download()
    {
        $user = Auth::user();

        if ($user->resume) {
            $filePath = storage_path('app/' . $user->resume->path);
            if (file_exists($filePath)) {
                return response()->download($filePath);
            } else {
                dd("File does not exist at path: " . $filePath);
            }
        } else {
            return redirect()->back()->with('error', 'No resume uploaded yet.');
        }
    }

    public function show()
    {
        $user = Auth::user();

        if (!$user->resume) {
            return redirect()->back()->with('error', 'No resume uploaded yet.');
        }

        $resumePath = storage_path('app/' . $user->resume->path);

        // Determine the content type of the file
        $contentType = mime_content_type($resumePath);

        // Return the response with appropriate content type
        return response()->file($resumePath, ['Content-Type' => $contentType]);
    }

    public function delete()
    {
        $user = Auth::user();

        if ($user->resume) {
            // Delete resume file and database entry
            Storage::delete($user->resume->path);
            $user->resume->delete();

            return redirect()->back()->with('success', 'Resume deleted successfully!');
        } else {
            return redirect()->back()->with('error', 'No resume uploaded yet.');
        }
    }
}

