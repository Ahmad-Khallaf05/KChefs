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
        Schema::create('dishes', function (Blueprint $table) {
            $table->id('dish_id'); 
            $table->string('dish_title');
            $table->text('dish_description')->nullable();
            $table->decimal('price', 8, 2);
            
            $table->unsignedBigInteger('chef_id');
            $table->foreign('chef_id')->references('chef_id')->on('chefs')->onDelete('cascade');
            
            $table->unsignedBigInteger('dish_category_id');
            $table->foreign('dish_category_id')->references('dish_category_id')->on('dish_categories')->onDelete('cascade');
            
            $table->timestamps();
        });

        Schema::create('dish_images', function (Blueprint $table) {
            $table->id('image_id');
            $table->string('image_path');
    
            $table->unsignedBigInteger('dish_id'); 
            $table->foreign('dish_id')->references('dish_id')->on('dishes')->onDelete('cascade');
    
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
