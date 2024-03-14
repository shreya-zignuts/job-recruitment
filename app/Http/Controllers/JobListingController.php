<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Category;
use App\Models\JobListing;
use Illuminate\Http\Request;
use App\Mail\JobApplicationMail;
use Illuminate\Support\Facades\Auth;
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
        return view ('employer.actions.viewJobListing', compacts('jobs','mailSent'));

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

    public function showMail(Request $request, $id) {
        $job = JobListing::find($id);
        if (!$job) {
            return redirect()->route('employer.dashboard')->with('fail', 'Job listing not found');
        }
        return view('job_seeker.sendMail', ['job' => $job]);
    }

    public function sendEmail(Request $request, $id)
    {
        $job = JobListing::find($id);

        if(!$job){
            return redirect()->route('employer.dashboard')->with('fail', 'Joblisting not found');
        }

        $resume = Auth::user()->resume;

        if ($resume) {
            $resumePath = $resume->path;
        } else {
            return redirect()->back()->with('fail', 'Resume not found');
        }
    
        $userName = Auth::user()->name;
        $userEmail = Auth::user()->email;
        
        $mailMessage = $request->mailMessage;

        $employer = User::where('role', 'employer')->findOrFail($job->user_id);
        $employerName = $employer->name;
        $employerEmail = $employer->email;

        Mail::to($employerEmail)->send(new JobApplicationMail($mailMessage, $resumePath, $userName, $employerName, $userEmail));

        $mailSentKey = 'email_sent_' . auth()->user()->id . '_job_' . $id;
        session([$mailSentKey => true]);

        return redirect()->route('job_seeker.dashboard')->with('success', 'Email sent to employer with resume attached.');
    }
}