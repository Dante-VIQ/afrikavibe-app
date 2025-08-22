<?php

namespace App\Models;

use App\Models\User;
use App\Models\Upvote;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'content',
        'user_id',
        'parent_id',
        'upvotes',
        'commentable_id',
        'commentable_type'
    ];
    public function commentable()
    {
        return $this->morphTo();
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function upvotes(): HasMany
    {
        return $this->hasMany(Upvote::class);
    }

    public function getUpvotesCountAttribute(): int
    {
        return $this->upvotes()->count();
    }

    public function hasUserUpvoted(?User $user): bool
    {
        if (!$user) return false;
        return $this->upvotes()->where('user_id', $user->id)->exists();
    }
}
