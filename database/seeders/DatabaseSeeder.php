<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use TaskSeeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // $user = User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // $this->call(TaskSeeder::class); // No need to pass userId anymore
    }
}
