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
        Schema::table('pagamentos', function (Blueprint $table) {

            if (!Schema::hasColumn('pagamentos', 'numero_recibo')) {
                $table->string('numero_recibo')->nullable();
            }

            if (!Schema::hasColumn('pagamentos', 'metodo_pagamento')) {
                $table->string('metodo_pagamento')
                      ->default('Numerário');
            }

            if (!Schema::hasColumn('pagamentos', 'observacao')) {
                $table->text('observacao')
                      ->nullable();
            }

            if (!Schema::hasColumn('pagamentos', 'user_id')) {
                $table->unsignedBigInteger('user_id')
                      ->nullable();
            }

        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pagamentos', function (Blueprint $table) {

            if (Schema::hasColumn('pagamentos', 'numero_recibo')) {
                $table->dropColumn('numero_recibo');
            }

            if (Schema::hasColumn('pagamentos', 'metodo_pagamento')) {
                $table->dropColumn('metodo_pagamento');
            }

            if (Schema::hasColumn('pagamentos', 'observacao')) {
                $table->dropColumn('observacao');
            }

            if (Schema::hasColumn('pagamentos', 'user_id')) {
                $table->dropColumn('user_id');
            }

        });
    }
};