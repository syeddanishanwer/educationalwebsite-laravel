<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Instructor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
     user::create([ 
        'name' => 'Test User',
        'email' => 'testuser@test.com',
        'password' => Hash::make('password123'), 
    ]);
}
}