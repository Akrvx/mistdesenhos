<?php

namespace App\Http\Controllers;

use App\Models\Art;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArtController extends Controller
{
    // 1. Mostrar o formulário de Venda (GET /vender)
    public function create()
    {
        return view('arts.create');
    }

    // 2. Salvar a Arte no Banco de Dados (POST /vender)
    public function store(Request $request)
    {
        // Validação dos dados (Adicionei a categoria aqui!)
        $request->validate([
            'titulo' => 'required|string|max:255',
            'category' => 'required|string', // --- CORREÇÃO AQUI ---
            'descricao' => 'nullable|string',
            'preco' => 'required|numeric|min:0',
            'imagem' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB
        ]);

        // Upload da Imagem
        $path = null;
        if ($request->hasFile('imagem')) {
            // Salva na pasta 'public/arts' e retorna o caminho
            $path = $request->file('imagem')->store('arts', 'public');
        }

        // Criar no Banco de Dados
        Art::create([
            'user_id' => Auth::id(), // Pega o ID do usuário logado
            'titulo' => $request->titulo,
            'category' => $request->category, // --- CORREÇÃO AQUI (Salvando no banco) ---
            'descricao' => $request->descricao,
            'preco' => $request->preco,
            'imagem_caminho' => $path, 
        ]);

        // Redireciona para o Dashboard (Onde ele vê as próprias obras)
        return redirect()->route('dashboard')->with('success', 'Sua arte foi mergulhada no lago com sucesso!');
    }

    // 3. Mostrar Detalhes de UMA Arte (GET /art/{id})
    public function show(Art $art)
    {
        // Carrega o dono da arte para mostrarmos o nome dele
        $art->load('user');
        
        return view('arts.show', compact('art'));
    }

    // 4. Vitrine do Artista (GET /artista/{id})
    public function artist(User $user)
    {
        // Carrega todas as artes desse usuário
        $arts = $user->arts()->latest()->get();
        
        return view('arts.artist', compact('user', 'arts'));
    }

    // 5. Função do FEED (Estilo Blog/Timeline)
    public function feed(Request $request)
    {
        // 1. Busca as Artes (Filtro normal que já fizemos)
        $query = Art::with('user');

        if ($request->has('categoria') && $request->categoria != 'todas') {
            $query->where('category', $request->categoria);
        }
        $arts = $query->latest()->get();

        // 2. Busca o Ranking de VENDAS (Top 5)
        $topSellers = User::where('is_artist', true)
                          ->orderByDesc('total_sales')
                          ->take(5)
                          ->get();

        // 3. Busca o Ranking de REPUTAÇÃO (Top 5)
        $topRated = User::where('is_artist', true)
                        ->orderByDesc('reputation')
                        ->take(5)
                        ->get();
        
        // Retorna tudo para a View
        return view('feed', compact('arts', 'topSellers', 'topRated'));
    }
}