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
        Schema::table('bolsas', function (Blueprint $table) {
            $table->uuid('bolsista_id')->nullable()->after('id');
            $table->foreign('bolsista_id')->references('id')->on('bolsistas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bolsas', function (Blueprint $table) {
            $table->dropForeign(['bolsista_id']);
            $table->dropColumn('bolsista_id');
        });
    }
};
