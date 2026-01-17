<x-app-layout>
    <div class="pt-32 pb-10 px-4">
        <div class="max-w-5xl mx-auto text-center">
            
            <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-gradient-to-br from-cyan-400 to-blue-600 text-4xl font-bold text-white shadow-[0_0_30px_rgba(6,182,212,0.6)] mb-6 border-4 border-white/20">
                {{ substr($user->name, 0, 1) }}
            </div>

            <h1 class="text-5xl font-bold text-white mb-2 drop-shadow-lg tracking-tight">
                {{ $user->name }}
            </h1>
            <p class="text-cyan-200 text-lg mb-8 font-light">
                Membro do Duckly desde {{ $user->created_at->format('Y') }}
            </p>

            <div class="inline-flex space-x-8 bg-white/10 backdrop-blur-md px-8 py-4 rounded-2xl border border-white/10">
                <div class="text-center">
                    <span class="block text-2xl font-bold text-white">{{ $arts->count() }}</span>
                    <span class="text-xs text-cyan-300 uppercase tracking-wider">Obras</span>
                </div>
                <div class="text-center border-l border-white/10 pl-8">
                    <span class="block text-2xl font-bold text-white">★</span>
                    <span class="text-xs text-cyan-300 uppercase tracking-wider">Reputação</span>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 pb-20">
        <h2 class="text-2xl font-bold text-white mb-8 border-l-4 border-cyan-400 pl-4">
            Galeria de {{ explode(' ', $user->name)[0] }}
        </h2>

        @if($arts->isEmpty())
            <div class="text-center py-20 bg-white/5 rounded-3xl border border-white/10 border-dashed">
                <p class="text-cyan-200 text-xl">Este artista ainda não subiu nenhuma obra para a superfície.</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($arts as $art)
                    <div class="glass-card group relative overflow-hidden rounded-xl transition hover:-translate-y-2 duration-300">
                        <div class="aspect-square overflow-hidden">
                            <img src="{{ asset('storage/' . $art->imagem_caminho) }}" class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                        </div>

                        <div class="absolute inset-0 bg-gradient-to-t from-blue-900/90 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex flex-col justify-end p-6">
                            <h3 class="text-xl font-bold text-white">{{ $art->titulo }}</h3>
                            <p class="text-cyan-300 font-bold text-lg mt-1">R$ {{ number_format($art->preco, 2, ',', '.') }}</p>
                            
                            <a href="{{ route('arts.show', $art->id) }}" class="mt-4 text-center bg-white/20 hover:bg-cyan-500 text-white py-2 rounded-lg backdrop-blur-sm transition">
                                Ver Detalhes
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>