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
        Schema::create('dirigents', function (Blueprint $table) {
            $table->id();
            $table->uuid('public_id')->unique();
            $table->string('nom')->nullable();
            $table->text('profession')->nullable();
            $table->text('facebook')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('tiweter')->nullable();
            $table->string('email')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dirigents');
    }
};
