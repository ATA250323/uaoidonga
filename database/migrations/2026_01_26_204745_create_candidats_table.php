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
        Schema::create('candidats', function (Blueprint $table) {
            $table->id();
            $table->uuid('public_id')->unique();
            $table->string('nom', 255);
            $table->string('prenom', 255);
            $table->string('sexe',10)->nullable();
            $table->date('date_naissance')->nullable();

            $table->string('numero_table', 20)->nullable();

            $table->foreignId('centre_id')->constrained()->cascadeOnDelete();
            $table->foreignId('etablissement_id')->constrained()->cascadeOnDelete();
            $table->foreignId('anneescolaire_id')->constrained()->onDelete('cascade');
            $table->foreignId('categorie_examen_id')->constrained('categories_examens')->cascadeOnDelete();

            $table->timestamps();

            $table->unique(['numero_table', 'anneescolaire_id', 'categorie_examen_id'], 'candidat_unique'); // numéro unique par examen + année

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidats');
    }
};
