<?php

namespace App\Policies;

use App\Models\Culture;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CulturePolicy
{

    public function before(User $user, $ability){
        if($user->role == 'master'){
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
    public function view(User $user, Culture $culture): bool
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
    public function update(User $user, Culture $culture): bool
    {
        return $user->id === $culture->user->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Culture $culture): bool
    {
        return $user->id === $culture->user->id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Culture $culture): bool
    {
        return $user->role == 'master';
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Culture $culture): bool
    {
        return $user->role == 'master';
    }
}
