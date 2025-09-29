<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin user
        DB::table('users')->insert([
            'name' => 'Owner User',
            'email' => 'owner@gmail.com',
            'password' => Hash::make('pass12345'), // hashed password
            'role' => 'owner',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

      
    }
}
