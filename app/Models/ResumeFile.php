<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Models\JobSeeker;

class ResumeFile extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function jobSeeker(){
        return $this->belongsTo(JobSeeker::class, 'id', 'job_seeker_id');
    }
    public $timestamps = false;
}
