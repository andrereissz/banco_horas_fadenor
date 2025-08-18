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
        Schema::table('bolsistas', function (Blueprint $table) {
            $table->dropColumn('est_muni');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bolsistas', function (Blueprint $table) {
            $table->string('est_muni', 100)->after('est_pais')->nullable();
        });
    }
};
