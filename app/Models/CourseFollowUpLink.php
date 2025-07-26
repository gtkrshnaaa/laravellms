<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseFollowUpLink extends Model
{
    use HasFactory;

    protected $fillable = ['course_id', 'label', 'url'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}