<?php

namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\JobListing;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Mail;

class JobListingController extends Controller
{
    /**
     * Display a listing of the job listings associated with categories.
     *
     * @param  \Illuminate\Http\Request $request The HTTP request.
     * @return \Illuminate\View\View
     */
    public function index(){

        $jobs = JobListing::with('categories')->where('user_id', auth()->user()->id)->paginate(7);
        $categories = Category::all();
        return view('employer.joblisting', compact('jobs','categories'));
    }

    /**
     * Show the form for creating a new job listing.
     *
     * @return \Illuminate\View\View
     */
    public function create(){
        $categories = Category::all();
        return view('employer.create',compact('categories'));
    } 

    /**
     * Store a newly created job listing in storage.
     *
     * @param  \Illuminate\Http\Request $request The HTTP request.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request){
        
        $request->validate([
            'categories'    => "required|array",
            'company_name'  => "required",
            'title'         => "required",
            'description'   => "required",
            'requirements'  => "required",
            'location'      => "required",
            'salary'        => "required|regex:/^\d{1,8}(\.\d{1,2})?$/",
            'status'        => "required|in:active,closed",
        ]);

        $jobs = auth()->user()->jobListings()->create($request->only([
            'company_name',
            'title',
            'description',
            'requirements',
            'location',
            'salary',
            'status',
            ]) + ['created_by' => auth()->user()->id]
        );
         
        $jobs->categories()->attach($request->categories);

        return redirect()->route('employer.dashboard')->with('success', 'Job Listing successful');
    }

    /**
     * Display the specified job listing.
     *
     * @param  int $id The job listing ID.
     * @return \Illuminate\View\View
     */
    public function allListings($id)
    {
        $jobs = JobListing::find($id);
        if(!$jobs) {
            return redirect()->route('employer.dashboard')->with('fail','Data not found') ;
        }
        return view ('employer.actions.viewJobListing', ['job' => $jobs]);

    }

    /**
     * Show the form for editing the specified job listing.
     *
     * @param  int $id The job listing ID.
     * @return \Illuminate\View\View
     */
    public function editForm($id)
    {
            $jobs = JobListing::find($id);

            if(!$jobs) {
                return redirect()->route('employer.dashboard')->with('fail','Data not found') ;
            }
            
            $categories = Category::all();
            return view('employer.actions.editJobListings', compact('jobs', 'categories'));
    }

    /**
     * Update the specified job listing in storage.
     *
     * @param  \Illuminate\Http\Request $request The HTTP request.
     * @param  int $id The job listing ID.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $jobs = JobListing::find($id);
        if(!$jobs) {
            return redirect()->route('employer.dashboard')->with('fail','Data not found') ;
        }

        $jobListing = $request->validate([
            'categories'    => "required|array",
            'company_name'  => "required",
            'title'         => "required",
            'description'   => "required",
            'requirements'  => "required",
            'location'      => "required",
            'salary'        => "required|regex:/^\d{1,8}(\.\d{1,2})?$/",
            'status'        => 'required|in:active,closed',
        ]);

        $jobListing['updated_by'] = auth()->user()->id;

        $jobs->update($jobListing);

        $jobs->categories()->sync($request->categories);

        return redirect()->route('employer.dashboard')->with('success', "JobListing Updated Successfully");
    }

    /**
     * Remove the specified job listing from storage.
     *
     * @param  int $id The job listing ID.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $jobs = JobListing::find($id);
        if(!$jobs){
            return redirect()->route('employer.dashboard')->with('fail', 'Joblisting not found');
        }
        $jobs->delete();
        return redirect()->route('employer.dashboard')->with('success', 'Job Listing deleted successfully');
    }

    public function showMail(Request $request){
        $resumePath = $request->resume;
        return view('job_seeker.sendMail')->with('resumePath',$resumePath);
    }

    public function sendEmailWithResume(Request $request)
    {
        $user = Auth::user();

        $resumePath = $request->resume;
        $message = $request->input('message');
        
        $employerEmail = '';

        if ($user->role === 'employer') {
            $employerEmail = $user->email;
        } else {
            return redirect()->route('resume.mail')->with('fail','Role not exists');
        }

        Mail::to($employerEmail)->send(new JobApplicationMail($message, $resumePath));

        return redirect()->back()->with('success', 'Email sent to employer with resume attached.');

    }

}