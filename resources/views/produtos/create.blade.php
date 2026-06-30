<x-layouts::app :title="'Novo Produto'">

<div class="max-w-6xl mx-auto p-6">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6">

        <h1 class="text-2xl font-bold text-gray-800">
            Novo Produto
        </h1>

        <a href="{{ route('produtos.index') }}"
           class="text-sm text-gray-600 hover:text-black">
            ← Voltar
        </a>

    </div>

    <!-- FORM -->
    <form method="POST"
          action="{{ route('produtos.store') }}"
          enctype="multipart/form-data"
          class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        @csrf

        <!-- ESQUERDA -->
        <div class="lg:col-span-2 bg-white p-6 rounded-xl border shadow-sm">

            <h2 class="font-semibold mb-4 text-gray-700">
                Informações do Produto
            </h2>

            <!-- Nome -->
            <label class="text-sm text-gray-600">Nome do Produto</label>
            <input type="text"
                   name="nome"
                   required
                   class="w-full border rounded-lg p-2 mb-4 focus:ring-2 focus:ring-green-500">

            <!-- Categoria -->
            <label class="text-sm text-gray-600">Categoria</label>
            <select name="categoria"
                    class="w-full border rounded-lg p-2 mb-4 focus:ring-2 focus:ring-green-500"
                    required>
                <option>Televisores</option>
                <option>Geleiras</option>
                <option>Arcas</option>
                <option>Máquinas de Lavar</option>
                <option>Micro-ondas</option>
            </select>

            <!-- PREÇO + STOCK -->
            <div class="grid grid-cols-2 gap-4">

                <div>
                    <label class="text-sm text-gray-600">Preço (Kz)</label>
                    <input type="number"
                           name="preco"
                           step="0.01"
                           required
                           class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-green-500">
                </div>

                <div>
                    <label class="text-sm text-gray-600">Stock</label>
                    <input type="number"
                           name="stock"
                           required
                           class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-green-500">
                </div>

            </div>

            <!-- DESCRIÇÃO -->
            <label class="text-sm text-gray-600 mt-4 block">Descrição</label>
            <textarea name="descricao"
                      rows="4"
                      class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-green-500"></textarea>

        </div>

        <!-- DIREITA -->
        <div class="bg-white p-6 rounded-xl border shadow-sm">

            <h2 class="font-semibold mb-4 text-gray-700">
                Imagem do Produto
            </h2>

            <!-- PREVIEW -->
            <img id="preview"
                 src="https://via.placeholder.com/300x200"
                 class="w-full h-48 object-cover rounded-lg border mb-4">

            <!-- INPUT -->
            <input type="file"
                   name="imagem"
                   accept="image/*"
                   onchange="previewImage(event)"
                   class="w-full mb-4 text-sm">

            <!-- BOTÃO SUBMIT -->
            <button type="submit"
                    class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-lg shadow font-semibold transition">
                 Guardar Produto
            </button>

        </div>

    </form>

</div>

<script>
function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function () {
        document.getElementById('preview').src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
}
</script>

</x-layouts::app>