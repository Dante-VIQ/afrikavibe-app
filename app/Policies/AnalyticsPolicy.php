<?php

namespace App\Policies;

use App\Models\Analytics;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AnalyticsPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return in_array($user->role, [User::ROLE_ADMIN, User::ROLE_MASTER]);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Analytics $analytics): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Analytics $analytics): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Analytics $analytics): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Analytics $analytics): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Analytics $analytics): bool
    {
        return false;
    }
}
