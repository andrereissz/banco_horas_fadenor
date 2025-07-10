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
            $table->date('data_nasc')->nullable()->change();
            $table->string('nome_mae', 120)->nullable()->change();
            $table->string('cpf', 11)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bolsistas', function (Blueprint $table) {
            $table->date('data_nasc')->change();
            $table->string('nome_mae', 120)->change();
            $table->string('cpf', 11)->change();
        });
    }
};
