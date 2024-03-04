<?php

namespace App\Http\Controllers;


use App\Models\JobListing;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth;

class JobListingController extends Controller
{
    public function index(){
        $jobs = JobListing::where('user_id', auth()->user()->id)->get();
        return view('employer.dashboard', compact('jobs'));
    }

    public function create(){
        return view('employer.create');
    }

    public function store(Request $request){

        $request->validate([
            'company_name' => "required",
            'title' => "required",
            'description' => "required",
            'requirements' => "required",
            'location' => "required",
            'salary' => "required",
            'status' => 'required|in:active,closed',
        ]);


        $jobs = auth()->user()->jobListings()->create($request->only([
            'company_name',
            'title',
            'description',
            'requirements',
            'location',
            'salary',
            'status'

        ]));

        return redirect()->route('employer.dashboard')->with('success', 'Job Listing successful');
    }

    public function show_job_listings($id){
        $jobs = JobListing::findOrFail($id);
        return view ('employer.viewJobListing', ['job' => $jobs]);
    }

}
