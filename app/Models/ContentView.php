<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class ContentView extends Model
{
    protected $guarded = [];

    public function viewable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function todayStats()
    {
        return self::whereDate('created_at', today())->count();
    }

    public static function last30DaysTrends()
    {
        return self::selectRaw('DATE(created_at) as date, COUNT(*) as views')
        ->where('created_at', '>=', now()->subDays(30))
        ->groupBy('date')
        ->orderBy('date')
        ->get();
    }
}
