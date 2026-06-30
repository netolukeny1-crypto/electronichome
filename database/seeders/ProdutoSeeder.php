<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produto;

class ProdutoSeeder extends Seeder
{
    public function run(): void
    {
        Produto::insert([

            // =========================
            // 🧊 FRIO (GELEIRAS / CONGELADORES)
            // =========================
            [
                'nome' => 'Geleira Samsung 350L',
                'categoria' => 'Frio',
                'preco' => 450000,
                'stock' => 20,
                'descricao' => 'Geleira moderna com tecnologia inverter e baixo consumo',
                'imagem' => null,
            ],
            [
                'nome' => 'Geleira LG Duplex Inverter',
                'categoria' => 'Frio',
                'preco' => 520000,
                'stock' => 20,
                'descricao' => 'Geleira duplex com sistema de refrigeração avançado',
                'imagem' => null,
            ],
            [
                'nome' => 'Congelador Horizontal 200L',
                'categoria' => 'Frio',
                'preco' => 280000,
                'stock' => 20,
                'descricao' => 'Congelador ideal para armazenamento de alimentos',
                'imagem' => null,
            ],
            [
                'nome' => 'Arca Congeladora Industrial 500L',
                'categoria' => 'Frio',
                'preco' => 750000,
                'stock' => 20,
                'descricao' => 'Alta capacidade para uso comercial',
                'imagem' => null,
            ],

            // =========================
            // 📺 TELEVISORES
            // =========================
            [
                'nome' => 'TV Samsung 55 4K Smart',
                'categoria' => 'TV',
                'preco' => 600000,
                'stock' => 20,
                'descricao' => 'Televisor smart com resolução 4K',
                'imagem' => null,
            ],
            [
                'nome' => 'TV LG OLED 65',
                'categoria' => 'TV',
                'preco' => 950000,
                'stock' => 20,
                'descricao' => 'Qualidade de imagem OLED premium',
                'imagem' => null,
            ],

            // =========================
            // 🧺 LAVANDARIA
            // =========================
            [
                'nome' => 'Máquina de Lavar LG 10kg',
                'categoria' => 'Lavandaria',
                'preco' => 420000,
                'stock' => 20,
                'descricao' => 'Lavagem eficiente com baixo consumo de água',
                'imagem' => null,
            ],
            [
                'nome' => 'Máquina de Lavar Samsung EcoBubble',
                'categoria' => 'Lavandaria',
                'preco' => 480000,
                'stock' => 20,
                'descricao' => 'Tecnologia EcoBubble para lavagem profunda',
                'imagem' => null,
            ],
            [
                'nome' => 'Secadora Bosch 8kg',
                'categoria' => 'Lavandaria',
                'preco' => 390000,
                'stock' => 20,
                'descricao' => 'Secagem rápida e eficiente',
                'imagem' => null,
            ],

            // =========================
            // 🍳 COZINHA
            // =========================
            [
                'nome' => 'Fogão Continental 4 Bocas',
                'categoria' => 'Cozinha',
                'preco' => 180000,
                'stock' => 20,
                'descricao' => 'Fogão resistente e moderno',
                'imagem' => null,
            ],
            [
                'nome' => 'Micro-ondas Panasonic 25L',
                'categoria' => 'Cozinha',
                'preco' => 120000,
                'stock' => 20,
                'descricao' => 'Micro-ondas multifunções',
                'imagem' => null,
            ],

            // =========================
            // 🧹 LIMPEZA
            // =========================
            [
                'nome' => 'Aspirador Dyson V8',
                'categoria' => 'Limpeza',
                'preco' => 250000,
                'stock' => 20,
                'descricao' => 'Aspirador sem fio potente',
                'imagem' => null,
            ],

            // =========================
            // ❄️ CLIMATIZAÇÃO
            // =========================
            [
                'nome' => 'Ar Condicionado LG 12000 BTU',
                'categoria' => 'Climatização',
                'preco' => 380000,
                'stock' => 20,
                'descricao' => 'Climatização eficiente para ambientes médios',
                'imagem' => null,
            ],
            [
                'nome' => 'Purificador de Ar Xiaomi',
                'categoria' => 'Climatização',
                'preco' => 150000,
                'stock' => 20,
                'descricao' => 'Ar mais limpo e saudável',
                'imagem' => null,
            ],

        ]);
    }
}