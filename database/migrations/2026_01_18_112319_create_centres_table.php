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
            $table->text('prefixe');
            $table->text('adresse');
            $table->text('email');
            $table->text('telephone');
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
