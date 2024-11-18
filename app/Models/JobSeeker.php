<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\ResumeFile;

class JobSeeker extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function resume(){
        return $this->hasOne(ResumeFile::class, 'job_seeker_id', 'id');
    }
}
