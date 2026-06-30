<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('produtos', function (Blueprint $table) {
            $table->enum('categoria', [
                'Frio',
                'TV',
                'Lavandaria',
                'Cozinha',
                'Limpeza',
                'Climatização'
            ])->change();
        });
    }

    public function down(): void
    {
        Schema::table('produtos', function (Blueprint $table) {
            $table->enum('categoria', [
                'Televisores',
                'Geleiras',
                'Arcas',
                'Máquinas de Lavar'
            ])->change();
        });
    }
};