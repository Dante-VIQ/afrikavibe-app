<?php

namespace App\Models;

use App\Models\Blog;
use App\Models\City;
use App\Models\Role;
use App\Models\Todo;
use App\Models\About;
use App\Models\Doctor;
use App\Models\Header;
use App\Models\Upvote;
use App\Models\Comment;
use App\Models\Culture;
use App\Models\Feature;
use App\Models\Service;
use App\Models\Analysis;
use App\Models\Destination;
use App\Models\Testimonial;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Log;
use Laravel\Jetstream\HasProfilePhoto;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens;

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    const ROLE_MASTER = 'master';
    const ROLE_ADMIN = 'admin';
    //  const ROLE_EDITOR = 'editor';
    const ROLE_USER = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'email', 'password', 'role_id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = ['password', 'remember_token', 'two_factor_recovery_codes', 'two_factor_secret'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = ['profile_photo_url'];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function upvotes(): HasMany
    {
        return $this->hasMany(Upvote::class);
    }
    // Relationship With services
    public function services()
    {
        return $this->hasMany(Service::class, 'user_id');
    }

    // Relationship With destinations
    public function doctors()
    {
        return $this->hasMany(Doctor::class, 'user_id');
    }

    // Relationship With testimonial
    public function testimonials()
    {
        return $this->hasMany(Testimonial::class, 'user_id');
    }

    // Relationship With About
    public function abouts()
    {
        return $this->hasMany(About::class, 'user_id');
    }

    // Relationship With Headers
    public function headers()
    {
        return $this->hasMany(Header::class, 'user_id');
    }

    // Relationship With feature
    public function features()
    {
        return $this->hasMany(Feature::class, 'user_id');
    }

    // Relationship With Blog
    public function blogs()
    {
        return $this->hasMany(Blog::class, 'user_id');
    }

    // Relationship With Destination
    public function destinations()
    {
        return $this->hasMany(Destination::class, 'user_id');
    }

    public function cities()
    {
        return $this->hasMany(City::class, 'user_id');
    }

    public function todos()
    {
        return $this->hasMany(Todo::class, 'user_id');
    }

    public function analysis()
    {
        return $this->hasMany(Analysis::class, 'user_id');
    }

    public function cultures()
    {
        return $this->hasMany(Culture::class, 'user_id');
    }
// FIXED: Accessor for role attribute
    public function getRoleAttribute()
    {
        // Use the relationship method, not the attribute
        if ($this->roleRelation) {
            return $this->roleRelation->slug;
        }

        // Fallback to direct attribute if relationship isn't loaded
        return $this->attributes['role'] ?? null;
    }

    // Helper methods - FIXED to avoid circular references
    public function isAdmin(): bool
    {
        return $this->getRoleAttribute() === self::ROLE_ADMIN;
    }

    public function isMaster(): bool
    {
        return $this->getRoleAttribute() === self::ROLE_MASTER;
    }

    public function isUser(): bool
    {
        return $this->getRoleAttribute() === self::ROLE_USER;
    }

    // Remove the problematic safeIsMaster() method or fix it:
    public function safeIsMaster()
    {
        try {
            return $this->getRoleAttribute() === self::ROLE_MASTER;
        } catch (\Exception $e) {
            \Log::warning('Error checking master role: ' . $e->getMessage());
            return false;
        }
    }

    // Keep this relationship method but rename it to avoid conflict
    public function roleRelation()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }


}
