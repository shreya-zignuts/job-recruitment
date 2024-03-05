<?php

namespace App\Models;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobListing extends Model
{
    use HasFactory;

    protected $fillable = ['company_name', 'title', 'description', 'requirements', 'location', 'salary', 'status', 'category_id'];

    public function user() {
        return $this->belongsTo(User::class);
    }
    
    public function categories() {
        return $this->belongsToMany(Category::class, 'job_listing_category','category_id','job_listing_id');
    }
}
