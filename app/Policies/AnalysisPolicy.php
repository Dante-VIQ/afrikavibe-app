<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Analysis;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class AnalysisPolicy
{
    use HandlesAuthorization;
    public function before(User $user, $abiity)
    {
        if ($user->role == 'master') {
            return true;
        }
    }
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Analysis $analysis): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role == 'master';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Analysis $analysis): bool
    {
        return $user->role == 'master';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Analysis $analysis): bool
    {
        return $user->role == 'master';
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Analysis $analysis): bool
    {
        return $user->role == 'master';
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Analysis $analysis): bool
    {
        return $user->role == 'master';
    }
}
