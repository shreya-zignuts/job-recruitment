<?php

namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\JobListing;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth;

class JobListingController extends Controller
{
    public function index(Request $request){

        $jobs = JobListing::with('categories')->where('user_id', auth()->user()->id)->paginate(7);

        return view('employer.joblisting', compact('jobs'));
    }

    public function create(){
        $categories = Category::all();
        return view('employer.create',compact('categories'));
    } 

    public function store(Request $request){
        $request->validate([
            'categories' => "required|array",
            'company_name' => "required",
            'title' => "required",
            'description' => "required",
            'requirements' => "required",
            'location' => "required",
            'salary' => "required|regex:/^\d{1,8}(\.\d{1,2})?$/",
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
        
        // foreach ($request->categories as $category_id) {
        //     $jobs->categories()->attach(['category_id' => $category_id]);
        // }
        $jobs->categories()->attach($request->categories);

        return redirect()->route('employer.dashboard')->with('success', 'Job Listing successful');
    }

    public function show_job_listings($id){
        $jobs = JobListing::findOrFail($id);
        return view ('employer.actions.viewJobListing', ['job' => $jobs]);
    }

    public function edit_form($id){
        $jobs = JobListing::findOrFail($id);
        $categories = Category::all();
        return view('employer.actions.editJobListings', compact('jobs', 'categories'));
    }

    public function update(Request $request, $id){

        $jobs = JobListing::findOrFail($id);

        $jobListing = $request->validate([
            'categories' => "required|array",
            'company_name' => "required",
            'title' => "required",
            'description' => "required",
            'requirements' => "required",
            'location' => "required",
            'salary' => "required|regex:/^\d{1,8}(\.\d{1,2})?$/",
            'status' => 'required|in:active,closed',
        ]);
        $jobs->update($jobListing);

        $jobs->categories()->sync($request->input('categories'));

        return redirect()->route('employer.dashboard')->with('success', "JobListing Updated Successfully");
    }

    public function delete($id){
        $jobs = JobListing::findOrFail($id);
        if(!$jobs){
            return redirect()->route('employer.dashboard')->with('fail', 'Joblisting notfound');
        }
        $jobs->delete();
        return redirect()->route('employer.dashboard')->with('success', 'Job Listing deleted successfully');
    }

}