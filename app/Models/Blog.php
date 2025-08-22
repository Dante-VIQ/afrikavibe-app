<?php

namespace App\Models;

use App\Models\User;
use App\Models\Comments;
use App\TrackableViews;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Usamamuneerchaudhary\Commentify\Traits\Commentable;

class Blog extends Model
{
    use HasFactory;
    // use Commentable;
    // use Searchable;
    use TrackableViews;

      protected $fillable = ['title', 'image', 'description', 'category'];

      protected $hidden = ['user_id'];

      public function toSearchableArray(){
        return [
        'id' => $this->id,
        'title' => $this->title,
        'description' => $this->description
        ];
    }
      public function scopeFilter($query, array $filters) {
        // if($filters['tag'] ?? false) {
        //     $query->where('tags', 'like', '%' . request('tag') . '%');
        // }

        if($filters['search'] ?? false) {
            $query->where('title', 'like', '%' . request('search') . '%')
                ->orWhere('description', 'like', '%' . request('search') . '%')
                ->orWhere('category', 'like', '%' . request('search') . '%')
                ->orWhere('tags', 'like', '%' . request('search') . '%');
        }
    }

    public function comments()
{
    return $this->morphMany(Comments::class, 'commentable');
}

    // Relationship To User
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
