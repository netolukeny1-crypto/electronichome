<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('dividas', function (Blueprint $table) {

        $table->id();

        $table->foreignId('venda_id');

        $table->decimal('valor_total', 10, 2);

        $table->decimal('valor_pago', 10, 2)
              ->default(0);

        $table->decimal('saldo', 10, 2);

        $table->enum('estado', [
            'Pendente',
            'Parcial',
            'Liquidada'
        ])->default('Pendente');

        $table->timestamps();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('dividas');
    }
};