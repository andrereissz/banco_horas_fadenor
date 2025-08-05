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
            $table->renameIndex('bolsistas_cpf_unique', 'bolsas_cpf_unique_index');
            $table->renameIndex('bolsistas_pis_unique', 'bolsas_pis_unique_index');
            $table->dropIndex(['cpf_unique']);
            $table->dropIndex(['pis_unique']);

            $table->dropColumn([
                'nome',
                'data_nasc',
                'nome_mae',
                'nome_pai',
                'estado_civil',
                'sexo',
                'raca_cor',
                'telefone',
                'email',
                'escolaridade',
                'muni_nasc',
                'uf_nasc',
                'cep',
                'muni_resid',
                'uf_resid',
                'logradouro',
                'numero',
                'complemento',
                'bairro',
                'cpf',
                'pis',
                'rg',
                'rg_orgao',
                'rg_orgao_uf',
                'rg_data_emissao',
                'titulo_eleitor',
                'titulo_zona',
                'titulo_secao',
                'certificado_reservista',
                'banco_nome',
                'banco_cod',
                'agencia',
                'agencia_digito',
                'conta',
                'conta_digito'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bolsas', function (Blueprint $table) {
            $table->string('nome');
            $table->date('data_nasc');
            $table->string('nome_mae');
            $table->string('nome_pai')->nullable();
            $table->integer('estado_civil');
            $table->char('sexo', 1);
            $table->integer('raca_cor');
            $table->string('telefone', 15)->nullable();
            $table->string('email')->unique();
            $table->integer('escolaridade');
            $table->string('muni_nasc', 100)->nullable();
            $table->string('uf_nasc', 2)->nullable();
            $table->string('cep', 9);
            $table->string('muni_resid', 100);
            $table->string('uf_resid', 2);
            $table->string('logradouro', 100);
            $table->string('numero', 10);
            $table->string('complemento', 50)->nullable();
            $table->string('bairro', 50);
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
            $table->string('banco_nome', 50)->nullable();
            $table->string('banco_cod', 5)->nullable();
            $table->string('agencia', 10)->nullable();
            $table->string('agencia_digito', 2)->nullable();
            $table->string('conta', 20)->nullable();
            $table->string('conta_digito', 2)->nullable();
        });
    }
};
