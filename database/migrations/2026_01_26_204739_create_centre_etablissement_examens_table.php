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
        Schema::create('centre_etablissement_examens', function (Blueprint $table) {
            $table->id();
            $table->uuid('public_id')->unique();
            $table->foreignId('centre_id')->constrained()->cascadeOnDelete();
            $table->foreignId('etablissement_id')->constrained()->cascadeOnDelete();
            $table->foreignId('categorie_examen_id')->constrained('categories_examens')->cascadeOnDelete();
            $table->foreignId('anneescolaire_id')->constrained('anneescolaires')->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['etablissement_id', 'categorie_examen_id', 'anneescolaire_id'],'uniq_etab_cat_annee');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('centre_etablissement_examens');
    }
};
