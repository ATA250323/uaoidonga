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
            $table->foreignId('anneescolaire_id')
        ->nullable() // temporairement autoriser NULL
        ->after('categorie_examen_id')
        ->constrained('anneescolaires')
        ->cascadeOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('centre_etablissement_examens', function (Blueprint $table) {
            $table->dropForeign(['anneescolaire_id']);
            $table->dropColumn('anneescolaire_id');
        });
    }
};
