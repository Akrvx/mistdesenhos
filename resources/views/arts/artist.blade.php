@extends('layouts.site')

@section('content')

    <div class="relative h-64 w-full bg-gradient-to-r from-cyan-900 to-blue-900 overflow-hidden">
        <div class="absolute inset-0 bg-black/30"></div>
        <div class="absolute top-0 left-0 w-full h-full opacity-30" 
             style="background-image: url('https://www.transparenttextures.com/patterns/cubes.png');">
        </div>
        
        <a href="{{ route('feed') }}" class="absolute top-28 left-6 md:left-10 z-10 bg-black/40 hover:bg-black/60 text-white px-4 py-2 rounded-full backdrop-blur-sm transition flex items-center gap-2 border border-white/10">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Voltar ao Feed
        </a>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-20 relative z-10 pb-20">
        
        <div class="flex flex-col md:flex-row gap-8 items-start">
            
            <div class="w-full md:w-80 flex-shrink-0">
                <div class="glass-card p-6 rounded-3xl border border-white/20 text-center relative overflow-hidden">
                    
                    <div class="w-32 h-32 mx-auto rounded-full bg-gradient-to-br from-cyan-400 to-blue-600 p-1 shadow-2xl relative group">
                        <div class="w-full h-full rounded-full bg-gray-900 flex items-center justify-center text-4xl font-bold text-white overflow-hidden">
                            {{ substr($user->name, 0, 1) }}
                        </div>
                        <div class="absolute bottom-2 right-2 w-6 h-6 bg-green-500 border-4 border-gray-900 rounded-full" title="Online"></div>
                    </div>

                    <h1 class="text-2xl font-bold text-white mt-4">{{ $user->name }}</h1>
                    <p class="text-cyan-200 text-sm mb-4">@ {{ strtolower(str_replace(' ', '', $user->name)) }}</p>

                    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-green-500/20 text-green-400 border border-green-500/30 text-xs font-bold uppercase tracking-wider mb-6">
                        <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                        Comissões Abertas
                    </div>

                    <div class="grid grid-cols-2 gap-2 border-t border-b border-white/10 py-4 mb-6">
                        <div>
                            <span class="block text-xl font-bold text-white">{{ $user->total_sales }}</span>
                            <span class="text-xs text-white/50 uppercase">Vendas</span>
                        </div>
                        <div>
                            <span class="block text-xl font-bold text-white">{{ $user->reputation }}</span>
                            <span class="text-xs text-white/50 uppercase">Reputação</span>
                        </div>
                    </div>

                    @auth
                        @if(Auth::id() !== $user->id)
                            <button class="w-full bg-white text-blue-900 font-bold py-3 rounded-xl hover:bg-cyan-50 transition shadow-lg mb-3">
                                Mensagem Direta
                            </button>
                            <button class="w-full bg-white/5 border border-white/10 text-white font-semibold py-2 rounded-xl hover:bg-white/10 transition text-sm">
                                Seguir
                            </button>
                        @else
                            <a href="{{ route('dashboard') }}" class="block w-full bg-cyan-600/50 border border-cyan-400/50 text-white font-bold py-3 rounded-xl hover:bg-cyan-600/70 transition">
                                Editar Perfil
                            </a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="block w-full bg-white text-blue-900 font-bold py-3 rounded-xl hover:bg-cyan-50 transition shadow-lg">
                            Logar para Contatar
                        </a>
                    @endauth

                    <div class="flex justify-center gap-4 mt-6 text-white/40">
                        <a href="#" class="hover:text-white transition"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg></a>
                        <a href="#" class="hover:text-white transition"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg></a>
                    </div>
                </div>
                
                <div class="mt-6">
                    <h4 class="text-white font-bold mb-3 text-sm uppercase tracking-wide opacity-70">Especialidades</h4>
                    <div class="flex flex-wrap gap-2">
                        <span class="px-3 py-1 rounded-lg bg-white/5 border border-white/10 text-xs text-cyan-200">Illustration</span>
                        <span class="px-3 py-1 rounded-lg bg-white/5 border border-white/10 text-xs text-cyan-200">Character Design</span>
                        <span class="px-3 py-1 rounded-lg bg-white/5 border border-white/10 text-xs text-cyan-200">VTuber</span>
                        <span class="px-3 py-1 rounded-lg bg-white/5 border border-white/10 text-xs text-cyan-200">Live2D</span>
                    </div>
                </div>
            </div>

            <div class="flex-1 min-w-0">
                
                <div class="flex items-center gap-6 border-b border-white/10 mb-8 overflow-x-auto pb-1">
                    <button onclick="switchTab('comissoes')" id="btn-comissoes" class="tab-btn text-white font-bold border-b-2 border-cyan-400 pb-3 px-2 transition">
                        🎨 Comissões (Serviços)
                    </button>
                    <button onclick="switchTab('shop')" id="btn-shop" class="tab-btn text-white/40 hover:text-white font-semibold pb-3 px-2 transition border-b-2 border-transparent">
                        🛍️ Shop (Pronta Entrega)
                    </button>
                    <button class="text-white/40 hover:text-white font-semibold pb-3 px-2 transition">Sobre</button>
                    <button class="text-white/40 hover:text-white font-semibold pb-3 px-2 transition">Reviews ({{ rand(5, 50) }})</button>
                </div>

                <div id="tab-comissoes" class="tab-content animate-fade-in-up">
                    @if($user->commissions->isEmpty())
                        <div class="glass-card p-12 text-center border-dashed border-2 border-white/10 rounded-3xl">
                            <p class="text-white/60">Este artista ainda não abriu comissões.</p>
                        </div>
                    @else
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            @foreach($user->commissions as $comm)
                                
                                <div class="glass-card p-6 rounded-2xl border border-white/10 transition duration-300 group cursor-pointer relative overflow-hidden flex flex-col
                                    {{ $comm->is_nsfw ? 'hover:border-red-500/50' : 'hover:border-pink-400/50' }}">
                                    
                                    <div class="absolute top-0 right-0 flex">
                                        @if($comm->is_nsfw)
                                            <div class="bg-red-600 text-white text-[10px] font-bold px-3 py-1 rounded-bl-xl tracking-wider">
                                                NSFW 18+
                                            </div>
                                        @endif
                                        @if(!$comm->is_nsfw && $comm->price < 100)
                                             <div class="bg-pink-500 text-white text-[10px] font-bold px-3 py-1 rounded-bl-xl tracking-wider">
                                                POPULAR
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <h3 class="text-xl font-bold text-white mb-2 transition
                                        {{ $comm->is_nsfw ? 'group-hover:text-red-400' : 'group-hover:text-pink-300' }}">
                                        {{ $comm->title }}
                                    </h3>

                                    <p class="text-gray-300 text-sm mb-4 line-clamp-2 flex-grow">
                                        {{ $comm->description }}
                                    </p>
                                    <p class="text-xs text-white/40 mb-4 flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        Entrega estimada: {{ $comm->days_to_complete }} dias
                                    </p>
                                    
                                    <div class="flex items-center justify-between mt-4 pt-4 border-t border-white/5">
                                        <div class="text-xs text-cyan-200">
                                            <span class="block text-white/40">Valor base</span>
                                            <span class="text-lg font-bold">R$ {{ number_format($comm->price, 2, ',', '.') }}</span>
                                        </div>
                                        
                                        <button class="px-4 py-2 rounded-lg font-bold transition border
                                            {{ $comm->is_nsfw 
                                                ? 'bg-red-500/20 text-red-300 border-red-500/30 hover:bg-red-600 hover:text-white' 
                                                : 'bg-pink-500/20 text-pink-300 border-pink-500/30 hover:bg-pink-500 hover:text-white' 
                                            }}">
                                            Solicitar
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <div id="tab-shop" class="tab-content hidden animate-fade-in-up">
                    @if($arts->isEmpty())
                        <div class="glass-card p-12 text-center border-dashed border-2 border-white/10 rounded-3xl">
                            <p class="text-white/60">Este artista ainda não publicou produtos na loja.</p>
                        </div>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($arts as $art)
                                <div class="glass-card overflow-hidden rounded-2xl border border-white/10 hover:border-cyan-500/50 transition duration-300 group flex flex-col">
                                    <div class="aspect-[4/3] relative overflow-hidden bg-black/20">
                                        <a href="{{ route('arts.show', $art->id) }}">
                                             @if(Str::startsWith($art->imagem_caminho, 'fake_demo'))
                                                <img src="https://picsum.photos/seed/{{ $art->id }}/600/600" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                            @else
                                                <img src="{{ asset('storage/' . $art->imagem_caminho) }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                            @endif
                                        </a>
                                        <div class="absolute top-2 right-2 bg-black/60 backdrop-blur-md text-white text-xs font-bold px-2 py-1 rounded-lg border border-white/10">
                                            R$ {{ number_format($art->preco, 2, ',', '.') }}
                                        </div>
                                    </div>
                                    
                                    <div class="p-4 flex flex-col flex-grow">
                                        <h3 class="text-white font-bold truncate mb-1">{{ $art->titulo }}</h3>
                                        <p class="text-cyan-200/60 text-xs mb-4">Pronta Entrega</p>
                                        
                                        <div class="mt-auto">
                                            <a href="{{ route('arts.show', $art->id) }}" class="block w-full text-center py-2 rounded-lg bg-white/5 hover:bg-white/20 text-white text-sm font-semibold transition border border-white/5">
                                                Ver Detalhes
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>

    <script>
        function switchTab(tabName) {
            // 1. Esconde todos os conteúdos
            document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
            
            // 2. Tira o estilo "ativo" de todos os botões
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('border-cyan-400', 'text-white');
                btn.classList.add('border-transparent', 'text-white/40');
            });

            // 3. Mostra o conteúdo certo
            document.getElementById('tab-' + tabName).classList.remove('hidden');
            
            // 4. Ativa o botão certo
            const btn = document.getElementById('btn-' + tabName);
            btn.classList.remove('border-transparent', 'text-white/40');
            btn.classList.add('border-cyan-400', 'text-white');
        }
    </script>

@endsection