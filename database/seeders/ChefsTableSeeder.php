<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ChefsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('chefs')->insert([
            [
                'username' => 'master_chef',
                'first_name' => 'Gordon',
                'last_name' => 'Ramsay',
                'email' => 'gordonramsay@example.com',
                'password' => Hash::make('@Jb43f143eff'),
                'phone' => '123-456-7890',
                'bio' => 'World-renowned chef with Michelin stars.',
                'chef_specialties' => 'British cuisine, Fine dining',
                'profile_picture' => 'gordon.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'pastry_queen',
                'first_name' => 'Mary',
                'last_name' => 'Berry',
                'email' => 'maryberry@example.com',
                'password' => Hash::make('@Jb43f143eff'),
                'phone' => '987-654-3210',
                'bio' => 'Baking expert known for her desserts.',
                'chef_specialties' => 'Baking, Pastry, Cakes',
                'profile_picture' => 'mary.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'fusion_king',
                'first_name' => 'David',
                'last_name' => 'Chang',
                'email' => 'davidchang@example.com',
                'password' => Hash::make('@Jb43f143eff'),
                'phone' => '555-123-4567',
                'bio' => 'Master of Asian fusion cuisine.',
                'chef_specialties' => 'Asian Fusion, Ramen, Street Food',
                'profile_picture' => 'david.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
