<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <title>Login - ElectronicHome</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-900 flex items-center justify-center min-h-screen">

<div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8">

    <!-- LOGO -->
    <div class="text-center mb-6">
        <h1 class="text-2xl font-bold text-slate-800">
            ElectronicHome
        </h1>
        <p class="text-sm text-slate-500">
            Sistema de Gestão Comercial
        </p>
    </div>

    <!-- FORM -->
    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <!-- EMAIL -->
        <div>
            <label class="text-sm text-slate-600">Email</label>
            <input type="email"
                   name="email"
                   required
                   class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-emerald-500">
        </div>

        <!-- PASSWORD -->
        <div>
            <label class="text-sm text-slate-600">Password</label>
            <input type="password"
                   name="password"
                   required
                   class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-emerald-500">
        </div>

        <!-- BOTÃO -->
        <button type="submit"
                class="w-full bg-emerald-600 hover:bg-emerald-700 text-white py-3 rounded-lg font-semibold">
            Entrar
        </button>

    </form>

</div>

</body>
</html>