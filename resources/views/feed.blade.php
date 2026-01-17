@extends('layouts.site')

@section('content')

    <div class="max-w-7xl mx-auto px-4">
        
        <div class="text-center mb-10 animate-fade-in-up">
            <h1 class="text-4xl font-bold text-white mb-2 tracking-tight">Explorar o Lago</h1>
            <p class="text-cyan-200 text-lg">Descubra novas visões e os mestres das águas.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8 items-start">
            
            <div class="lg:col-span-3">
                
                <div class="flex gap-3 mb-8 overflow-x-auto pb-4 no-scrollbar">
                    @php
                        $categorias = ['Todas', 'Digital', 'Pintura', '3D', 'Fotografia', 'IA', 'Pixel Art'];
                        $catAtiva = request('categoria') ?? 'Todas';
                    @endphp

                    @foreach($categorias as $cat)
                        <a href="{{ $cat == 'Todas' ? route('feed') : route('feed', ['categoria' => $cat]) }}" 
                           class="px-5 py-2 rounded-full font-bold text-sm transition-all duration-300 border border-white/10 whitespace-nowrap
                           {{ strtolower($catAtiva) == strtolower($cat) 
                                ? 'bg-cyan-500 text-white shadow-[0_0_15px_rgba(6,182,212,0.5)]' 
                                : 'bg-white/5 text-gray-300 hover:bg-white/20' 
                           }}">
                            {{ $cat }}
                        </a>
                    @endforeach
                </div>

                @if($arts->isEmpty())
                    <div class="glass-card p-12 text-center border-dashed border-2 border-white/10 rounded-3xl">
                        <div class="text-6xl mb-4">🌊</div>
                        <h3 class="text-xl font-bold text-white mb-2">Nada encontrado.</h3>
                        @if(request('categoria'))
                            <a href="{{ route('feed') }}" class="text-cyan-400 hover:underline">Limpar filtros</a>
                        @endif
                    </div>
                @else
                    <div class="space-y-10">
                        @foreach($arts as $art)
                            <div class="glass-card overflow-hidden rounded-3xl shadow-2xl border border-white/10 animate-fade-in-up hover:border-cyan-500/30 transition duration-500">
                                <div class="px-6 py-4 flex items-center justify-between bg-white/5 border-b border-white/5">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-cyan-400 to-blue-600 flex items-center justify-center font-bold text-white shadow-inner">
                                            {{ substr($art->user->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <a href="{{ route('artist.show', $art->user->id) }}" class="text-white font-bold hover:text-cyan-300 transition block leading-tight">
                                                {{ $art->user->name }}
                                            </a>
                                            <span class="text-xs text-cyan-200/60">{{ $art->category }}</span>
                                        </div>
                                    </div>
                                    <span class="bg-cyan-500/10 text-cyan-300 px-3 py-1 rounded-lg text-xs font-bold border border-cyan-500/20">
                                        R$ {{ number_format($art->preco, 2, ',', '.') }}
                                    </span>
                                </div>

                                <div class="relative group bg-black/20">
                                    <a href="{{ route('arts.show', $art->id) }}" class="block overflow-hidden">
                                        @if(Str::startsWith($art->imagem_caminho, 'fake_demo'))
                                            <img src="https://picsum.photos/seed/{{ $art->id }}/800/600" class="w-full object-cover max-h-[500px] transition duration-700 group-hover:scale-105">
                                        @else
                                            <img src="{{ asset('storage/' . $art->imagem_caminho) }}" class="w-full object-cover max-h-[500px] transition duration-700 group-hover:scale-105">
                                        @endif
                                    </a>
                                </div>

                                <div class="p-5">
                                    <h2 class="text-xl font-bold text-white mb-2">{{ $art->titulo }}</h2>
                                    <div class="flex gap-3">
                                        <a href="{{ route('arts.show', $art->id) }}" class="flex-1 bg-white/10 hover:bg-white/20 text-white py-2 rounded-xl font-semibold transition text-center text-sm">
                                            Ver Detalhes
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="lg:col-span-1 space-y-8 sticky top-24">
                
                <div class="glass-card p-6 rounded-2xl border border-white/10 relative overflow-hidden">
                    <div class="absolute -top-10 -right-10 w-32 h-32 bg-yellow-500/20 rounded-full blur-3xl"></div>
                    
                    <h3 class="text-lg font-bold text-white mb-4 flex items-center gap-2">
                        <span class="text-yellow-400 text-2xl">👑</span> Top Vendas
                    </h3>

                    <div class="space-y-4">
                        @foreach($topSellers as $index => $seller)
                            <div class="flex items-center justify-between group">
                                <div class="flex items-center gap-2 overflow-hidden">
                                    <span class="font-bold text-white/30 text-lg w-4 shrink-0">{{ $index + 1 }}</span>
                                    <div class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center text-xs font-bold text-white shrink-0">
                                        {{ substr($seller->name, 0, 1) }}
                                    </div>
                                    <a href="{{ route('artist.show', $seller->id) }}" class="text-sm text-gray-200 group-hover:text-cyan-300 transition truncate">
                                        {{ $seller->name }}
                                    </a>
                                </div>
                                <span class="text-xs font-bold text-cyan-400 bg-cyan-900/30 px-2 py-1 rounded shrink-0">
                                    {{ $seller->total_sales }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="glass-card p-6 rounded-2xl border border-white/10 relative overflow-hidden">
                    <div class="absolute -bottom-10 -left-10 w-32 h-32 bg-pink-500/20 rounded-full blur-3xl"></div>

                    <h3 class="text-lg font-bold text-white mb-4 flex items-center gap-2">
                        <span class="text-pink-400 text-2xl">★</span> Aclamados
                    </h3>

                    <div class="space-y-4">
                        @foreach($topRated as $index => $artist)
                            <div class="flex items-center justify-between group">
                                <div class="flex items-center gap-2 overflow-hidden">
                                    <span class="font-bold text-white/30 text-lg w-4 shrink-0">{{ $index + 1 }}</span>
                                    <div class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center text-xs font-bold text-white shrink-0">
                                        {{ substr($artist->name, 0, 1) }}
                                    </div>
                                    <a href="{{ route('artist.show', $artist->id) }}" class="text-sm text-gray-200 group-hover:text-pink-300 transition truncate">
                                        {{ $artist->name }}
                                    </a>
                                </div>
                                <div class="flex text-yellow-400 text-xs shrink-0">
                                    ★ {{ $artist->reputation }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="glass-card p-6 rounded-2xl border border-dashed border-white/20 text-center">
                    
                    @if(Auth::user()->is_artist)
                        <p class="text-sm text-cyan-200 mb-3">Quer subir no ranking?</p>
                        <a href="{{ route('arts.create') }}" class="block w-full bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-400 hover:to-blue-500 text-white font-bold py-2 rounded-lg text-sm transition shadow-lg">
                            Subir Nova Arte
                        </a>
                    @else
                        <p class="text-sm text-cyan-200 mb-3">Tem talento escondido?</p>
                        <a href="{{ route('dashboard') }}" class="block w-full bg-white/10 hover:bg-white/20 text-white font-bold py-2 rounded-lg text-sm transition border border-white/30">
                            Tornar-se Artista
                        </a>
                    @endif

                </div>

            </div>
        </div>
    </div>
@endsection