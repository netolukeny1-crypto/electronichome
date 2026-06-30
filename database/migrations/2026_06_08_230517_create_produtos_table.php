<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('produtos', function (Blueprint $table) {

            $table->id();

            $table->string('nome');

            $table->enum('categoria', [
                'Televisores',
                'Geleiras',
                'Arcas',
                'Máquinas de Lavar',
                'Micro-ondas'
            ]);

            $table->decimal('preco', 10, 2);

            $table->integer('stock')->default(0);

            // 🔥 NOVOS CAMPOS IMPORTANTES
            $table->text('descricao')->nullable();
            $table->string('imagem')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};