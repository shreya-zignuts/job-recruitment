<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\JobListing;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {  
        $jobs = JobListing::all();
        $categories = Category::all();
        return view('job_seeker.dashboard',compact('jobs','categories'));
    }

    public function show_listings($id){
        $job = JobListing::findOrFail($id);
        $categories = $job->categories;
        return view('job_seeker.actions.viewJobListing', compact('job', 'categories'));
    }
    

    public function all_job_listings(){
        $jobs = JobListing::all();
        return view ('job_seeker.showAllListings', ['jobs' => $jobs]);
    }

    public function filterCategories(Request $request)
    {
        $request->validate([
            'categories' => 'required|array',
        ]);

        $selectedCategories = $request->input('categories');

        $jobs = JobListing::whereHas('categories', function ($query) use ($selectedCategories) {
            $query->whereIn('id', $selectedCategories);
        })->get();

        return view('job_seeker.searchListings', ['jobs' => $jobs]);
    }

    public function showAllCompanies(){
        $jobs = JobListing::paginate(7);
        return view('job_seeker.companies',compact('jobs'));
    }

    public function showResume(){
        return view('job_seeker.resume');
    }
}
