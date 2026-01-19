@extends('layouts.site')

@section('content')
<div class="min-h-screen pt-32 pb-12">
    <div class="max-w-6xl mx-auto px-4">
        
        <h1 class="text-3xl font-bold text-white mb-8">Gerenciador de Encomendas</h1>

        <div class="grid grid-cols-1 {{ Auth::user()->is_artist ? 'md:grid-cols-2' : 'max-w-3xl mx-auto' }} gap-8">

            <div>
                <h2 class="text-xl font-bold text-cyan-400 mb-4 flex items-center gap-2">
                    <span>📤</span> Pedidos Enviados
                </h2>

                @if($myRequests->isEmpty())
                    <div class="glass-card p-6 rounded-2xl text-center text-slate-500">
                        Você ainda não encomendou nada.
                    </div>
                @else
                    <div class="space-y-4">
                        @foreach($myRequests as $req)
                            <div class="glass-card p-5 rounded-2xl border border-white/5 relative overflow-hidden group">
                                <div class="flex justify-between items-start mb-2">
                                    <h3 class="text-white font-bold">Para: {{ $req->artist->name }}</h3>
                                    
                                    @if($req->status == 'pending')
                                        <span class="bg-yellow-500/20 text-yellow-400 text-xs px-2 py-1 rounded font-bold border border-yellow-500/30">PENDENTE</span>
                                    @elseif($req->status == 'accepted')
                                        <span class="bg-blue-500/20 text-blue-400 text-xs px-2 py-1 rounded font-bold border border-blue-500/30">ACEITO - A PAGAR</span>
                                    @elseif($req->status == 'active')
                                        <span class="bg-purple-500/20 text-purple-400 text-xs px-2 py-1 rounded font-bold border border-purple-500/30 animate-pulse">EM ANDAMENTO</span>
                                    @elseif($req->status == 'completed')
                                        <span class="bg-green-500/20 text-green-400 text-xs px-2 py-1 rounded font-bold border border-green-500/30">CONCLUÍDO</span>
                                    @else
                                        <span class="bg-red-500/20 text-red-400 text-xs px-2 py-1 rounded font-bold border border-red-500/30">RECUSADO</span>
                                    @endif
                                </div>
                                
                                <p class="text-slate-400 text-sm mb-3 line-clamp-2">"{{ $req->description }}"</p>
                                
                                @if($req->prazo_desejado)
                                    <p class="text-xs text-slate-500">Prazo: {{ \Carbon\Carbon::parse($req->prazo_desejado)->format('d/m/Y') }}</p>
                                @endif

                                @if($req->status == 'accepted')
                                    <div class="mt-4 pt-4 border-t border-white/10 flex justify-between items-center">
                                        <span class="text-white font-bold">Valor: 🪙 {{ $req->price }}</span>
                                        <form action="{{ route('commissions.pay', $req->id) }}" method="POST" onsubmit="return confirm('Pagar {{ $req->price }} moedas?')">
                                            @csrf
                                            <button class="bg-green-600 hover:bg-green-500 text-white px-4 py-2 rounded-lg text-xs font-bold transition shadow-lg animate-pulse">
                                                Pagar Agora
                                            </button>
                                        </form>
                                    </div>
                                @elseif($req->status == 'active')
                                    <div class="mt-4 pt-4 border-t border-white/10 text-center">
                                        <span class="text-purple-300 text-xs font-bold">
                                            🎨 Artista trabalhando...
                                        </span>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            @if(Auth::user()->is_artist)
                <div>
                    <h2 class="text-xl font-bold text-purple-400 mb-4 flex items-center gap-2">
                        <span>📥</span> Pedidos Recebidos
                    </h2>

                    @if($receivedOrders->isEmpty())
                        <div class="glass-card p-6 rounded-2xl text-center text-slate-500">
                            Nenhum pedido na sua caixa de entrada.
                        </div>
                    @else
                        <div class="space-y-4">
                            @foreach($receivedOrders as $order)
                                <div class="glass-card p-5 rounded-2xl border border-white/5 relative">
                                    <div class="flex justify-between items-start mb-2">
                                        <div class="flex items-center gap-2">
                                            <div class="w-6 h-6 rounded-full bg-slate-700 flex items-center justify-center text-[10px] font-bold text-white">
                                                {{ substr($order->client->name, 0, 1) }}
                                            </div>
                                            <h3 class="text-white font-bold">{{ $order->client->name }}</h3>
                                        </div>
                                        <span class="text-xs text-slate-500">{{ $order->created_at->diffForHumans() }}</span>
                                    </div>

                                    <div class="bg-black/30 p-3 rounded-lg text-slate-300 text-sm mb-4 border border-white/5">
                                        {{ $order->description }}
                                    </div>

                                    @if($order->status == 'pending')
                                        <form action="{{ route('commissions.update-status', $order->id) }}" method="POST" class="space-y-3">
                                            @csrf
                                            @method('PATCH')
                                            
                                            <div class="grid grid-cols-2 gap-3">
                                                <div>
                                                    <label class="text-[10px] uppercase font-bold text-slate-500">Preço (Moedas)</label>
                                                    <input type="number" name="price" placeholder="Ex: 500" required class="w-full bg-slate-900 border border-slate-700 rounded px-3 py-2 text-white text-sm focus:border-purple-500 outline-none mt-1">
                                                </div>
                                                <div>
                                                    <label class="text-[10px] uppercase font-bold text-slate-500">Prazo</label>
                                                    <input type="date" name="prazo_desejado" required class="w-full bg-slate-900 border border-slate-700 rounded px-3 py-2 text-white text-sm focus:border-purple-500 outline-none mt-1">
                                                </div>
                                            </div>

                                            <div class="flex gap-2">
                                                <button type="submit" name="status" value="accepted" class="flex-1 bg-green-600 hover:bg-green-500 text-white py-2 rounded-lg text-xs font-bold transition">
                                                    ✅ Aceitar
                                                </button>
                                                <button type="submit" name="status" value="rejected" formnovalidate class="flex-1 bg-red-600/20 hover:bg-red-600/40 text-red-400 border border-red-500/30 py-2 rounded-lg text-xs font-bold transition">
                                                    ❌ Recusar
                                                </button>
                                            </div>
                                        </form>
                                    @elseif($order->status == 'accepted')
                                        <div class="text-center py-3 bg-yellow-500/10 rounded-lg border border-yellow-500/20">
                                            <p class="text-yellow-400 text-xs font-bold">⏳ Aguardando Pagamento</p>
                                            <p class="text-slate-400 text-xs mt-1">Valor: 🪙 {{ $order->price }}</p>
                                        </div>
                                    @elseif($order->status == 'active')
                                        <div class="text-center py-3 bg-purple-500/10 rounded-lg border border-purple-500/20 mb-3">
                                            <p class="text-purple-400 text-xs font-bold">💰 Pago! Trabalhe.</p>
                                        </div>
                                        <form action="{{ route('commissions.update-status', $order->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" name="status" value="completed" class="w-full bg-green-600 hover:bg-green-500 text-white py-3 rounded-lg text-sm font-bold transition shadow-lg border border-green-400/20">
                                                🎁 Marcar como Entregue
                                            </button>
                                        </form>
                                    @elseif($order->status == 'completed')
                                        <div class="text-center py-2 bg-green-500/10 rounded-lg border border-green-500/20">
                                            <span class="text-green-400 text-xs font-bold">✅ Serviço Finalizado</span>
                                        </div>
                                    @else
                                        <div class="text-center py-2 bg-red-500/10 rounded-lg border border-red-500/20">
                                            <span class="text-red-400 text-xs font-bold">Cancelado / Recusado</span>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            @endif

        </div>
    </div>
</div>
@endsection