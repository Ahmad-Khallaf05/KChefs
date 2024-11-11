<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Create the dishes table
        Schema::create('dishes', function (Blueprint $table) {
            $table->id('dish_id'); 
            $table->string('dish_title');
            $table->text('dish_description')->nullable();
            $table->decimal('price', 8, 2);
            
            $table->foreignId('chef_id')->constrained('chefs', 'chef_id')->onDelete('cascade');  // Use foreignId helper
            $table->foreignId('dish_category_id')->constrained('dish_categories', 'dish_category_id')->onDelete('cascade'); // Use foreignId helper
            
            $table->timestamps();
        });

        // Create the dish_images table
        Schema::create('dish_images', function (Blueprint $table) {
            $table->id('image_id');
            $table->string('image_path');
    
            $table->foreignId('dish_id')->constrained('dishes', 'dish_id')->onDelete('cascade'); // Use foreignId helper
    
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dish_images');
        Schema::dropIfExists('dishes');
    }
};
