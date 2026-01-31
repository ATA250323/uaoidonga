<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('resultats_dynamiques', function (Blueprint $table) {

            // ❌ Supprimer l'ancienne contrainte UNIQUE
            $table->dropUnique('resultats_dynamiques_matricule_unique');

            // ✅ Nouvelle contrainte UNIQUE corrigée
            $table->unique(
                ['annee','examens','centres','sexe','matricule'],
                'resultats_dynamiques_matricule_unique'
            );
        });
    }

    public function down()
    {
        Schema::table('resultats_dynamiques', function (Blueprint $table) {

            $table->dropUnique('resultats_dynamiques_matricule_unique');

            $table->unique(
                ['annee','examens','centres','sexe'],
                'resultats_dynamiques_matricule_unique'
            );
        });
    }
};
