<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <title>Login - ElectronicHome</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-100">

<div class="min-h-screen flex">

    <!-- LADO ESQUERDO (BRANDING) -->
    <div class="hidden lg:flex w-1/2 bg-slate-900 text-white items-center justify-center p-10">

        <div class="text-center">

            <h1 class="text-4xl font-bold mb-4">
                ElectronicHome
            </h1>

            <p class="text-slate-300 text-lg">
                A sua loja de eletrónica moderna e inteligente
            </p>

            <div class="mt-8 text-sm text-slate-400">
                Gestão de produtos • vendas • clientes • pagamentos
            </div>

        </div>

    </div>

    <!-- LADO DIREITO (FORMULÁRIO) -->
    <div class="w-full lg:w-1/2 flex items-center justify-center p-6">

        <div class="bg-white w-full max-w-md rounded-2xl shadow-lg p-8">

            <h2 class="text-2xl font-bold text-center mb-6">
                Iniciar Sessão
            </h2>

            <!-- FORM -->
            <form method="POST" action="{{ route('login') }}" class="space-y-4">

                @csrf

                <!-- EMAIL -->
                <div>
                    <label class="text-sm text-gray-600">Email</label>
                    <input type="email"
                           name="email"
                           required
                           class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-emerald-500">
                </div>

                <!-- PASSWORD -->
                <div>
                    <label class="text-sm text-gray-600">Palavra-passe</label>
                    <input type="password"
                           name="password"
                           required
                           class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-emerald-500">
                </div>

                <!-- BOTÃO -->
                <button type="submit"
                        class="w-full bg-emerald-600 hover:bg-emerald-700 text-white py-3 rounded-lg font-semibold transition">
                    Entrar
                </button>

            </form>

            <p class="text-xs text-center text-gray-400 mt-6">
                © {{ date('Y') }} ElectronicHome
            </p>

        </div>

    </div>

</div>

</body>
</html>