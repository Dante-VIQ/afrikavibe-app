<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Todo extends Model
{
    use HasFactory;

    protected $filllable = ['user_id', 'name', 'due'];

    // protected $hidden = ['user_id'];

     // Relationship To User
     public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
