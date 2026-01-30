<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('resultats_dynamiques', function (Blueprint $table) {
            $table->id();

            // Colonne fixe
            $table->string('matricule')->unique();
            // Colonnes fixes minimales (optionnel mais conseillé)
            $table->string('nom',60)->nullable();
            $table->string('prenom',100)->nullable();
            $table->string('sexe',15)->nullable();
            $table->string('annee',20); // ex: 2024-2025
            $table->string('centres',50)->nullable();
            $table->string('etablissements',50)->nullable();
            $table->string('examens',50)->nullable();

            // ⚠️ Les matières seront ajoutées dynamiquement plus tard
            $table->timestamps();

            $table->unique(
                ['annee','examens','centres','sexe'],
                'uni_session_examen'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('resultats_dynamiques');
    }
};
