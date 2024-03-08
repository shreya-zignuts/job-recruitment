<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\JobListingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/employer/dashboard', [JobListingController::class, 'index'])->name('employer.dashboard')->middleware('can:isEmployer');
    Route::get('/job_seeker/dashboard', [UserController::class, 'index'])->name('job_seeker.dashboard')->middleware('can:isJobSeeker');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

Route::middleware('auth')->group(function () {
    Route::get('/job-listing', [JobListingController::class, 'index'])->name('employer.dashboard');
    Route::get('/create', [JobListingController::class, 'create'])->name('employer.create');
    Route::post('/store',[JobListingController::class, 'store'])->name('employer.store');
    Route::get('/show/{id}',[JobListingController::class, 'show_job_listings'])->name('employer.show');
    Route::get('/edit/{id}',[JobListingController::class, 'edit_form'])->name('employer.edit');
    Route::post('/update/{id}', [JobListingController::class, 'update'])->name('employer.update');
    Route::post('/delete/{id}', [JobListingController::class, 'delete'])->name('employer.delete');

});

Route::middleware('auth')->group(function () {
    Route::get('/view/{id}',[UserController::class, 'showListings'])->name('job_seeker.show');
    Route::get('/alllistings',[UserController::class, 'all_job_listings'])->name('job_seeker.job_listings');
    Route::post('/filter-job-listings', [UserController::class, 'filterCategories'])->name('job_seeker.filter');
    Route::get('/companies',[UserController::class, 'showAllCompanies'])->name('job_seeker.companies');

});

Route::middleware('auth')->group(function () {
    Route::get('/resumes', [ResumeController::class, 'showUploadForm'])->name('resume.form');
    Route::post('/upload', [ResumeController::class, 'upload'])->name('upload.resume');
    Route::get('/download', [ResumeController::class, 'download'])->name('download.resume');
    Route::post('/delete', [ResumeController::class, 'delete'])->name('delete.resume');
    Route::get('/resume/show', [ResumeController::class, 'show'])->name('resume.show');

});


require __DIR__.'/auth.php';
