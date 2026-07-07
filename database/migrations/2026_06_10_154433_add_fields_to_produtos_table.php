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
        Schema::table('produtos', function (Blueprint $table) {

            if (!Schema::hasColumn('produtos', 'descricao')) {
                $table->text('descricao')->nullable();
            }

            if (!Schema::hasColumn('produtos', 'imagem')) {
                $table->string('imagem')->nullable();
            }

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produtos', function (Blueprint $table) {

            if (Schema::hasColumn('produtos', 'descricao')) {
                $table->dropColumn('descricao');
            }

            if (Schema::hasColumn('produtos', 'imagem')) {
                $table->dropColumn('imagem');
            }

        });
    }
};