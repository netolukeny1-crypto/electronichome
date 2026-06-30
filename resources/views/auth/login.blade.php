<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login | ElectronicHome</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-gradient-to-br from-slate-100 via-slate-200 to-slate-300 flex items-center justify-center">

    <!-- CONTAINER CENTRAL -->
    <div class="w-full max-w-md px-5">

        <!-- CARD -->
        <div class="bg-white rounded-3xl shadow-2xl border border-slate-200 p-8">

            <h1 class="text-center text-3xl font-bold text-slate-800">
                ElectronicHome
            </h1>

            <p class="text-center text-slate-500 text-sm mt-2 mb-6">
                Faça login para continuar
            </p>

            @if ($errors->any())
                <div class="bg-red-100 border border-red-300 text-red-700 p-3 rounded-xl mb-5 text-sm">
                    Email ou palavra-passe inválidos.
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- EMAIL -->
                <div class="mb-5">

                    <label class="block mb-2 text-sm font-medium text-slate-700">
                        Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="Digite o seu email"
                        required
                        autofocus
                        class="w-full border border-slate-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition">

                </div>

                <!-- PASSWORD -->
                <div class="mb-5">

                    <label class="block text-sm font-medium text-slate-700 mb-2">
                        Palavra-passe
                    </label>

                    <div class="relative">

                        <input
                            id="password"
                            type="password"
                            name="password"
                            placeholder="••••••••"
                            required
                            class="w-full border border-slate-300 rounded-xl px-4 py-3 pr-12 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">

                        <button
                            type="button"
                            onclick="togglePassword()"
                            class="absolute inset-y-0 right-0 px-4 flex items-center text-slate-500 hover:text-emerald-600">

                            <!-- Olho aberto -->
                            <svg id="eyeOpen"
                                 xmlns="http://www.w3.org/2000/svg"
                                 class="h-5 w-5"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0zm6 0s-3-6-9-6-9 6-9 6 3 6 9 6 9-6 9-6z"/>

                            </svg>

                            <!-- Olho fechado -->
                            <svg id="eyeClose"
                                 xmlns="http://www.w3.org/2000/svg"
                                 class="h-5 w-5 hidden"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M13.875 18.825A10.05 10.05 0 0112 19c-6 0-9-7-9-7a17.5 17.5 0 013.355-4.443M6.228 6.228A9.97 9.97 0 0112 5c6 0 9 7 9 7a17.46 17.46 0 01-4.293 5.293M15 12a3 3 0 00-3-3m0 6a3 3 0 01-3-3m-5-8l16 16"/>

                            </svg>

                        </button>

                    </div>

                </div>

                <!-- LEMBRAR-ME -->
                <div class="flex justify-between items-center mb-6 text-sm">

                    <label class="flex items-center gap-2">

                        <input
                            type="checkbox"
                            name="remember"
                            class="rounded text-emerald-600">

                        <span class="text-slate-600">
                            Lembrar-me
                        </span>

                    </label>

                    @if(Route::has('password.request'))

                        <a href="{{ route('password.request') }}"
                           class="text-emerald-600 hover:underline">

                            Esqueceu a senha?

                        </a>

                    @endif

                </div>

                <!-- BOTÃO -->
                <button
                    type="submit"
                    class="w-full bg-emerald-600 hover:bg-emerald-700 text-white py-3 rounded-xl font-semibold shadow-lg transition">

                    Entrar no Sistema

                </button>

            </form>

        </div>

        <!-- RODAPÉ -->
        <div class="text-center mt-5 text-sm text-slate-500">

            © {{ date('Y') }} ElectronicHome

            <br>

            Todos os direitos reservados.

        </div>

    </div>

<script>

function togglePassword(){

    const password=document.getElementById('password');

    const eyeOpen=document.getElementById('eyeOpen');

    const eyeClose=document.getElementById('eyeClose');

    if(password.type==="password"){

        password.type="text";

        eyeOpen.classList.add("hidden");

        eyeClose.classList.remove("hidden");

    }else{

        password.type="password";

        eyeOpen.classList.remove("hidden");

        eyeClose.classList.add("hidden");

    }

}

</script>

</body>

</html>