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
        Schema::create('chef_specialties', function (Blueprint $table) {
            $table->id(); // Creates an unsigned big integer id by default
            $table->string('name')->unique(); // Specialty name
            $table->timestamps();
            $table->softDeletes(); // Adds the deleted_at column for soft deletes
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chef_specialties');
    }
};
