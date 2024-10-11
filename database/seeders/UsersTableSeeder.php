<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'username' => 'chef_master',
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'johndoe@example.com',
                'password' => Hash::make('@Jb43f143eff'),
                'role' => 'user',
                'phone' => '123-456-7890',
                'bio' => 'Professional chef with 10 years of experience.',
                'profile_picture' => 'johndoe.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'cook_star',
                'first_name' => 'Jane',
                'last_name' => 'Smith',
                'email' => 'janesmith@example.com',
                'password' => Hash::make('@Jb43f143eff'),
                'role' => 'user',
                'phone' => '987-654-3210',
                'bio' => 'Passionate cook with a flair for Italian cuisine.',
                'profile_picture' => 'janesmith.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'foodie_fan',
                'first_name' => 'Alice',
                'last_name' => 'Johnson',
                'email' => 'alicejohnson@example.com',
                'password' => Hash::make('@Jb43f143eff'),
                'role' => 'user',
                'phone' => '555-123-4567',
                'bio' => 'Food lover and culinary enthusiast.',
                'profile_picture' => 'alicejohnson.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
