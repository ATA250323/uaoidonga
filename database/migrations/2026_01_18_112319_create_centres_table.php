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
        Schema::create('centres', function (Blueprint $table) {
            $table->id();
            $table->uuid('public_id')->unique();
            $table->text('nomar')->nullable();
            $table->text('nomfr')->nullable();
            $table->text('prefixe')->nullable();
            $table->text('adresse')->nullable();
            $table->text('email')->nullable();
            $table->text('telephone')->nullable();
            $table->foreignId('anneescolaire_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('centres');
    }
};
