<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Art;
use App\Models\User;
use App\Models\Setting;
use App\Models\Withdrawal;



class WalletController extends Controller
{
    // 1. Mostrar a Carteira
    public function index()
    {
        return view('wallet.index');
    }

    // 2. Adicionar Fundos
    public function addFunds(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:10',
        ]);

        /** @var User $user */ // <--- ISSO RESOLVE O VERMELHO
        $user = Auth::user();
        
        $user->wallet_balance += $request->amount;
        $user->save();

        return redirect()->back()->with('success', 'Recarga realizada! Suas moedas caíram na conta.');
    }

    // 3. Solicitar Saque
    public function requestWithdrawal(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:10',
            'account_details' => 'required|string|max:255',
            'method' => 'required|in:pix,paypal',
        ]);

        /** @var User $user */ // <--- AQUI TAMBÉM
        $user = Auth::user();
        $amount = $request->amount;

        if ($user->wallet_balance < $amount) {
            return back()->with('error', 'Saldo insuficiente.');
        }

        Withdrawal::create([
            'user_id' => $user->id,
            'amount' => $amount,
            'account_details' => $request->account_details,
            'method' => $request->method,
            'status' => 'pending',
        ]);

        $user->wallet_balance -= $amount;
        $user->save();

        return back()->with('success', 'Solicitação enviada! Aguarde a aprovação.');
    }

    // 4. COMPRAR UMA ARTE
    public function purchase(Art $art)
    {
        /** @var User $comprador */ // <--- E AQUI
        $comprador = Auth::user();
        
        $artista = $art->user;

        if ($comprador->id === $artista->id) {
            return redirect()->back()->with('error', 'Você não pode comprar sua própria arte!');
        }

        if ($comprador->wallet_balance < $art->preco) {
            return redirect()->route('wallet.index')->with('error', 'Saldo insuficiente. Recarregue sua carteira!');
        }

        // 1. Busca taxa
        $taxaPorcentagem = Setting::where('key', 'commission_rate')->value('value') ?? 0;
        
        // 2. Calcula retenção
        $valorTaxa = $art->preco * ($taxaPorcentagem / 100);
        
        // 3. Calcula líquido
        $valorLiquido = $art->preco - $valorTaxa;

        // --- A TRANSAÇÃO ---

        $comprador->wallet_balance -= $art->preco;
        $comprador->save();

        $artista->wallet_balance += $valorLiquido;
        $artista->total_sales += 1;
        $artista->reputation += 10; 
        $artista->save();
        
        return redirect()->route('dashboard')->with('success', "Parabéns! Você adquiriu a obra '{$art->titulo}'!");
    }
}