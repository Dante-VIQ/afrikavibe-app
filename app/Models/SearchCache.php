<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SearchCache extends Model
{
      protected $fillable = ['query','type','results'];
    protected $casts = ['results' => 'array'];
}
