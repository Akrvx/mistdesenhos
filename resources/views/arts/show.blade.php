@extends('layouts.site')

@section('content')

    <div class="w-full min-h-screen pt-32 pb-20 px-4 sm:px-6 lg:px-8">
        
        <a href="{{ url()->previous() }}" class="inline-flex items-center text-cyan-200 hover:text-white mb-8 transition gap-2 font-semibold">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Voltar
        </a>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            
            <div class="lg:col-span-2">
                <div class="glass-card p-2 rounded-3xl border border-white/20 shadow-2xl relative overflow-hidden group">
                    <div class="rounded-2xl overflow-hidden relative">
                         @if(Str::startsWith($art->imagem_caminho, 'fake_demo'))
                            <img src="https://picsum.photos/seed/{{ $art->id }}/1200/800" class="w-full h-auto object-cover transform group-hover:scale-105 transition duration-700">
                        @else
                            <img src="{{ asset('storage/' . $art->imagem_caminho) }}" class="w-full h-auto object-cover transform group-hover:scale-105 transition duration-700">
                        @endif
                        
                        <div class="absolute inset-0 flex items-center justify-center pointer-events-none opacity-0 group-hover:opacity-100 transition duration-500">
                            <span class="text-white/20 text-6xl font-bold rotate-45 select-none">DUCKLY PREVIEW</span>
                        </div>
                    </div>
                </div>

                <div class="mt-8 px-4">
                    <div class="flex items-center gap-4 mb-4">
                        <span class="px-4 py-1 rounded-full border border-cyan-500/30 bg-cyan-500/10 text-cyan-300 text-sm font-bold uppercase tracking-wider">
                            {{ $art->category ?? 'Arte Digital' }}
                        </span>
                        <span class="text-white/40 text-sm flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Postado {{ $art->created_at->diffForHumans() }}
                        </span>
                    </div>

                    <h1 class="text-4xl md:text-5xl font-bold text-white mb-6 leading-tight">{{ $art->titulo }}</h1>
                    
                    <div class="prose prose-invert prose-lg text-gray-200">
                        <p>{{ $art->descricao ?? 'O artista não forneceu uma descrição detalhada para esta obra, mas a imagem fala por si.' }}</p>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-1 space-y-8 sticky top-32 h-fit">
                
                <div class="glass-card p-8 rounded-3xl border border-white/20 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-yellow-500/10 rounded-full blur-3xl"></div>

                    <p class="text-cyan-200 mb-2 font-semibold">Valor do Investimento</p>
                    
                    <div class="flex items-center gap-3 mb-8">
                        <span class="text-4xl text-yellow-400">🪙</span>
                        <span class="text-5xl font-bold text-white">
                            {{ number_format($art->preco, 0, ',', '.') }}
                        </span>
                    </div>

                    @auth
                        @if(Auth::id() == $art->user_id)
                            <div class="bg-white/5 border border-white/10 rounded-xl p-4 text-center">
                                <p class="text-white font-bold">Você é o autor</p>
                                <p class="text-sm text-white/50">Gerencie esta obra no Dashboard</p>
                            </div>
                        @else
                            <form action="{{ route('art.purchase', $art->id) }}" method="POST">
                                @csrf
                                <button type="submit" 
                                    class="w-full bg-gradient-to-r from-yellow-400 to-orange-500 hover:from-yellow-300 hover:to-orange-400 text-black font-bold py-4 rounded-xl shadow-[0_0_20px_rgba(250,204,21,0.4)] transition transform hover:-translate-y-1 active:scale-95"
                                    onclick="return confirm('Confirmar a compra por {{ $art->preco }} moedas?')">
                                    Comprar Agora
                                </button>
                            </form>
                            
                            @if(Auth::user()->wallet_balance < $art->preco)
                                <div class="mt-4 p-3 bg-red-500/20 border border-red-500/30 rounded-lg text-center">
                                    <p class="text-red-200 text-sm mb-2">
                                        Saldo insuficiente (🪙 {{ number_format(Auth::user()->wallet_balance, 0, ',', '.') }})
                                    </p>
                                    <a href="{{ route('wallet.index') }}" class="text-white underline font-bold text-sm hover:text-cyan-300">
                                        Recarregar Carteira
                                    </a>
                                </div>
                            @else
                                <p class="text-green-300 text-xs text-center mt-3 flex items-center justify-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    Seu saldo cobre esta compra
                                </p>
                            @endif
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="block w-full text-center bg-white/20 hover:bg-white/30 text-white py-4 rounded-xl font-bold transition">
                            Faça Login para Comprar
                        </a>
                    @endauth

                    <div class="mt-8 pt-6 border-t border-white/10 text-center">
                        <p class="text-xs text-white/40">Transação segura protegida por Duckly Chain.</p>
                    </div>
                </div>

                <div class="glass-card p-6 rounded-3xl border border-white/10 flex items-center gap-4 hover:bg-white/5 transition cursor-pointer group" onclick="window.location='{{ route('artist.show', $art->user->id) }}'">
                    <div class="w-16 h-16 rounded-full bg-gradient-to-br from-cyan-400 to-blue-600 flex items-center justify-center text-2xl font-bold text-white shadow-lg border-2 border-white/20 group-hover:scale-110 transition">
                        {{ substr($art->user->name, 0, 1) }}
                    </div>
                    <div>
                        <p class="text-cyan-200 text-xs uppercase tracking-wide font-bold">Criado por</p>
                        <h3 class="text-white font-bold text-xl group-hover:text-cyan-300 transition">{{ $art->user->name }}</h3>
                        <div class="flex items-center gap-2 mt-1">
                            <span class="text-yellow-400 text-xs">★ {{ $art->user->reputation }} Reputação</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection