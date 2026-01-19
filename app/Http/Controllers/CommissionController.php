<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commission;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Setting;

class CommissionController extends Controller
{
    // 1. Mostrar formulário de pedido
    public function create(User $artist)
    {
        // Não pode encomendar de si mesmo
        if (Auth::id() === $artist->id) {
            return back()->with('error', 'Você não pode encomendar de si mesmo.');
        }

        // Verifica se o artista aceita encomendas
        if (!$artist->commissions_open) {
            return back()->with('error', 'Este artista não está aceitando encomendas no momento.');
        }

        return view('commissions.create', compact('artist'));
    }

   // 2. Salvar o pedido (CLIENTE)
    public function store(Request $request, User $artist)
    {
        $request->validate([
            'description' => 'required|string|min:20',
            // REMOVIDO: 'prazo_desejado' => 'nullable|date|after:today',
        ]);

        Commission::create([
            'client_id' => Auth::id(),
            'artist_id' => $artist->id,
            'description' => $request->description,
            'status' => 'pending', 
        ]);

        return redirect()->route('commissions.index')->with('success', 'Pedido enviado! Aguarde o orçamento do artista.');
    }

    // 3. Minhas Encomendas (Painel para ver o que pediram pra mim e o que eu pedi)
    public function index()
    {
        $user = Auth::user();

        // Encomendas que EU FIZ (Sou Cliente)
        $myRequests = Commission::where('client_id', $user->id)->latest()->get();

        // Encomendas que RECEBI (Sou Artista)
        $receivedOrders = Commission::where('artist_id', $user->id)->latest()->get();

        return view('commissions.index', compact('myRequests', 'receivedOrders'));
    }
    
    // 4. Aceitar/Rejeitar/Concluir (ARTISTA)
    public function updateStatus(Request $request, Commission $commission)
    {
        if (Auth::id() !== $commission->artist_id) {
            abort(403);
        }

        // Validação dinâmica dependendo da ação
        if ($request->status == 'accepted') {
            $request->validate([
                'price' => 'required|numeric|min:10',
                'prazo_desejado' => 'required|date|after:today', // Artista é obrigado a dar prazo
            ]);
        }

        $commission->status = $request->status;
        
        // Se estiver aceitando, salva preço e prazo
        if ($request->status == 'accepted') {
            $commission->price = $request->price;
            $commission->prazo_desejado = $request->prazo_desejado;
        }

        $commission->save();

        return back()->with('success', 'Status da encomenda atualizado.');
    }

    // 5. Pagar Encomenda (Cliente paga -> Dinheiro vai pro Artista)
    public function pay(Commission $commission)
    {
        $cliente = Auth::user();
        
        // Segurança básica
        if ($cliente->id !== $commission->client_id) {
            abort(403, 'Este pedido não é seu.');
        }

        if ($commission->status !== 'accepted') {
            return back()->with('error', 'Esta encomenda não está aguardando pagamento.');
        }

        // Verifica Saldo
        if ($cliente->wallet_balance < $commission->price) {
            return redirect()->route('wallet.index')->with('error', 'Saldo insuficiente. Recarregue sua carteira!');
        }

        // --- TRANSAÇÃO (Igual à compra de arte) ---
        
        // 1. Pega a taxa do admin
        $taxaPorcentagem = Setting::where('key', 'commission_rate')->value('value') ?? 0;
        $valorTaxa = $commission->price * ($taxaPorcentagem / 100);
        $valorLiquido = $commission->price - $valorTaxa;

        // 2. Cobra do Cliente
        $cliente->wallet_balance -= $commission->price;
        $cliente->save();

        // 3. Paga ao Artista
        $artista = $commission->artist;
        $artista->wallet_balance += $valorLiquido;
        $artista->save();

        // 4. Atualiza status para 'active' (Em andamento/Pago)
        $commission->status = 'active'; 
        $commission->save();

        return back()->with('success', 'Pagamento realizado! O artista pode começar a trabalhar.');
    }

}