<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TripPlan extends Model
{
      protected $fillable = [
        'user_id',
        'external_destination_name',
        'external_destination_id',
        'title',
        'preferences',
        'is_curated',
        'is_downloaded'
    ];
    protected $casts = [
        'preferences' => 'array',
        'is_curated' => 'boolean',
        'is_downloaded' => 'boolean'
    ];

    public function itineraries() {
        return $this->hasMany(Itinerary::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
