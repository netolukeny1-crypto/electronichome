<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('pagamentos', function (Blueprint $table) {

        $table->string('numero_recibo')->nullable();

        $table->string('metodo_pagamento')
              ->default('Numerário');

        $table->text('observacao')
              ->nullable();

        $table->unsignedBigInteger('user_id')
              ->nullable();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pagamentos', function (Blueprint $table) {
            //
        });
    }
};
