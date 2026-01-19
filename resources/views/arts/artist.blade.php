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

                    @if($user->commissions_open)
                        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-green-500/20 text-green-400 border border-green-500/30 text-xs font-bold uppercase tracking-wider mb-6">
                            <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                            Comissões Abertas
                        </div>
                    @else
                        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-red-500/20 text-red-400 border border-red-500/30 text-xs font-bold uppercase tracking-wider mb-6">
                            <span class="w-2 h-2 rounded-full bg-red-500"></span>
                            Comissões Fechadas
                        </div>
                    @endif

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
                            
                            @if($user->commissions_open)
                                <a href="{{ route('commissions.create', $user->id) }}" class="block w-full bg-gradient-to-r from-purple-600 to-blue-600 hover:from-purple-500 hover:to-blue-500 text-white font-bold py-3 rounded-xl shadow-[0_0_15px_rgba(147,51,234,0.4)] transition transform hover:scale-105 mb-3 flex items-center justify-center gap-2">
                                    <span>✨</span> Pedir Encomenda
                                </a>
                            @else
                                <button disabled class="w-full bg-slate-700 text-slate-400 font-bold py-3 rounded-xl cursor-not-allowed opacity-50 mb-3 border border-white/5">
                                    🚫 Agenda Fechada
                                </button>
                            @endif

                            <div class="grid grid-cols-2 gap-2">
                                <button class="bg-white/5 border border-white/10 text-white font-semibold py-2 rounded-xl hover:bg-white/10 transition text-sm">
                                    Mensagem
                                </button>
                                <button class="bg-white/5 border border-white/10 text-white font-semibold py-2 rounded-xl hover:bg-white/10 transition text-sm">
                                    Seguir
                                </button>
                            </div>

                        @else
                            @if($user->is_artist)
                                <a href="{{ route('showcase.edit') }}" class="block w-full bg-cyan-600/50 border border-cyan-400/50 text-white font-bold py-3 rounded-xl hover:bg-cyan-600/70 transition shadow-[0_0_15px_rgba(8,145,178,0.3)] flex items-center justify-center gap-2">
                                    Editar Vitrine
                                </a>
                            @else
                                <div class="text-center py-2 border border-white/10 rounded-xl bg-white/5">
                                    <p class="text-slate-400 text-xs">Conta de Usuário Comum</p>
                                </div>
                            @endif
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="block w-full bg-white text-blue-900 font-bold py-3 rounded-xl hover:bg-cyan-50 transition shadow-lg">
                            Logar para Contatar
                        </a>
                    @endauth

                    <div class="flex justify-center gap-4 mt-6 text-white/40">
                        @if($user->twitter)
                            <a href="https://twitter.com/{{ $user->twitter }}" target="_blank" class="hover:text-cyan-400 transition transform hover:scale-110"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg></a>
                        @endif
                        @if($user->instagram)
                            <a href="https://instagram.com/{{ $user->instagram }}" target="_blank" class="hover:text-pink-400 transition transform hover:scale-110"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg></a>
                        @endif
                    </div>
                </div>
                
                <div class="mt-6">
                    <h4 class="text-white font-bold mb-3 text-sm uppercase tracking-wide opacity-70">Especialidades</h4>
                    <div class="flex flex-wrap gap-2">
                        @if(empty($user->specialties))
                            <p class="text-white/30 text-xs italic">Nenhuma especialidade definida.</p>
                        @else
                            @foreach($user->specialties as $tag)
                                <span class="px-3 py-1 rounded-lg bg-white/5 border border-white/10 text-xs text-cyan-200">{{ $tag }}</span>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

            <div class="flex-1 min-w-0">
                
                <div class="flex items-center gap-6 border-b border-white/10 mb-8 overflow-x-auto pb-1">
                    <button onclick="switchTab('shop')" id="btn-shop" class="tab-btn text-white font-bold border-b-2 border-cyan-400 pb-3 px-2 transition">🛍️ Shop (Vitrine)</button>
                    <button onclick="switchTab('sobre')" id="btn-sobre" class="tab-btn text-white/40 hover:text-white font-semibold pb-3 px-2 transition border-b-2 border-transparent">Sobre</button>
                    <button onclick="switchTab('reviews')" id="btn-reviews" class="tab-btn text-white/40 hover:text-white font-semibold pb-3 px-2 transition border-b-2 border-transparent">Reviews ({{ rand(5, 50) }})</button>
                </div>

                <div id="tab-shop" class="tab-content animate-fade-in-up">
                    @if($arts->isEmpty())
                        <div class="glass-card p-12 text-center border-dashed border-2 border-white/10 rounded-3xl"><p class="text-white/60">Este artista ainda não publicou produtos na loja.</p></div>
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
                                        <div class="absolute top-2 right-2 bg-black/60 backdrop-blur-md text-white text-xs font-bold px-2 py-1 rounded-lg border border-white/10 flex items-center gap-1">
                                            <span class="text-yellow-400">🪙</span> {{ number_format($art->preco, 0, ',', '.') }}
                                        </div>
                                    </div>
                                    <div class="p-4 flex flex-col flex-grow">
                                        <h3 class="text-white font-bold truncate mb-1">{{ $art->titulo }}</h3>
                                        <p class="text-cyan-200/60 text-xs mb-4">Pronta Entrega</p>
                                        <div class="mt-auto">
                                            <a href="{{ route('arts.show', $art->id) }}" class="block w-full text-center py-2 rounded-lg bg-white/5 hover:bg-white/20 text-white text-sm font-semibold transition border border-white/5">Ver Detalhes</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <div id="tab-sobre" class="tab-content hidden animate-fade-in-up">
                    <div class="glass-card p-8 rounded-3xl border border-white/10">
                        <h3 class="text-2xl font-bold text-white mb-6">Sobre o Artista</h3>
                        @if($user->bio)
                            <div class="prose prose-invert max-w-none text-gray-300 leading-relaxed whitespace-pre-line">{{ $user->bio }}</div>
                        @else
                            <div class="text-center py-10 border border-dashed border-white/10 rounded-xl"><p class="text-white/40 italic">O artista ainda não escreveu uma biografia.</p></div>
                        @endif
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8 pt-8 border-t border-white/10">
                            <div><span class="block text-cyan-400 text-xs font-bold uppercase">Membro desde</span><span class="text-white">{{ $user->created_at->format('M, Y') }}</span></div>
                            <div><span class="block text-cyan-400 text-xs font-bold uppercase">Tempo Médio de Resposta</span><span class="text-white">~4 horas</span></div>
                            <div><span class="block text-cyan-400 text-xs font-bold uppercase">Idiomas</span><span class="text-white">Português, English</span></div>
                        </div>
                    </div>
                </div>

                <div id="tab-reviews" class="tab-content hidden animate-fade-in-up">
                    <div class="glass-card p-8 rounded-3xl border border-white/10">
                        <div class="flex items-center justify-between mb-8">
                            <h3 class="text-2xl font-bold text-white">Avaliações Recentes</h3>
                            <div class="flex items-center gap-2 bg-white/5 px-4 py-2 rounded-lg"><span class="text-yellow-400 text-xl">★</span><span class="text-white font-bold text-xl">5.0</span><span class="text-white/40 text-sm">(Baseado em vendas recentes)</span></div>
                        </div>
                        <div class="space-y-6">
                            <div class="border-b border-white/5 pb-6">
                                <div class="flex justify-between items-start mb-2">
                                    <div class="flex items-center gap-3"><div class="w-10 h-10 rounded-full bg-purple-500/20 flex items-center justify-center text-purple-300 font-bold">M</div><div><h4 class="text-white font-bold text-sm">MoonWatcher</h4><p class="text-white/30 text-xs">Comprou "Ilustração Full Body"</p></div></div><span class="text-yellow-400 text-sm">★★★★★</span>
                                </div>
                                <p class="text-gray-300 text-sm">O trabalho ficou incrível! Exatamente como eu imaginei.</p>
                                <p class="text-white/20 text-xs mt-2">Postado há 2 dias</p>
                            </div>
                            <div class="border-b border-white/5 pb-6">
                                <div class="flex justify-between items-start mb-2">
                                    <div class="flex items-center gap-3"><div class="w-10 h-10 rounded-full bg-blue-500/20 flex items-center justify-center text-blue-300 font-bold">K</div><div><h4 class="text-white font-bold text-sm">Kai_Zero</h4><p class="text-white/30 text-xs">Comprou "Pack de Emotes"</p></div></div><span class="text-yellow-400 text-sm">★★★★★</span>
                                </div>
                                <p class="text-gray-300 text-sm">Entrega super rápida e qualidade absurda. Recomendo demais!</p>
                                <p class="text-white/20 text-xs mt-2">Postado há 1 semana</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        function switchTab(tabName) {
            document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('border-cyan-400', 'text-white');
                btn.classList.add('border-transparent', 'text-white/40');
            });
            const content = document.getElementById('tab-' + tabName);
            const btn = document.getElementById('btn-' + tabName);
            if(content && btn) {
                content.classList.remove('hidden');
                btn.classList.remove('border-transparent', 'text-white/40');
                btn.classList.add('border-cyan-400', 'text-white');
            }
        }
    </script>

@endsection