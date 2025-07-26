<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Lecturer extends Authenticatable
{
    use HasFactory, HasUuid;
    protected $table = 'lecturers';
    protected $guard = 'lecturer';
    protected $fillable = ['name', 'email', 'password'];
    protected $hidden = ['password'];

    public function courses() { return $this->belongsToMany(Course::class, 'course_lecturer'); }
}