<?php

namespace App\Models;

use App\Models\Item;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    protected $fillable = ['name', 'logo', 'tagline', 'description', 'website_url', 'country', 'sponsorship_level'];

    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
