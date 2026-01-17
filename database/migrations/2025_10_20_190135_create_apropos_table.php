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
        Schema::create('apropos', function (Blueprint $table) {
            $table->id();
            $table->uuid('public_id')->unique();
            $table->text('aproposar')->nullable();
            $table->text('aproposfr')->nullable();
            $table->text('missionar')->nullable();
            $table->text('missionfr')->nullable();
            $table->text('objectifar')->nullable();
            $table->text('objectiffr')->nullable();
            $table->text('visionar')->nullable();
            $table->text('visionfr')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apropos');
    }
};
