<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoogleDriveMaterial extends Model
{
    use HasFactory, HasUuid;

    protected $fillable = ['topic_id', 'title', 'google_drive_url', 'description', 'order'];

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }
}