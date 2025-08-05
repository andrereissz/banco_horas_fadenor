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
        Schema::create('bolsistas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nome');
            $table->string('nome_mae');
            $table->string('nome_pai')->nullable();
            $table->char('sexo', 1);
            $table->integer('escolaridade');
            $table->integer('estado_civil');
            $table->date('data_nasc');
            $table->boolean('flag_extrangeiro')->default(false);
            $table->string('est_pais', 2)->nullable();
            $table->string('est_muni', 100)->nullable();
            $table->string('muni_nasc', 100)->nullable();
            $table->string('uf_nasc', 2)->nullable();
            $table->integer('raca_cor');
            $table->string('telefone', 15)->nullable();
            $table->string('email')->unique();
            $table->string('cep', 9);
            $table->string('logradouro', 100);
            $table->string('numero', 10);
            $table->string('complemento', 50)->nullable();
            $table->string('bairro', 50);
            $table->string('uf_resid', 2);
            $table->string('muni_resid', 100);
            $table->string('cpf', 11)->unique();
            $table->string('pis', 11)->default('13333333332');
            $table->string('rg', 20)->unique();
            $table->string('rg_orgao', 20);
            $table->string('rg_orgao_uf', 2);
            $table->date('rg_data_emissao');
            $table->string('titulo_eleitor', 12);
            $table->string('titulo_zona', 5);
            $table->string('titulo_secao', 5);
            $table->string('certificado_reservista', 12)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bolsistas');
    }
};
