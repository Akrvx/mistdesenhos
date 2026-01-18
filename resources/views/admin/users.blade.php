<!DOCTYPE html>
<html lang="pt-BR" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Duckly Staff | Gestão de Usuários</title>
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
                    <h2 class="text-3xl font-bold text-white mb-1">Usuários Registrados</h2>
                    <p class="text-slate-400">Gerencie quem tem acesso ao lago.</p>
                </div>
                <div class="bg-slate-800 px-4 py-2 rounded-lg text-sm text-slate-300">
                    Total: <strong>{{ $users->total() }}</strong>
                </div>
            </div>

            @if(session('error'))
                <div class="mb-6 bg-red-500/10 border border-red-500/20 text-red-400 px-4 py-3 rounded-xl">{{ session('error') }}</div>
            @endif
            @if(session('success'))
                <div class="mb-6 bg-green-500/10 border border-green-500/20 text-green-400 px-4 py-3 rounded-xl">{{ session('success') }}</div>
            @endif

            <div class="glass-panel rounded-2xl overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="text-slate-400 text-xs uppercase tracking-wider bg-white/5 border-b border-white/5">
                            <th class="p-4 font-bold">Usuário</th>
                            <th class="p-4 font-bold">Status</th>
                            <th class="p-4 font-bold">Saldo</th>
                            <th class="p-4 font-bold">Registro</th>
                            <th class="p-4 font-bold text-right">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm divide-y divide-white/5">
                        @foreach($users as $user)
                            <tr class="hover:bg-white/5 transition group">
                                <td class="p-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-slate-700 to-slate-600 flex items-center justify-center font-bold text-white shadow-inner">
                                            {{ substr($user->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="font-bold text-white">{{ $user->name }}</p>
                                            <p class="text-slate-500 text-xs">{{ $user->email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-4">
                                    <div class="flex gap-2">
                                        @if($user->is_admin)
                                            <span class="px-2 py-1 rounded text-[10px] font-bold bg-red-500/20 text-red-300 border border-red-500/30">ADMIN</span>
                                        @endif
                                        @if($user->is_artist)
                                            <span class="px-2 py-1 rounded text-[10px] font-bold bg-purple-500/20 text-purple-300 border border-purple-500/30">ARTISTA</span>
                                        @endif
                                        @if(!$user->is_admin && !$user->is_artist)
                                            <span class="px-2 py-1 rounded text-[10px] font-bold bg-slate-500/20 text-slate-300 border border-slate-500/30">USER</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="p-4 font-mono text-yellow-400">
                                    🪙 {{ number_format($user->wallet_balance, 0, ',', '.') }}
                                </td>
                                <td class="p-4 text-slate-400">
                                    {{ $user->created_at->format('d/m/Y') }}
                                </td>
                                <td class="p-4 text-right">
                                    @if($user->id !== auth()->id())
                                        <form action="{{ route('admin.users.ban', $user->id) }}" method="POST" onsubmit="return confirm('Tem certeza? Isso vai banir o usuário permanentemente.')" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-red-500 hover:text-red-400 font-bold text-xs bg-red-500/10 hover:bg-red-500/20 px-3 py-1.5 rounded-lg transition">
                                                Banir
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-xs text-slate-600 italic">Você</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                
                @if($users->hasPages())
                    <div class="p-4 border-t border-white/5">
                        {{ $users->links() }} 
                    </div>
                @endif
            </div>

        </main>
    </div>

</body>
</html>