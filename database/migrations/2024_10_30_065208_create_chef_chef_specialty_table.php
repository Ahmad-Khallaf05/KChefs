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
        Schema::create('chef_chef_specialty', function (Blueprint $table) {
            $table->id(); // Optional, or you can define as you prefer
            $table->foreignId('chef_id')->constrained('chefs', 'chef_id')->onDelete('cascade'); // Use custom key
            $table->foreignId('chef_specialty_id')->constrained('chef_specialties')->onDelete('cascade'); // Default id
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chef_chef_specialty');
    }
};
