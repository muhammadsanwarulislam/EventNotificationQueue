<?php

namespace Database\Seeders;

use App\Models\User;
use App\Events\UserCreated;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => bcrypt('password'),
        ]);

        // Dispatch the event after creating the user.
        event(new UserCreated($user));
    }
}
