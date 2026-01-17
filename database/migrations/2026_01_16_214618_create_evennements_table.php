<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('evennements', function (Blueprint $table) {
            $table->id();
            $table->uuid('public_id')->unique();
            $table->string('titre')->nullable();
            $table->string('image')->nullable();
            $table->date('annee')->nullable();
            $table->foreignId('organisation_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evennements');
    }
};
