<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory, HasUuid;
    protected $fillable = ['topic_id', 'title', 'youtube_url', 'order'];
    
    public function topic() { 
        return $this->belongsTo(Topic::class); 
    }
}