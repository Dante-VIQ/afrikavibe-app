<?php

namespace App\Models;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;

class HeaderMedia extends Model
{
   protected $fillable = [
        'user_id', 'title', 'body', 'media_path', 'media_type', 'location'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
