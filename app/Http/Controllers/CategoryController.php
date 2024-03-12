<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\JobListing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $user = Auth::user();
        $selectedCategoryIds = $request->input('categories', []);
        
        $jobListings = $user->jobListings()->whereHas('categories', function ($query) use ($selectedCategoryIds) {
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