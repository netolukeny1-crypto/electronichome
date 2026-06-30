<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('vendas', function (Blueprint $table) {

            // remover campos antigos do modelo antigo
            if (Schema::hasColumn('vendas', 'produto_id')) {
                $table->dropColumn('produto_id');
            }

            if (Schema::hasColumn('vendas', 'quantidade')) {
                $table->dropColumn('quantidade');
            }
        });
    }

    public function down(): void
    {
        Schema::table('vendas', function (Blueprint $table) {
            $table->foreignId('produto_id')->nullable();
            $table->integer('quantidade')->nullable();
        });
    }
};