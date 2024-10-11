<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DishCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('dish_categories')->insert([
            [
                'category_name' => 'Appetizers',
                'category_description' => 'Small dishes served before the main course.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Main Course',
                'category_description' => 'The primary dish served in a meal.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Desserts',
                'category_description' => 'Sweet dishes served at the end of a meal.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Salads',
                'category_description' => 'Dishes consisting primarily of mixed vegetables, fruits, or grains.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Beverages',
                'category_description' => 'Drinks served alongside meals.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
