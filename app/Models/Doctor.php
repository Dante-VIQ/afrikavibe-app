<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'name', 'category', 'department', 'detail', 'links', 'image'];

    protected $hidden = ['user_id'];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
