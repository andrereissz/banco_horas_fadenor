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
            $table->string('token', 64)->unique()->change();
            $table->date('token_expires_at')->after('token')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bolsas', function (Blueprint $table) {
            $table->dropIndex('bolsas_token_unique');
            $table->string('token')->unique()->change();
            $table->dropColumn('token_expires_at');
        });
    }
};
