<?php

namespace App\Models;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobListing extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['company_name', 'title', 'description', 'requirements', 'location', 'salary', 'status', 'category_id','created_by','updated_by'];

    public function user() {
        return $this->belongsTo(User::class);
    }
    
    public function categories() {
        return $this->belongsToMany(Category::class, 'job_listing_category');
    }

    public function createdBy() {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy() {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
