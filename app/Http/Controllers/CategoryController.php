<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\JobListing;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    protected $JobListingController;

    public function showCategorySelection()
    {   
        $categories = Category::all();
        $jobListings = collect();
        $selectedCategory = null;
        return view('employer.categories', compact('categories', 'jobListings','selectedCategory'));
    }

    public function showJobListings(Request $request)
    {
        
        $selectedCategoryIds = $request->input('categories', []);
        
        $jobListings = JobListing::whereHas('categories', function ($query) use ($selectedCategoryIds) {
            $query->whereIn('category_id', $selectedCategoryIds);
        })->get();

        $selectedCategory = null;
        if (!empty($selectedCategoryIds)) {
            $selectedCategory = Category::find($selectedCategoryIds[0]);
        }
        $categories = Category::all();

        return view('employer.categories', compact('categories', 'jobListings','selectedCategory'));
    }

}