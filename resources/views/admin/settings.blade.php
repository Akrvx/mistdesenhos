<!DOCTYPE html>
<html lang="pt-BR" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Duckly Staff | Configurações</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .glass-panel { background: rgba(30, 41, 59, 0.7); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.1); }
    </style>
</head>
<body class="bg-slate-950 text-slate-50 antialiased overflow-hidden">

    <div class="flex h-screen w-full">
        
        <aside class="w-64 bg-slate-900 border-r border-slate-800 flex flex-col shrink-0">
    <div class="h-20 flex items-center px-8 border-b border-slate-800 bg-slate-900/50">
        <h1 class="text-2xl font-bold tracking-tighter">Duck<span class="text-cyan-400">ly</span> <span class="text-xs bg-cyan-500/20 text-cyan-400 px-2 py-0.5 rounded ml-2 border border-cyan-500/30">STAFF</span></h1>
    </div>
    
    <nav class="p-4 space-y-2">
        <p class="px-4 text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Geral</p>
        
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 {{ Route::is('admin.dashboard') ? 'bg-cyan-500/10 text-cyan-400 border border-cyan-500/20 font-semibold' : 'text-slate-400 hover:text-white hover:bg-white/5' }} rounded-xl transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
            Dashboard
        </a>
        
        <a href="{{ route('admin.users') }}" class="flex items-center gap-3 px-4 py-3 {{ Route::is('admin.users') ? 'bg-cyan-500/10 text-cyan-400 border border-cyan-500/20 font-semibold' : 'text-slate-400 hover:text-white hover:bg-white/5' }} rounded-xl transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            Usuários
        </a>

        <a href="{{ route('admin.arts') }}" class="flex items-center gap-3 px-4 py-3 {{ Route::is('admin.arts') ? 'bg-cyan-500/10 text-cyan-400 border border-cyan-500/20 font-semibold' : 'text-slate-400 hover:text-white hover:bg-white/5' }} rounded-xl transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            Artes & Moderação
        </a>

        <p class="px-4 text-xs font-bold text-slate-500 uppercase tracking-wider mb-2 mt-6">Financeiro</p>

        <a href="#" class="flex items-center gap-3 px-4 py-3 text-slate-400 hover:text-white hover:bg-white/5 rounded-xl transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            Transações
        </a>

         <a href="{{ route('admin.settings') }}" class="flex items-center gap-3 px-4 py-3 {{ Route::is('admin.settings') ? 'bg-cyan-500/10 text-cyan-400 border border-cyan-500/20 font-semibold' : 'text-slate-400 hover:text-white hover:bg-white/5' }} rounded-xl transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
            Configurações
        </a>
    </nav>

    <div class="p-4 border-t border-slate-800 mt-auto">
        <form action="{{ route('admin.logout') }}" method="POST">
            @csrf
            <button class="flex items-center gap-2 text-red-400 hover:text-red-300 transition text-sm font-semibold w-full px-4 py-2 hover:bg-red-500/10 rounded-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                Sair do Sistema
            </button>
        </form>
    </div>

    <p class="px-4 text-xs font-bold text-slate-500 uppercase tracking-wider mb-2 mt-6">Sistema</p>

   
</aside>

        <main class="flex-1 overflow-y-auto bg-slate-950 relative p-8 md:p-12">
            
            <div class="flex justify-between items-end mb-10">
                <div>
                    <h2 class="text-3xl font-bold text-white mb-1">Configurações do Sistema</h2>
                    <p class="text-slate-400">Controle as regras globais do marketplace.</p>
                </div>
            </div>

            @if(session('success'))
                <div class="mb-6 bg-green-500/10 border border-green-500/20 text-green-400 px-4 py-3 rounded-xl animate-bounce">
                    ✅ {{ session('success') }}
                </div>
            @endif

            <div class="max-w-2xl">
                <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    @foreach($settings as $setting)
                        <div class="glass-panel p-6 rounded-2xl">
                            <label class="block text-slate-400 text-sm font-bold uppercase tracking-wider mb-2">
                                {{ $setting->description }}
                            </label>
                            
                            @if($setting->key == 'maintenance_mode')
                                <select name="{{ $setting->key }}" class="w-full bg-slate-900 text-white border border-slate-700 rounded-lg p-3 focus:outline-none focus:border-cyan-500">
                                    <option value="0" {{ $setting->value == '0' ? 'selected' : '' }}>🟢 Site Online</option>
                                    <option value="1" {{ $setting->value == '1' ? 'selected' : '' }}>🔴 Em Manutenção</option>
                                </select>
                            
                            @elseif($setting->key == 'commission_rate')
                                <div class="relative">
                                    <input type="number" name="{{ $setting->key }}" value="{{ $setting->value }}" class="w-full bg-slate-900 text-white border border-slate-700 rounded-lg p-3 focus:outline-none focus:border-cyan-500 font-bold text-lg">
                                    <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                        <span class="text-slate-500 font-bold">%</span>
                                    </div>
                                </div>
                                <p class="text-xs text-slate-500 mt-2">Valor descontado automaticamente de cada venda.</p>
                            
                            @else
                                <input type="text" name="{{ $setting->key }}" value="{{ $setting->value }}" class="w-full bg-slate-900 text-white border border-slate-700 rounded-lg p-3 focus:outline-none focus:border-cyan-500">
                            @endif
                        </div>
                    @endforeach

                    <div class="pt-4">
                        <button type="submit" class="bg-cyan-600 hover:bg-cyan-500 text-white font-bold py-4 px-8 rounded-xl shadow-[0_0_20px_rgba(6,182,212,0.4)] transition transform hover:scale-105 w-full md:w-auto">
                            Salvar Alterações
                        </button>
                    </div>

                </form>
            </div>

        </main>
    </div>

</body>
</html>