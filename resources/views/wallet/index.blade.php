@extends('layouts.site')

@section('content')
<div class="pt-32 pb-12 px-4 max-w-4xl mx-auto">
    
    <div class="text-center mb-10">
        <h1 class="text-4xl font-bold text-white mb-2">Minha Carteira</h1>
        <p class="text-cyan-200">Gerencie suas moedas do lago.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        
        <div class="glass-card p-8 rounded-3xl border border-white/20 relative overflow-hidden">
            <div class="absolute -top-20 -right-20 w-64 h-64 bg-cyan-500/20 rounded-full blur-3xl"></div>
            
            <p class="text-cyan-200 font-bold mb-2 uppercase tracking-widest text-xs">Saldo Atual</p>
            <div class="flex items-center gap-3 mb-6">
                <span class="text-5xl">🪙</span>
                <span class="text-6xl font-bold text-white">{{ number_format(Auth::user()->wallet_balance, 2, ',', '.') }}</span>
            </div>
            <p class="text-white/60 text-sm">Use suas moedas para adquirir obras exclusivas de artistas independentes.</p>
        </div>

        <div class="glass-card p-8 rounded-3xl border border-white/20">
            <h3 class="text-2xl font-bold text-white mb-6">Adicionar Moedas</h3>
            
            <form action="{{ route('wallet.add') }}" method="POST" class="space-y-4">
                @csrf
                
                <div>
                    <label class="block text-cyan-100 font-bold mb-2">Quanto deseja recarregar?</label>
                    <div class="grid grid-cols-3 gap-3 mb-4">
                        <button type="button" onclick="setAmount(50)" class="bg-white/5 hover:bg-cyan-500/50 border border-white/10 text-white py-2 rounded-xl transition">50</button>
                        <button type="button" onclick="setAmount(100)" class="bg-white/5 hover:bg-cyan-500/50 border border-white/10 text-white py-2 rounded-xl transition">100</button>
                        <button type="button" onclick="setAmount(500)" class="bg-white/5 hover:bg-cyan-500/50 border border-white/10 text-white py-2 rounded-xl transition">500</button>
                    </div>

                    <input type="number" name="amount" id="amount" placeholder="Ou digite um valor..." class="w-full bg-white/10 border border-white/20 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-cyan-400" required min="10">
                </div>

                <button type="submit" class="w-full bg-gradient-to-r from-green-400 to-emerald-600 hover:from-green-500 hover:to-emerald-700 text-white font-bold py-3 rounded-xl shadow-lg transition transform hover:scale-[1.02]">
                    Confirmar Recarga 💳
                </button>
                <p class="text-xs text-center text-white/40 mt-2">Ambiente seguro simulado.</p>
            </form>
        </div>
    </div>
</div>

<script>
    function setAmount(val) {
        document.getElementById('amount').value = val;
    }
</script>
@endsection