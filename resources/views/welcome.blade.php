@extends('layouts.site')

@section('content')

    <div class="w-full min-h-screen pt-32 pb-12">
        
        <div class="text-center py-20 px-4 animate-fade-in-up relative z-10">
            <h1 class="text-7xl md:text-9xl font-bold text-white mb-2 tracking-tighter drop-shadow-[0_0_25px_rgba(6,182,212,0.5)]">
                Duck<span class="text-cyan-400">ly</span>
            </h1>
            <p class="text-xl md:text-2xl text-cyan-100 mb-8 font-light tracking-widest uppercase opacity-80">
                Marketplace de Arte & Comissões
            </p>
            
            <div class="flex justify-center gap-6 mt-8">
                @guest
                    <a href="{{ route('register') }}" class="px-12 py-4 bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-400 hover:to-blue-500 text-white rounded-full font-bold text-xl shadow-[0_0_30px_rgba(6,182,212,0.4)] transition transform hover:scale-105 hover:-translate-y-1 flex items-center gap-3">
                        <span>🦆</span> Começar Agora
                    </a>
                @else
                    <a href="{{ route('feed') }}" class="px-10 py-4 bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-400 hover:to-blue-500 text-white rounded-full font-bold text-lg shadow-[0_0_20px_rgba(6,182,212,0.6)] transition transform hover:scale-105 hover:-translate-y-1 flex items-center gap-2">
                        <span>🌊</span> Explorar o Lago
                    </a>
                    <a href="{{ route('dashboard') }}" class="px-10 py-4 bg-white/5 hover:bg-white/10 text-white rounded-full font-bold text-lg border border-white/20 transition backdrop-blur-sm">
                        Meu Painel
                    </a>
                @endguest
            </div>

            <div class="mt-16 animate-bounce text-white/30">
                <svg class="w-8 h-8 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
            </div>
        </div>

        <div class="max-w-[95%] mx-auto px-4 mt-8">
            <div class="flex items-center gap-4 mb-8">
                <div class="h-px bg-white/10 flex-grow"></div>
                <h2 class="text-white/50 font-bold uppercase tracking-widest text-sm">Explorar Galeria</h2>
                <div class="h-px bg-white/10 flex-grow"></div>
            </div>

            @if($arts->isEmpty())
                <div class="text-center py-20 glass-card rounded-3xl border border-white/10 mx-auto max-w-2xl"><p class="text-white/40 text-xl">O lago está calmo... Nenhuma arte encontrada.</p></div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                    @foreach($arts as $art)
                        <div class="glass-card overflow-hidden rounded-3xl border border-white/10 hover:border-cyan-500/50 transition duration-500 group relative flex flex-col">
                            <div class="aspect-[4/3] bg-black/20 relative overflow-hidden">
                                <a href="{{ route('arts.show', $art->id) }}">
                                    @if(Str::startsWith($art->imagem_caminho, 'fake_demo'))
                                        <img src="https://picsum.photos/seed/{{ $art->id }}/800/800" class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                                    @else
                                        <img src="{{ asset('storage/' . $art->imagem_caminho) }}" class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                                    @endif
                                </a>
                                <div class="absolute top-3 right-3 bg-black/60 backdrop-blur-md text-white font-bold px-3 py-1 rounded-full text-sm border border-white/10 shadow-lg flex items-center gap-1">
                                    <span class="text-yellow-400">🪙</span> {{ number_format($art->preco, 0, ',', '.') }}
                                </div>
                                @if($art->is_nsfw)
                                    <div class="absolute top-3 left-3 bg-red-600/90 text-white font-bold px-2 py-1 rounded-lg text-xs border border-red-400 shadow-lg">NSFW</div>
                                @endif
                            </div>
                            <div class="p-5 flex flex-col flex-grow">
                                <div class="flex items-center gap-3 mb-3">
                                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-cyan-400 to-blue-600 flex items-center justify-center text-xs font-bold text-white shadow-inner">{{ substr($art->user->name, 0, 1) }}</div>
                                    <div class="overflow-hidden">
                                        <h3 class="text-white font-bold truncate text-lg leading-tight group-hover:text-cyan-300 transition">
                                            <a href="{{ route('arts.show', $art->id) }}">{{ $art->titulo }}</a>
                                        </h3>
                                        <a href="{{ route('artist.show', $art->user->id) }}" class="text-xs text-cyan-200 hover:text-white transition truncate block">por {{ $art->user->name }}</a>
                                    </div>
                                </div>
                                <div class="mt-auto pt-4">
                                    <a href="{{ route('arts.show', $art->id) }}" class="block w-full text-center py-2 rounded-xl bg-white/5 hover:bg-white/20 text-white text-sm font-semibold transition border border-white/10 group-hover:border-cyan-500/30">Ver Detalhes</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection