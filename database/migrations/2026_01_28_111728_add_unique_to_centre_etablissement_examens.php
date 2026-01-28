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
        Schema::table('centre_etablissement_examens', function (Blueprint $table) {
            $table->unique(
                ['etablissement_id', 'categorie_examen_id', 'anneescolaire_id'],
                'uniq_etab_cat_annee'
            );
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('centre_etablissement_examens', function (Blueprint $table) {
            //
        });
    }
};
