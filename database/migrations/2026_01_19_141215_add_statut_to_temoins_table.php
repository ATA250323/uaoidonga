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
        Schema::table('temoins', function (Blueprint $table) {
            //
        $table->boolean('status')->default(false); // 1 = actif, 0 = inactif
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('temoins', function (Blueprint $table) {
            //
        });
    }
};
