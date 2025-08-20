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
            // O nome da foreign key vem da mensagem de erro
            $table->dropForeign('bolsistas_user_id_foreign');
        });

        // 2. Altera o tipo da coluna 'user_id' em 'bolsistas' para UUID
        Schema::table('bolsas', function (Blueprint $table) {
            $table->uuid('user_id')->change();
        });

        // 3. Altera o tipo da coluna 'id' em 'users' para UUID
        Schema::table('users', function (Blueprint $table) {
            $table->uuid('id')->change();
        });

        // 4. Adiciona a foreign key 'user_id' em 'bolsistas'
        Schema::table('bolsas', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bolsas', function (Blueprint $table) {
            $table->dropForeign('bolsistas_user_id_foreign');
        });

        // 2. Altera o tipo da coluna 'user_id' em 'bolsistas' para UUID
        Schema::table('bolsas', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->change();
        });

        // 3. Altera o tipo da coluna 'id' em 'users' para UUID
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->change();
        });

        // 4. Adiciona a foreign key 'user_id' em 'bolsistas'
        Schema::table('bolsas', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
};
