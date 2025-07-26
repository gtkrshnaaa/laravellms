<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseCategory extends Model
{
    use HasFactory, HasUuid;
    protected $fillable = ['name', 'slug'];

    public function subCategories()
    {
        return $this->hasMany(CourseSubCategory::class);
    }
}