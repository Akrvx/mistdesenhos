<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Duckly Admin | Acesso Restrito</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 h-screen flex items-center justify-center">

    <div class="w-full max-w-md bg-gray-800 p-8 rounded-2xl shadow-2xl border border-gray-700">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-white tracking-tighter">
                Duck<span class="text-cyan-500">ly</span> <span class="text-gray-500 text-lg">Admin</span>
            </h1>
            <p class="text-gray-400 text-sm mt-2">Área de Gerenciamento do Sistema</p>
        </div>

        <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label class="block text-gray-300 text-sm font-bold mb-2">E-mail Administrativo</label>
                <input type="email" name="email" required 
                    class="w-full bg-gray-900 text-white border border-gray-600 rounded-lg p-3 focus:outline-none focus:border-cyan-500 transition">
            </div>

            <div>
                <label class="block text-gray-300 text-sm font-bold mb-2">Senha</label>
                <input type="password" name="password" required 
                    class="w-full bg-gray-900 text-white border border-gray-600 rounded-lg p-3 focus:outline-none focus:border-cyan-500 transition">
            </div>

            @if ($errors->any())
                <div class="bg-red-500/10 border border-red-500/50 text-red-400 p-3 rounded-lg text-sm text-center">
                    {{ $errors->first() }}
                </div>
            @endif

            <button type="submit" class="w-full bg-cyan-600 hover:bg-cyan-500 text-white font-bold py-3 rounded-lg transition shadow-lg">
                Acessar Painel
            </button>
        </form>

        <div class="mt-6 text-center">
            <a href="{{ route('welcome') }}" class="text-gray-500 hover:text-white text-xs transition">Voltar ao site</a>
        </div>
    </div>

</body>
</html>