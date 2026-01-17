@extends('layouts.site')

@section('content')

<div class="relative w-full h-screen overflow-hidden flex items-center justify-center">

    <div class="absolute inset-0 grid grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-2 opacity-20 transform scale-105 pointer-events-none">
        @foreach($arts as $art) 
            <div class="aspect-square overflow-hidden rounded-lg">
                <img src="{{ asset('storage/' . $art->imagem_caminho) }}" class="w-full h-full object-cover grayscale opacity-60" alt="Arte de fundo">
            </div>
        @endforeach
        @foreach($arts as $art) 
            <div class="aspect-square overflow-hidden rounded-lg">
                <img src="{{ asset('storage/' . $art->imagem_caminho) }}" class="w-full h-full object-cover grayscale opacity-60" alt="Arte de fundo">
            </div>
        @endforeach
    </div>

    <div class="absolute inset-0 bg-gradient-to-b from-blue-900/30 via-transparent to-blue-900/80"></div>

    <div class="relative z-10 text-center px-4 animate-fade-in-up">
        <h1 class="text-6xl md:text-8xl font-extrabold tracking-tighter text-transparent bg-clip-text bg-gradient-to-r from-cyan-200 to-white drop-shadow-[0_5px_5px_rgba(0,0,0,0.5)]">
            Duck<span class="text-cyan-400">ly</span>
        </h1>
        
        <p class="mt-4 text-xl md:text-2xl text-cyan-100 font-light tracking-wide drop-shadow-md">
            Mergulhe na criatividade.
        </p>

        <div class="mt-8">
            <a href="#galeria" class="px-8 py-3 rounded-full bg-white/10 border border-white/30 text-white font-semibold backdrop-blur-md hover:bg-white/20 transition-all duration-300 shadow-[0_0_20px_rgba(0,255,255,0.2)]">
                Explorar o Lago
            </a>
        </div>
    </div>

    <div class="absolute bottom-10 z-10 animate-bounce text-white/50">
        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
    </div>

</div>

<div id="galeria" class="py-20 min-h-screen bg-blue-900/40 backdrop-blur-sm">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-white mb-8 border-l-4 border-cyan-400 pl-4">Artes Recentes</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            @foreach($arts as $art)
                <div class="glass-card p-4 hover:bg-white/20 transition duration-300 group">
                    <div class="rounded-xl overflow-hidden mb-4 h-48 relative">
                        <img src="{{ asset('storage/' . $art->imagem_caminho) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        
                        <a href="{{ route('arts.show', $art->id) }}" class="absolute inset-0"></a>
                    </div>
                    
                    <h3 class="text-xl font-bold text-white truncate">{{ $art->titulo }}</h3>
                    
                    <p class="text-sm text-cyan-200 mt-1">
                        Por <a href="{{ route('artist.show', $art->user->id) }}" class="hover:text-white hover:underline font-bold transition">
                            {{ $art->user->name }}
                        </a>
                    </p>
                    
                    <div class="flex justify-between items-center mt-4">
                        <span class="text-lg font-bold text-yellow-300">R$ {{ number_format($art->preco, 2, ',', '.') }}</span>
                        <a href="{{ route('arts.show', $art->id) }}" class="bg-white/10 hover:bg-cyan-500 hover:text-white text-cyan-200 px-4 py-1 rounded-lg text-sm font-bold transition">
                            Ver
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

@endsection