@extends('layouts.site')

@section('content')
    <div class="pt-32 pb-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto min-h-screen">
        
        @if(session('success'))
            <div class="mb-8 bg-green-500/10 border border-green-500/20 text-green-400 px-6 py-4 rounded-2xl flex items-center gap-3 animate-fade-in-up">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                <span class="font-bold">{{ session('success') }}</span>
            </div>
        @endif

        <div class="flex flex-col md:flex-row justify-between items-end mb-10 gap-6">
            <div>
                <h2 class="text-3xl font-bold text-white mb-2">Gerenciar Vitrine</h2>
                <p class="text-cyan-200">Adicione, remova ou edite o que aparece na sua página pública.</p>
            </div>
            
            <a href="{{ route('artist.show', Auth::id()) }}" class="bg-white/10 hover:bg-white/20 text-white font-bold py-2 px-6 rounded-xl border border-white/20 transition flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                Ver Como Ficou
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="space-y-8">
                
                <div class="glass-card p-6 rounded-3xl border border-white/10">
                    <h3 class="text-xl font-bold text-white mb-4">Status da Loja</h3>
                    
                    <form action="{{ route('showcase.update') }}" method="POST" id="status-form">
                        @csrf
                        <input type="hidden" name="form_type" value="status">

                        <label class="cursor-pointer group block">
                            <input type="checkbox" name="commissions_open" value="1" class="sr-only" 
                                onchange="document.getElementById('status-form').submit()"
                                {{ $user->commissions_open ? 'checked' : '' }}>
                            
                            <div class="flex items-center justify-between p-4 rounded-xl border transition-all duration-300
                                {{ $user->commissions_open 
                                    ? 'bg-green-500/10 border-green-500/30' 
                                    : 'bg-red-500/10 border-red-500/30' 
                                }}">
                                
                                <span class="font-bold flex items-center gap-2 transition-colors
                                    {{ $user->commissions_open ? 'text-green-400' : 'text-red-400' }}">
                                    
                                    <span class="w-2 h-2 rounded-full 
                                        {{ $user->commissions_open ? 'bg-green-500 animate-pulse' : 'bg-red-500' }}">
                                    </span>
                                    
                                    <span class="status-text">
                                        {{ $user->commissions_open ? 'Comissões Abertas' : 'Fechado Temporariamente' }}
                                    </span>
                                </span>

                                <div class="w-12 h-6 rounded-full relative transition-colors duration-300 border
                                    {{ $user->commissions_open 
                                        ? 'bg-green-500/20 border-green-500/50' 
                                        : 'bg-red-500/20 border-red-500/50' 
                                    }}">
                                    
                                    <div class="absolute top-1 w-4 h-4 rounded-full shadow-lg transition-all duration-300
                                        {{ $user->commissions_open 
                                            ? 'right-1 bg-green-500' 
                                            : 'right-7 bg-red-500' 
                                        }}">
                                    </div>
                                </div>
                            </div>
                        </label>
                    </form>
                    
                    <p class="text-xs text-white/40 text-center mt-4">Clique para alternar o status.</p>
                </div>

                <div class="glass-card p-6 rounded-3xl border border-white/10">
                    <h3 class="text-xl font-bold text-white mb-4">Perfil do Artista</h3>
                    <p class="text-xs text-white/50 mb-4">Configure o que aparece na sidebar e na aba Sobre.</p>
                    
                    <form action="{{ route('showcase.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="form_type" value="profile">
                        
                        <div class="flex flex-wrap gap-2 mb-6">
                            @php
                                $allTags = ['Ilustração 2D', 'Modelagem 3D', 'Pixel Art', 'VTuber', 'Live2D', 'Rigging', 'Emotes', 'Concept Art', 'Animação', 'Design Gráfico'];
                                $myTags = $user->specialties ?? [];
                            @endphp

                            @foreach($allTags as $tag)
                                <label class="cursor-pointer">
                                    <input type="checkbox" name="specialties[]" value="{{ $tag }}" class="peer sr-only"
                                        {{ in_array($tag, $myTags) ? 'checked' : '' }}>
                                    
                                    <span class="px-3 py-1 rounded-lg border border-white/10 text-xs font-semibold transition select-none inline-block
                                        bg-white/5 text-cyan-200 
                                        peer-checked:bg-cyan-500 peer-checked:text-white peer-checked:border-cyan-400">
                                        {{ $tag }}
                                    </span>
                                </label>
                            @endforeach
                        </div>

                        <div class="mb-6 border-t border-white/10 pt-4">
                            <label class="block text-white font-bold mb-2 text-sm">Sobre Mim (Bio)</label>
                            <textarea name="bio" rows="5" class="w-full bg-white/5 border border-white/10 rounded-xl p-3 text-white focus:outline-none focus:border-cyan-400 placeholder-white/20 text-sm">{{ old('bio', $user->bio) }}</textarea>
                        </div>

                        <div class="mb-6 border-t border-white/10 pt-4 space-y-3">
                            <label class="block text-white font-bold mb-2 text-sm">Redes Sociais</label>
                            
                            <div class="flex items-center bg-white/5 border border-white/10 rounded-xl overflow-hidden px-3">
                                <span class="text-white/40 text-sm font-bold">@</span>
                                <input type="text" name="twitter" value="{{ old('twitter', $user->twitter) }}" placeholder="Twitter/X" class="w-full bg-transparent border-0 text-white focus:ring-0 text-sm py-3 px-2 placeholder-white/20">
                            </div>

                            <div class="flex items-center bg-white/5 border border-white/10 rounded-xl overflow-hidden px-3">
                                <span class="text-white/40 text-sm font-bold">@</span>
                                <input type="text" name="instagram" value="{{ old('instagram', $user->instagram) }}" placeholder="Instagram" class="w-full bg-transparent border-0 text-white focus:ring-0 text-sm py-3 px-2 placeholder-white/20">
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-white/10 hover:bg-white/20 text-white font-bold py-2 rounded-xl transition border border-white/20 hover:border-cyan-400/50">
                            Salvar Perfil
                        </button>
                    </form>
                </div>

                <div class="glass-card p-6 rounded-3xl border border-white/10">
                    <h3 class="text-xl font-bold text-white mb-4">Adicionar Novo</h3>
                    <div class="space-y-3">
                        <a href="{{ route('arts.create') }}" class="block w-full text-center py-3 rounded-xl bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-400 hover:to-blue-500 text-white font-bold shadow-lg transition">
                            + Produto (Shop)
                        </a>
                        <button class="block w-full text-center py-3 rounded-xl bg-pink-500/20 hover:bg-pink-500/30 text-pink-300 border border-pink-500/30 font-bold transition">
                            + Serviço (Comissão)
                        </button>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2 space-y-8">
                
                <div class="glass-card p-8 rounded-3xl border border-white/10">
                    <h3 class="text-2xl font-bold text-white mb-6 flex items-center gap-2">
                        🎨 Meus Serviços Ativos
                        <span class="text-sm bg-white/10 text-white/60 px-2 py-1 rounded-lg">{{ $commissions->count() }}</span>
                    </h3>

                    @if($commissions->isEmpty())
                        <div class="text-center py-10 border border-dashed border-white/10 rounded-xl">
                            <p class="text-white/40">Você não oferece nenhum serviço ainda.</p>
                        </div>
                    @else
                        <div class="space-y-4">
                            @foreach($commissions as $comm)
                                <div class="flex items-center justify-between p-4 bg-white/5 rounded-xl border border-white/5 hover:border-white/20 transition group">
                                    <div>
                                        <h4 class="text-white font-bold">{{ $comm->title }}</h4>
                                        <p class="text-cyan-200 text-sm">R$ {{ number_format($comm->price, 2, ',', '.') }} • {{ $comm->days_to_complete }} dias</p>
                                    </div>
                                    <div class="flex gap-2 opacity-50 group-hover:opacity-100 transition">
                                        <button class="p-2 hover:bg-white/10 rounded-lg text-white" title="Editar">✏️</button>
                                        <button class="p-2 hover:bg-red-500/20 rounded-lg text-red-400" title="Excluir">🗑️</button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="glass-card p-8 rounded-3xl border border-white/10">
                    <h3 class="text-2xl font-bold text-white mb-6 flex items-center gap-2">
                        🛍️ Meus Produtos (Galeria)
                        <span class="text-sm bg-white/10 text-white/60 px-2 py-1 rounded-lg">{{ $arts->count() }}</span>
                    </h3>

                    @if($arts->isEmpty())
                        <div class="text-center py-10 border border-dashed border-white/10 rounded-xl">
                            <p class="text-white/40">Sua loja está vazia.</p>
                        </div>
                    @else
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            @foreach($arts as $art)
                                <div class="flex gap-4 p-3 bg-white/5 rounded-xl border border-white/5 hover:border-white/20 transition group">
                                    <div class="w-16 h-16 rounded-lg overflow-hidden bg-black/20 flex-shrink-0">
                                         @if(Str::startsWith($art->imagem_caminho, 'fake_demo'))
                                            <img src="https://picsum.photos/seed/{{ $art->id }}/100/100" class="w-full h-full object-cover">
                                        @else
                                            <img src="{{ asset('storage/' . $art->imagem_caminho) }}" class="w-full h-full object-cover">
                                        @endif
                                    </div>
                                    
                                    <div class="flex-grow overflow-hidden">
                                        <h4 class="text-white font-bold truncate">{{ $art->titulo }}</h4>
                                        <p class="text-cyan-200 text-xs">R$ {{ number_format($art->preco, 2, ',', '.') }}</p>
                                    </div>

                                    <div class="flex flex-col gap-1 opacity-0 group-hover:opacity-100 transition">
                                        <button class="text-xs text-white hover:text-cyan-300">Editar</button>
                                        <button class="text-xs text-red-400 hover:text-red-300">Excluir</button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
@endsection