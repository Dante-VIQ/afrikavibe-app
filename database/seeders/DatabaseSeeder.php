<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Blog;
use App\Models\City;
use App\Models\Todo;
use App\Models\User;
use App\Models\About;
use App\Models\Doctor;
use App\Models\Header;
use App\Models\Culture;
use App\Models\Feature;
use App\Models\Service;
use App\Models\Analysis;
use App\Models\Destination;
use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $user = User::factory()->create();

        Service::factory(4)->create([
            'user_id' => $user->id,
        ]);

        Doctor::factory(4)->create([
            'user_id' => $user->id,
        ]);

        // Testimonial::factory()->create([
        //     'user_id' => $user->id,
        // ]);

        About::factory(1)->create([
            'user_id' => $user->id,
        ]);

        Header::factory(4)->create([
            'user_id' => $user->id,
        ]);

        Feature::factory()->create([
            'user_id' => $user->id,
        ]);

        Blog::factory(4)->create([
            'user_id' => $user->id,
        ]);

        // Destination::factory(4)->create([
        //     'user_id' => $user->id,
        // ]);

        Todo::factory(4)->create([
            'user_id' => $user->id,
        ]);

        City::factory(4)->create([
            'user_id' => $user->id,
        ]);

        Culture::factory(4)->create([
            'user_id' => $user->id,
        ]);

        Todo::factory(4)->create([
            'user_id' => $user->id,
        ]);
        
        Analysis::factory(4)->create([
            'user_id' => $user->id,
        ]);
    }
}
