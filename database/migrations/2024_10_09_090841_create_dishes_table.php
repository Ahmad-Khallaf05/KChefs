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
            $table->id('dishe_id');
            $table->string('dishe_title');
            $table->text('dishe_description')->nullable();
            $table->decimal('price', 8, 2);
            $table->string('image')->nullable();
            $table->unsignedBigInteger('chef_id');
            $table->foreign('chef_id')->references('chef_id')->on('chefs')->onDelete('cascade');
        
            // Foreign key linking to dish_categories
            $table->unsignedBigInteger('dish_category_id');
            $table->foreign('dish_category_id')->references('dish_category_id')->on('dish_categories')->onDelete('cascade');
        
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dishes');
    }
};
