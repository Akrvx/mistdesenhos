<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Art;
use Illuminate\Support\Facades\Storage;
use App\Models\Setting;

class AdminController extends Controller
{
    // 1. Exibir o Dashboard (Movemos a lógica do web.php para cá)
    public function index()
    {
        $totalUsers = User::count();
        $totalArtists = User::where('is_artist', true)->count();
        $totalArts = Art::count();
        $moneyCirculation = User::sum('wallet_balance');

        $latestArts = Art::with('user')->latest()->take(5)->get();
        $newUsers = User::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalUsers', 'totalArtists', 'totalArts', 
            'moneyCirculation', 'latestArts', 'newUsers'
        ));
    }

    // 2. Banir/Remover uma Arte (Nova Funcionalidade)
    public function destroyArt($id)
    {
        $art = Art::findOrFail($id);

        // Opcional: Deletar a imagem do Storage para não ocupar espaço
        if ($art->imagem_caminho && Storage::disk('public')->exists($art->imagem_caminho)) {
            Storage::disk('public')->delete($art->imagem_caminho);
        }

        $art->delete();

        return redirect()->back()->with('success', 'Arte removida com sucesso!');
    }

    // 3. Listar Usuários
    public function users()
    {
        // Pega todos os usuários, ordenados pelos mais recentes, 15 por página
        $users = User::latest()->paginate(15);
        
        return view('admin.users', compact('users'));
    }

    // 4. Banir Usuário
    public function destroyUser($id)
    {
        // Impede que você se apague (suicídio digital)
        if ($id == auth()->id()) {
            return redirect()->back()->with('error', 'Você não pode banir a si mesmo!');
        }

        $user = User::findOrFail($id);
        
        // Se quiser deletar as artes dele também, descomente abaixo:
        // $user->arts()->delete();
        
        $user->delete();

        return redirect()->back()->with('success', 'Usuário banido do sistema.');
    }

    // 5. Listar Todas as Artes (Página de Moderação)
    public function arts()
    {
        // Busca todas as artes, incluindo os dados do dono (user), ordenadas por mais recente
        // 12 por página é um bom número para grid de imagens
        $arts = Art::with('user')->latest()->paginate(12);

        return view('admin.arts', compact('arts'));
    }

    // 6. Exibir Configurações
    public function settings()
    {
        $settings = Setting::all();
        return view('admin.settings', compact('settings'));
    }

    // 7. Salvar Configurações
    public function updateSettings(Request $request)
    {
        $data = $request->except('_token');

        foreach ($data as $key => $value) {
            Setting::where('key', $key)->update(['value' => $value]);
        }

        return back()->with('success', 'Configurações atualizadas com sucesso!');
    }
    
}