<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

use App\Models\Tags;
use App\Models\Topics;

class News extends Model
{
    use HasFactory;

    protected $fillable = ['topics_id', 'title', 'content', 'status'];

    public function tags()
    {
        return $this->hasMany(Tags::class);
    }

    public function topics()
    {
        return $this->belongsTo(Topics::class);
    }
}
