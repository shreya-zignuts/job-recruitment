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
}
