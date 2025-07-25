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
            $table->string('banco_nome', 100)->after('certificado_reservista')->nullable();
            $table->string('banco_cod', 3)->after('banco_nome')->nullable();
            $table->string('agencia_digito', 2)->after('agencia')->nullable();
            $table->string('conta_digito', 2)->after('conta')->nullable();
            $table->integer('valor')->after('conta');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bolsas', function (Blueprint $table) {
            $table->dropColumn('banco_nome');
            $table->dropColumn('banco_cod');
            $table->dropColumn('agencia_digito');
            $table->dropColumn('conta_digito');
            $table->dropColumn('valor');
        });
    }
};
