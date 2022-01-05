<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\News;

class Tags extends Model
{
    use HasFactory;

    protected $fillable = ['news_id', 'tag'];

    public function news()
    {
        return $this->belongsTo(News::class);
    }
}
