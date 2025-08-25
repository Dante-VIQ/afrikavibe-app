<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

         public function run()
    {
        $roles = [
            ['name' => 'Master', 'slug' => 'master', 'description' => 'Super administrator'],
            ['name' => 'Admin', 'slug' => 'admin', 'description' => 'Administrator'],
            ['name' => 'User', 'slug' => 'user', 'description' => 'Regular user'],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }

}
