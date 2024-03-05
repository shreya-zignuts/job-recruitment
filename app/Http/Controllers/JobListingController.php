<?php

namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\JobListing;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth;

class JobListingController extends Controller
{
    public function index(Request $request){
        $jobs = JobListing::with('categories')->where('user_id', auth()->user()->id)->get();
        $categories = Category::all();
        return view('employer.joblisting', compact('jobs','categories'));
    }

    public function create(){
        $categories = Category::all();
        return view('employer.create',compact('categories'));
    } 

    public function store(Request $request){
        $request->validate([
            'categories.*' => "required|array",
            'categories.*.id' => "required",
            'company_name' => "required",
            'title' => "required",
            'description' => "required",
            'requirements' => "required",
            'location' => "required",
            'salary' => "required|integer",
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
       dd($request->categories);
        $jobs->categories()->attach([$request->categories]);

        return redirect()->route('employer.dashboard')->with('success', 'Job Listing successful');
    }

    public function show_job_listings($id){
        $jobs = JobListing::findOrFail($id);
        return view ('employer.viewJobListing', ['job' => $jobs]);
    }

}
