<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bolsistas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('token');

            // Vínculo com usuário
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->integer('status_solicitacao')->default(0);

            // Dados pessoais
            $table->string('nome', 120);
            $table->date('data_nasc');
            $table->string('nome_mae', 120);
            $table->string('nome_pai', 120)->nullable();
            $table->integer('estado_civil')->nullable();
            $table->integer('raca_cor')->nullable();
            $table->string('telefone', 20)->nullable();
            $table->string('email', 150);
            $table->string('escolaridade', 100)->nullable();

            // Naturalidade
            $table->string('muni_nasc', 100)->nullable();
            $table->char('uf_nasc', 2)->nullable();

            // Endereço
            $table->char('cep', 9)->nullable();
            $table->string('muni_resid', 100)->nullable();
            $table->char('uf_resid', 2)->nullable();
            $table->string('logradouro', 120)->nullable();
            $table->string('numero', 20)->nullable();
            $table->string('complemento', 100)->nullable();
            $table->string('bairro', 100)->nullable();

            // Documentação
            $table->char('cpf', 11)->unique();
            $table->char('pis', 11)->nullable()->unique();
            $table->string('titulo_eleitor', 12)->nullable();
            $table->string('titulo_zona', 5)->nullable();
            $table->string('titulo_secao', 5)->nullable();
            $table->string('rg', 20)->nullable();
            $table->string('rg_orgao', 20)->nullable();
            $table->char('rg_orgao_uf', 2)->nullable();
            $table->date('rg_data_emissao')->nullable();
            $table->string('certificado_reservista', 20)->nullable();

            // Dados bancários
            $table->string('agencia', 10)->nullable();
            $table->string('conta', 20)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bolsistas');
    }
};
