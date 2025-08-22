<?php

namespace App\Models;

use App\Models\User;
use App\Models\Comments;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class City extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'name', 'country', 'image'];

    public function comments()
{
    return $this->morphMany(Comments::class, 'commentable');
}

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
