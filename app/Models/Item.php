<?php

namespace App\Models;

use App\Models\Partner;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['partner_id', 'name', 'image', 'description', 'price'];

    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }
}
