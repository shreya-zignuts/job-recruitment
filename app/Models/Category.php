<?php

namespace App\Models;

use App\Models\JobListing;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function jobListings() {
        return $this->belongsToMany(JobListing::class, 'job_listing_category');
    }
}
