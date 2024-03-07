<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Resume extends Model
{
    use HasFactory;
    protected $fillable = ['filename', 'path'];

    public function user() {
        return $this->belongsTo(User::class);
    }
}