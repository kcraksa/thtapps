<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $fillable = ['topic_id', 'title', 'content', 'status'];

    public function getAllNews($filters)
    {
        return DB::table('news')
                    ->join('topics', 'news.topic_id', '=' , 'topics.id')
                    ->select('news.title', 'topics.topic', 'news.status', 'news.id')
                    ->where($filters)
                    ->orderBy('news.id', 'DESC')
                    ->paginate(10);
    }
}
