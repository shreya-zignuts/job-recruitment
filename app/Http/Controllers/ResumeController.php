<?php

namespace App\Http\Controllers;

use App\Models\Resume;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ResumeController extends Controller
{
    /**
     * Display the resume upload form.
     *
     * @return \Illuminate\View\View
     */
    public function showUploadForm()
    {
        return view('job_seeker.resume');
    }

    /**
     * Upload a resume file.
     *
     * @param  \Illuminate\Http\Request $request The HTTP request.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function upload(Request $request)
    {
        $request->validate([
            'resume' => 'required|mimes:pdf,jpg,png|max:6048', 
        ]);

        $user = Auth::user();
        $resumeFile = $request->file('resume');
        $resumeFilename = $resumeFile->getClientOriginalName();
        $resumePath = $request->file('resume')->store('public/resumes');
        
        $user->resume()->create([
            'filename' => $resumeFilename,
            'path' => $resumePath,
            'created_by' => $user->id,
        ]);

        return redirect()->back()->with('success', 'Resume uploaded successfully!');
    }

    /**
     * Download the uploaded resume file.
     *
     * @return \Illuminate\Http\Response
     */
    public function download()
    {
        $user = Auth::user();

        if ($user->resume) {
            $filePath = storage_path('app/' . $user->resume->path);
            if (file_exists($filePath)) {
                return response()->download($filePath);
            } else {
                return redirect()->back()->with("File does not exist at path: " . $filePath);
            }
        } else {
            return redirect()->back()->with('error', 'No resume uploaded yet.');
        }
    }

    /**
     * Display the uploaded resume file.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user = Auth::user();

        if (!$user->resume) {
            return redirect()->back()->with('error', 'No resume uploaded yet.');
        }

        $resumePath = storage_path('app/' . $user->resume->path);

        $contentType = mime_content_type($resumePath);

        return response()->file($resumePath, ['Content-Type' => $contentType]);
    }

    /**
     * Delete the uploaded resume file.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete()
    {
        $user = Auth::user();

        if ($user->resume) {
            Storage::delete($user->resume->path);
            $user->resume->delete();

            return redirect()->back()->with('success', 'Resume deleted successfully!');
        } else {
            return redirect()->back()->with('error', 'No resume uploaded yet.');
        }
    }
}