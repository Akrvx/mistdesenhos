<?php

namespace App\Http\Controllers;

use App\Models\Art;
use App\Models\User;
use App\Models\Commission;
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
        // Validação dos dados
        $request->validate([
            'titulo' => 'required|string|max:255',
            'category' => 'required|string',
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
            'category' => $request->category,
            'descricao' => $request->descricao,
            'preco' => $request->preco,
            'imagem_caminho' => $path, 
        ]);

        // Redireciona para o Dashboard
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
        // 1. Busca as Artes (Filtro)
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

    // 6. Tela de Edição da Vitrine
    public function editShowcase()
    {
        $user = Auth::user();
        
        // Busca APENAS os produtos da loja (Arts)
        // Removemos a busca de 'commissions' pois não existem mais "Tipos de Serviço" fixos
        $arts = Art::where('user_id', $user->id)->latest()->get();

        return view('arts.edit_showcase', compact('user', 'arts'));
    }

    // 7. Atualizar a Vitrine (Status, Bio, Tags, Social)
    public function updateShowcase(Request $request)
    {
        $user = Auth::user();

        // CENÁRIO A: O usuário clicou no botão de STATUS (Aberto/Fechado)
        if ($request->input('form_type') === 'status') {
            // O checkbox só envia valor se estiver marcado. 
            // has('commissions_open') retorna true se marcado, false se não.
            $user->commissions_open = $request->has('commissions_open');
            $user->save();
            
            $status = $user->commissions_open ? 'abertas' : 'fechadas';
            return redirect()->back()->with('success', "Agenda $status com sucesso!");
        }

        // CENÁRIO B: O usuário salvou o PERFIL (Bio, Tags, Social)
        // (Verificamos se é 'profile' ou se não tem tipo, pra garantir)
        if ($request->input('form_type') === 'profile' || !$request->has('form_type')) {
            $request->validate([
                'specialties' => 'array',
                'specialties.*' => 'string',
                'bio' => 'nullable|string|max:1000',
                'twitter' => 'nullable|string|max:255',
                'instagram' => 'nullable|string|max:255',
            ]);

            $user->specialties = $request->input('specialties', []);
            $user->bio = $request->input('bio');
            
            // Limpa o @ se o usuário digitar
            $user->twitter = str_replace('@', '', $request->input('twitter'));
            $user->instagram = str_replace('@', '', $request->input('instagram'));
            
            $user->save();
            
            return redirect()->route('showcase.edit')->with('success', 'Perfil atualizado com sucesso!');
        }

        return redirect()->back();
    }
}