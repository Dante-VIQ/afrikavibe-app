<?php

namespace App\Actions\Fortify;

use App\Models\Role;
use App\Models\User;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        // List of master emails
        $masterEmails = [
            'africa@vumbiventures.com',
            'culture@vumbiventures.com',
            'damalide20@gmail.com',
        ];

 // Determine the role slug based on email
        $roleSlug = in_array($input['email'], $masterEmails)
            ? User::ROLE_MASTER
            : User::ROLE_USER;

        // Find the role by slug
        $role = Role::where('slug', $roleSlug)->first();

        if (!$role) {
            // Fallback: create a default user role if not found
            $role = Role::where('slug', User::ROLE_USER)->first();

            // If still not found, you might want to create it or throw an exception
            if (!$role) {
                throw new \Exception("Role '{$roleSlug}' not found in database");
            }
        }

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
           'role_id' => $role->id,
        ]);
    }
}
