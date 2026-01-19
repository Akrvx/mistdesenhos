@extends('layouts.site')

@section('content')

    <div class="pt-32 pb-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto min-h-screen">
        
        <div class="glass-card p-8 rounded-3xl mb-10 relative overflow-hidden border border-white/20">
            <div class="absolute -right-10 -top-10 w-64 h-64 bg-cyan-500/20 rounded-full blur-3xl"></div>
            
            <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-6">
                <div class="flex items-center gap-6">
                    <div class="w-20 h-20 rounded-full bg-gradient-to-br from-cyan-400 to-blue-600 flex items-center justify-center text-3xl font-bold text-white shadow-lg border-2 border-white/30">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div>
                        <h2 class="text-3xl font-bold text-white">
                            Olá, {{ Auth::user()->name }}! 👋
                        </h2>
                        <p class="text-cyan-200 mt-1">
                            @if(Auth::user()->is_artist)
                                Painel do Artista
                            @else
                                Painel do Cliente
                            @endif
                        </p>
                    </div>
                </div>

                <div class="flex flex-wrap gap-4 justify-center md:justify-end">
                    
                    <a href="{{ route('feed') }}" class="bg-white/5 hover:bg-white/20 text-white font-bold py-3 px-6 rounded-xl border border-white/20 transition flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        Voltar ao Feed
                    </a>

                    @if(Auth::user()->is_artist)
                        <a href="{{ route('arts.create') }}" class="bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-400 hover:to-blue-500 text-white font-bold py-3 px-6 rounded-xl shadow-lg transition transform hover:-translate-y-1">
                            + Nova Arte
                        </a>
                        
                        <a href="{{ route('artist.show', Auth::id()) }}" class="bg-white/10 hover:bg-white/20 text-white font-bold py-3 px-6 rounded-xl border border-white/20 transition">
                            Minha Vitrine
                        </a>
                    @else
                        <a href="{{ route('commissions.index') }}" class="bg-gradient-to-r from-purple-600 to-blue-600 hover:from-purple-500 hover:to-blue-500 text-white font-bold py-3 px-6 rounded-xl shadow-lg transition transform hover:-translate-y-1">
                            📦 Meus Pedidos
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <div class="glass-card p-6 rounded-2xl border border-white/10 hover:border-yellow-400/50 transition duration-300 group">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-3 bg-yellow-500/20 rounded-xl text-yellow-300">
                        <span class="text-2xl">🪙</span>
                    </div>
                    <a href="{{ route('wallet.index') }}" class="text-xs text-white/50 hover:text-white uppercase font-bold tracking-wider">Recarregar</a>
                </div>
                <p class="text-white/60 text-sm">Saldo Atual</p>
                <h3 class="text-3xl font-bold text-white group-hover:text-yellow-300 transition">
                    {{ number_format(Auth::user()->wallet_balance, 2, ',', '.') }}
                </h3>
            </div>

            @if(Auth::user()->is_artist)
                <div class="glass-card p-6 rounded-2xl border border-white/10 hover:border-green-400/50 transition duration-300 group">
                    <div class="flex justify-between items-start mb-4">
                        <div class="p-3 bg-green-500/20 rounded-xl text-green-300">
                            <span class="text-2xl">📈</span>
                        </div>
                    </div>
                    <p class="text-white/60 text-sm">Total de Vendas</p>
                    <h3 class="text-3xl font-bold text-white group-hover:text-green-300 transition">
                        {{ Auth::user()->total_sales }}
                    </h3>
                </div>

                <div class="glass-card p-6 rounded-2xl border border-white/10 hover:border-pink-400/50 transition duration-300 group">
                    <div class="flex justify-between items-start mb-4">
                        <div class="p-3 bg-pink-500/20 rounded-xl text-pink-300">
                            <span class="text-2xl">★</span>
                        </div>
                    </div>
                    <p class="text-white/60 text-sm">Reputação</p>
                    <h3 class="text-3xl font-bold text-white group-hover:text-pink-300 transition">
                        {{ Auth::user()->reputation }}
                    </h3>
                </div>
            @else
                <div class="glass-card p-6 rounded-2xl border border-white/10 hover:border-blue-400/50 transition duration-300 group">
                    <div class="flex justify-between items-start mb-4">
                        <div class="p-3 bg-blue-500/20 rounded-xl text-blue-300">
                            <span class="text-2xl">🛍️</span>
                        </div>
                    </div>
                    <p class="text-white/60 text-sm">Pedidos Feitos</p>
                    <h3 class="text-3xl font-bold text-white group-hover:text-blue-300 transition">
                        {{ Auth::user()->commissionsAsClient->count() }}
                    </h3>
                </div>

                <div class="glass-card p-6 rounded-2xl border border-white/10 hover:border-purple-400/50 transition duration-300 group">
                    <div class="flex justify-between items-start mb-4">
                        <div class="p-3 bg-purple-500/20 rounded-xl text-purple-300">
                            <span class="text-2xl">🎨</span>
                        </div>
                    </div>
                    <p class="text-white/60 text-sm">Status da Conta</p>
                    <h3 class="text-xl font-bold text-white group-hover:text-purple-300 transition mt-1">
                        Cliente
                    </h3>
                    <p class="text-xs text-white/30 mt-1">Quer vender artes? Contate o suporte.</p>
                </div>
            @endif
        </div>

        <div class="mt-10">
            <h3 class="text-xl font-bold text-white mb-6 flex items-center gap-2">
                <svg class="w-5 h-5 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                Gerenciamento Rápido
            </h3>
            
            <div class="glass-card rounded-2xl border border-white/10 overflow-hidden">
                <div class="grid grid-cols-1 {{ Auth::user()->is_artist ? 'md:grid-cols-2 divide-y md:divide-y-0 md:divide-x' : '' }} divide-white/10">
                    <a href="{{ route('profile.edit') }}" class="p-6 hover:bg-white/5 transition flex items-center gap-4 group">
                        <div class="w-10 h-10 rounded-full bg-blue-500/20 flex items-center justify-center text-blue-300 group-hover:scale-110 transition">
                            👤
                        </div>
                        <div>
                            <h4 class="text-white font-bold">Editar Dados Pessoais</h4>
                            <p class="text-white/40 text-sm">Alterar senha, email e nome.</p>
                        </div>
                    </a>

                    @if(Auth::user()->is_artist)
                        <a href="{{ route('arts.create') }}" class="p-6 hover:bg-white/5 transition flex items-center gap-4 group">
                            <div class="w-10 h-10 rounded-full bg-purple-500/20 flex items-center justify-center text-purple-300 group-hover:scale-110 transition">
                                🎨
                            </div>
                            <div>
                                <h4 class="text-white font-bold">Publicar Serviço ou Arte</h4>
                                <p class="text-white/40 text-sm">Adicione novos itens à sua loja.</p>
                            </div>
                        </a>
                    @endif
                </div>
            </div>
        </div>

    </div>
@endsection