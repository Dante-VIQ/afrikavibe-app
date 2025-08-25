<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserActivityLog extends Model
{
    protected $guarded = [];
    protected $casts = ['metadata' => 'array'];

    // Add these relationships and methods
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function content()
    {
        return $this->morphTo('content', 'content_type', 'content_id');
    }

    public static function log($action, $description = null, $metadata = [], $content = null)
    {
        $data = [
            'user_id' => auth()->id(),
            'action' => $action,
            'description' => $description,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'country_code' => app('geoip')->getCountryCode(),
            'metadata' => $metadata
        ];

        if ($content) {
            $data['content_type'] = get_class($content);
            $data['content_id'] = $content->id;
        }

        return self::create($data);
    }

    // Scope for filtering by content type
    public function scopeOfContentType($query, $contentType)
    {
        if ($contentType) {
            $modelClass = "App\\Models\\" . ucfirst($contentType);
            return $query->where('content_type', $modelClass);
        }
        return $query;
    }
}
