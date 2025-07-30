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
            $table->dropColumn('sexo');
            $table->char('sexo', 1)->after('nome')->nullable();
            $table->string('projeto_cod', 5)->after('status');
            $table->string('projeto_nome', 255)->after('projeto_cod');
            $table->string('projeto_num', 20)->after('projeto_nome');
            $table->date('data_inicio')->after('conta');
            $table->date('data_fim')->after('data_inicio');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bolsas', function (Blueprint $table) {
            $table->dropColumn('sexo');
            $table->string('sexo', 1)->after('updated_at')->nullable();
            $table->dropColumn('projeto_cod');
            $table->dropColumn('projeto_nome');
            $table->dropColumn('projeto_num');
            $table->dropColumn('data_inicio');
            $table->dropColumn('data_fim');
        });
    }
};
