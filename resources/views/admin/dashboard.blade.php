<!DOCTYPE html>
<html lang="pt-BR" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Duckly Staff | Centro de Comando</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Inter', sans-serif; }
        .glass-panel {
            background: rgba(30, 41, 59, 0.7);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        /* Barra de rolagem bonita */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #0f172a; }
        ::-webkit-scrollbar-thumb { background: #334155; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #475569; }
    </style>
</head>
<body class="bg-slate-950 text-slate-50 antialiased overflow-hidden">
    @if(session('success'))
    <div class="fixed top-5 right-5 z-50 bg-green-500 text-white px-6 py-3 rounded-xl shadow-2xl border border-green-400 animate-bounce">
        ✅ {{ session('success') }}
    </div>
@endif

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

        <main class="flex-1 overflow-y-auto bg-slate-950 relative">
            <div class="absolute top-0 left-0 w-full h-96 bg-gradient-to-b from-blue-900/20 to-transparent pointer-events-none"></div>

            <div class="p-8 md:p-12 max-w-7xl mx-auto relative z-10">
                
                <div class="flex justify-between items-end mb-10">
                    <div>
                        <h2 class="text-3xl font-bold text-white mb-1">Visão Geral</h2>
                        <p class="text-slate-400">Bem-vindo de volta, {{ Auth::user()->name }}.</p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-slate-500 uppercase tracking-widest font-bold">Data de Hoje</p>
                        <p class="text-xl text-white font-mono">{{ date('d/m/Y') }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
                    
                    <div class="glass-panel p-6 rounded-2xl relative overflow-hidden group">
                        <div class="absolute -right-6 -top-6 w-24 h-24 bg-blue-500/20 rounded-full blur-2xl group-hover:bg-blue-500/30 transition"></div>
                        <p class="text-slate-400 text-sm font-bold uppercase tracking-wider mb-2">Total Usuários</p>
                        <div class="flex items-end justify-between">
                            <span class="text-3xl font-bold text-white">{{ $totalUsers }}</span>
                            <span class="text-green-400 text-xs font-bold bg-green-500/10 px-2 py-1 rounded">+12%</span>
                        </div>
                    </div>

                    <div class="glass-panel p-6 rounded-2xl relative overflow-hidden group">
                        <div class="absolute -right-6 -top-6 w-24 h-24 bg-purple-500/20 rounded-full blur-2xl group-hover:bg-purple-500/30 transition"></div>
                        <p class="text-slate-400 text-sm font-bold uppercase tracking-wider mb-2">Artistas Ativos</p>
                        <div class="flex items-end justify-between">
                            <span class="text-3xl font-bold text-white">{{ $totalArtists }}</span>
                            <span class="text-purple-400 text-xs font-bold bg-purple-500/10 px-2 py-1 rounded">Criadores</span>
                        </div>
                    </div>

                    <div class="glass-panel p-6 rounded-2xl relative overflow-hidden group">
                        <div class="absolute -right-6 -top-6 w-24 h-24 bg-pink-500/20 rounded-full blur-2xl group-hover:bg-pink-500/30 transition"></div>
                        <p class="text-slate-400 text-sm font-bold uppercase tracking-wider mb-2">Artes no Lago</p>
                        <div class="flex items-end justify-between">
                            <span class="text-3xl font-bold text-white">{{ $totalArts }}</span>
                            <span class="text-pink-400 text-xs font-bold bg-pink-500/10 px-2 py-1 rounded">Galeria</span>
                        </div>
                    </div>

                    <div class="glass-panel p-6 rounded-2xl relative overflow-hidden group border-yellow-500/20">
                        <div class="absolute -right-6 -top-6 w-24 h-24 bg-yellow-500/20 rounded-full blur-2xl group-hover:bg-yellow-500/30 transition"></div>
                        <p class="text-yellow-200/60 text-sm font-bold uppercase tracking-wider mb-2">Economia (Moedas)</p>
                        <div class="flex items-end justify-between">
                            <span class="text-3xl font-bold text-white flex items-center gap-2">
                                <span class="text-yellow-400 text-2xl">🪙</span> {{ number_format($moneyCirculation, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    
                    <div class="lg:col-span-2 glass-panel rounded-2xl p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-xl font-bold text-white">Últimas Artes (Moderação)</h3>
                            <button class="text-xs text-cyan-400 hover:text-cyan-300 font-bold">Ver Todas</button>
                        </div>
                        
                        <div class="space-y-4">
                            @foreach($latestArts as $art)
                                <div class="flex items-center gap-4 p-3 rounded-xl hover:bg-white/5 transition border border-transparent hover:border-white/10 group">
                                    <div class="w-16 h-12 rounded-lg overflow-hidden bg-black/50 relative">
                                        @if(Str::startsWith($art->imagem_caminho, 'fake_demo'))
                                            <img src="https://picsum.photos/seed/{{ $art->id }}/100/100" class="w-full h-full object-cover">
                                        @else
                                            <img src="{{ asset('storage/' . $art->imagem_caminho) }}" class="w-full h-full object-cover">
                                        @endif
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h4 class="text-white font-bold truncate text-sm">{{ $art->titulo }}</h4>
                                        <p class="text-slate-400 text-xs truncate">por {{ $art->user->name }}</p>
                                    </div>
                                    <div class="text-right">
    <p class="text-yellow-400 text-xs font-bold mb-1">🪙 {{ number_format($art->preco, 0, ',', '.') }}</p>
    
    <div class="flex gap-2 opacity-0 group-hover:opacity-100 transition">
        <form action="{{ route('admin.arts.ban', $art->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja banir esta arte? A ação é irreversível.');">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-red-400 hover:text-red-300 text-xs font-bold underline decoration-red-500/30 hover:decoration-red-300">
                Remover
            </button>
        </form>
    </div>
</div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="glass-panel rounded-2xl p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-xl font-bold text-white">Novos Usuários</h3>
                        </div>

                        <div class="space-y-4">
                            @foreach($newUsers as $user)
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-slate-700 flex items-center justify-center font-bold text-white text-sm">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h4 class="text-slate-200 font-semibold text-sm truncate">{{ $user->name }}</h4>
                                        <p class="text-slate-500 text-xs truncate">{{ $user->email }}</p>
                                    </div>
                                    @if($user->is_artist)
                                        <span class="text-[10px] bg-purple-500/20 text-purple-300 px-2 py-0.5 rounded border border-purple-500/30">ART</span>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>

            </div>
        </main>
    </div>

</body>
</html>