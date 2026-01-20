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
        Schema::create('inscriptions', function (Blueprint $table) {
            $table->id();
            $table->uuid('public_id')->unique();
            $table->uuid('matricule')->unique();
            $table->text('nom')->nullable();
            $table->text('sexe')->nullable();
            $table->text('niveau')->nullable();
            $table->text('image')->nullable();
            $table->foreignId('etablissement_id')->constrained('etablissements')->onDelete('cascade');
            $table->foreignId('anneescolaire_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inscriptions');
    }
};
