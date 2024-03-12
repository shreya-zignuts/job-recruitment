<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\JobListing;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display the dashboard with all jobs and categories.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {  
        $jobs = JobListing::all();
        $categories = Category::all();
        $selectedCategories = null;
        return view('job_seeker.dashboard',compact('jobs','categories','selectedCategories'));
    }

    /**
     * Display a single job listing with its categories.
     *
     * @param  int $id The ID of the job listing.
     * @return \Illuminate\View\View
     */
    public function showListings($id)
    {
        $job = JobListing::find($id);

        if(!$job) {
            return redirect()->route('job_seeker.dashboard')->with('fail','Data not found') ;
        }
        
        $categories = $job->categories;
        return view('job_seeker.actions.viewJobListing', compact('job', 'categories'));

    }
    
    /**
     * Display all job listings.
     *
     * @return \Illuminate\View\View
     */
    public function allListings()
    {
        $jobs = JobListing::all();
        return view ('job_seeker.showAllListings', ['jobs' => $jobs]);
    }

    /**
     * Filter job listings by selected categories.
     *
     * @param  \Illuminate\Http\Request $request The HTTP request.
     * @return \Illuminate\View\View
     */
    public function filterCategories(Request $request)
    {
        $request->validate([
            'categories' => 'required|array',
        ]);

        $selectedCategories = $request->categories;
        $categories = Category::all();

        $jobs = JobListing::whereHas('categories', function ($query) use ($selectedCategories) {
            $query->whereIn('id', $selectedCategories);
        })->get();

        return view('job_seeker.dashboard', compact('jobs','categories','selectedCategories'));
    }

    /**
     * Display all companies.
     *
     * @return \Illuminate\View\View
     */
    public function showAllCompanies()
    {
        $jobs = JobListing::paginate(15);
        return view('job_seeker.companies',compact('jobs'));
    }

    /**
     * Display the resume page.
     *
     * @return \Illuminate\View\View
     */
    public function showResume()
    {
        return view('job_seeker.resume');
    }
}
