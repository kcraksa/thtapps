<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\News;

class Topics extends Model
{
    use HasFactory;

    protected $fillable = ['topic'];

    public function news()
    {
        return $this->hasMany(News::class);
    }
}
