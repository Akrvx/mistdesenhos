@extends('layouts.site')

@section('content')
<div class="min-h-screen pt-32 pb-12">
    <div class="max-w-2xl mx-auto px-4">
        
        <div class="text-center mb-10">
            <h1 class="text-3xl font-bold text-white mb-2">Nova Encomenda</h1>
            <p class="text-slate-400">Você está pedindo uma arte para <span class="text-cyan-400 font-bold">{{ $artist->name }}</span>.</p>
        </div>

        <div class="glass-card p-8 rounded-3xl border border-white/10 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-cyan-500/10 rounded-full blur-3xl -z-10"></div>

            <form action="{{ route('commissions.store', $artist->id) }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label class="block text-slate-300 font-bold mb-2">Descreva sua ideia</label>
                    <textarea name="description" rows="6" class="w-full bg-black/30 border border-white/10 rounded-xl p-4 text-white focus:outline-none focus:border-cyan-500 transition placeholder-slate-600" placeholder="Ex: Gostaria de um desenho do meu personagem..." required></textarea>
                </div>

                <div class="pt-4 flex gap-4">
                    <a href="{{ route('artist.show', $artist->id) }}" class="flex-1 py-4 text-center rounded-xl border border-white/10 text-white hover:bg-white/5 transition font-bold">Cancelar</a>
                    <button type="submit" class="flex-[2] py-4 bg-gradient-to-r from-cyan-600 to-blue-600 hover:from-cyan-500 hover:to-blue-500 text-white font-bold rounded-xl shadow-lg transition transform hover:scale-[1.02]">
                        Solicitar Orçamento
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection