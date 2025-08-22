<?php

namespace App\Models;

use App\Models\User;
use App\TrackableViews;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Doctor extends Model
{
    use HasFactory;

    // use Searchable;
    use TrackableViews;

    protected $fillable = ['user_id', 'name', 'category', 'department', 'detail', 'links', 'image'];

    protected $hidden = ['user_id'];

    public function toSearchableArray(){
        return [
        'id' => $this->id,
        'name' => $this->name,
        'detail' => $this->detail,
        ];
    }

      public function comments()
    {
        return $this->morphMany(Comments::class, 'commentable');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
