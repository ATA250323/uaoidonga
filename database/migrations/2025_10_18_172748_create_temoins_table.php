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
        Schema::create('temoins', function (Blueprint $table) {
            $table->id();
            $table->uuid('public_id')->unique();
            $table->string('image')->nullable();
            $table->text('messagear')->nullable();
            $table->text('messagefr')->nullable();
            $table->string('nom_prenom')->nullable();
            $table->string('nom_organe')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temoins');
    }
};
