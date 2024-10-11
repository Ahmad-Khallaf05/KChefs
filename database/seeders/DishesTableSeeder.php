<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DishesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('dishes')->insert([
            [
                'dishe_title' => 'Grilled Salmon',
                'dishe_description' => 'Fresh salmon fillet grilled to perfection with herbs and lemon.',
                'price' => 25.99,
                'image' => 'grilled_salmon.jpg',
                'chef_id' => 1, // Replace with an existing chef_id from your chefs table
                'dish_category_id' => 1, // Replace with an existing dish_category_id from your dish_categories table
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'dishe_title' => 'Chocolate Mousse',
                'dishe_description' => 'Decadent chocolate mousse topped with whipped cream.',
                'price' => 8.50,
                'image' => 'chocolate_mousse.jpg',
                'chef_id' => 2, // Replace with an existing chef_id
                'dish_category_id' => 3, // Replace with an existing dish_category_id
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'dishe_title' => 'Caesar Salad',
                'dishe_description' => 'Crisp romaine lettuce, croutons, and parmesan cheese with Caesar dressing.',
                'price' => 12.00,
                'image' => 'caesar_salad.jpg',
                'chef_id' => 1, // Replace with an existing chef_id
                'dish_category_id' => 4, // Replace with an existing dish_category_id
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'dishe_title' => 'Spaghetti Carbonara',
                'dishe_description' => 'Classic Italian pasta dish made with eggs, cheese, pancetta, and pepper.',
                'price' => 18.50,
                'image' => 'spaghetti_carbonara.jpg',
                'chef_id' => 3, // Replace with an existing chef_id
                'dish_category_id' => 2, // Replace with an existing dish_category_id
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
