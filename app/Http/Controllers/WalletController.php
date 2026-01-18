<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Art;
use App\Models\User;

class WalletController extends Controller
{
    // 1. Mostrar a Carteira
    public function index()
    {
        return view('wallet.index');
    }

    // 2. Adicionar Fundos (Simulação de compra de moedas)
    public function addFunds(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:10', // Mínimo 10 moedas
        ]);

        $user = Auth::user();
        $user->wallet_balance += $request->amount;
        $user->save();

        return redirect()->back()->with('success', 'Recarga realizada! Suas moedas caíram na conta.');
    }

    // 3. COMPRAR UMA ARTE (A Lógica Mágica)
    public function purchase(Art $art)
    {
        $comprador = Auth::user();
        $artista = $art->user; // Dono da arte

        // Regra 1: Não pode comprar a própria arte
        if ($comprador->id === $artista->id) {
            return redirect()->back()->with('error', 'Você não pode comprar sua própria arte!');
        }

        // Regra 2: Tem saldo suficiente?
        if ($comprador->wallet_balance < $art->preco) {
            return redirect()->route('wallet.index')->with('error', 'Saldo insuficiente. Recarregue sua carteira!');
        }

        // --- A TRANSAÇÃO ---
        
        // 1. Tira do Comprador
        $comprador->wallet_balance -= $art->preco;
        $comprador->save();

        // 2. Dá para o Artista
        $artista->wallet_balance += $art->preco;
        // Opcional: Aumentar vendas e reputação do artista aqui
        $artista->total_sales += 1;
        $artista->reputation += 10; // Ganha 10 pontos por venda
        $artista->save();

        // 3. (Opcional) Aqui você poderia marcar a arte como "Vendida" ou criar um registro na tabela de 'Pedidos'
        
        return redirect()->route('dashboard')->with('success', "Parabéns! Você adquiriu a obra '{$art->titulo}'!");
    }
}