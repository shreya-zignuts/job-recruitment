<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\JobListing;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    protected $JobListingController;

    public function index()
    {
        $categories = Category::all();
        return view('employer.categories', compact('categories'));
    }

}
