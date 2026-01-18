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
        Schema::create('infolignes', function (Blueprint $table) {
            $table->id();
            $table->uuid('public_id')->unique();
            $table->string('nom');
            $table->string('email');
            $table->string('phone');
            $table->string('project');
            $table->string('subjet');
            $table->text('message');
            $table->boolean('lire')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('infolignes');
    }
};
