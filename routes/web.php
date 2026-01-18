<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ArtController;
use App\Http\Controllers\WalletController;
use App\Models\Art;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rotas Públicas (Acessíveis para Visitantes)
|--------------------------------------------------------------------------
*/

// Home Page
Route::get('/', function () {
    $arts = Art::with('user')->latest()->get();
    return view('welcome', compact('arts'));
})->name('home');

// Perfil Público do Artista
Route::get('/artista/{user}', [ArtController::class, 'artist'])->name('artist.show');

// Detalhes da Arte (IMPORTANTE: Faltava essa rota para o botão "Ver Detalhes")
Route::get('/art/{art}', [ArtController::class, 'show'])->name('arts.show');


/*
|--------------------------------------------------------------------------
| Rotas Privadas (Requer Login)
|--------------------------------------------------------------------------
| Tudo aqui dentro exige que o usuário esteja logado.
| Se não estiver, o Laravel redireciona para o Login automaticamente.
*/

Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Feed do Lago
    Route::get('/feed', [ArtController::class, 'feed'])->name('feed');

    // Área do Artista (Vender)
    Route::get('/vender', [ArtController::class, 'create'])->name('arts.create');
    Route::post('/vender', [ArtController::class, 'store'])->name('arts.store');

    // --- CARTEIRA E COMPRAS (Corrigido: Agora está protegido) ---
    Route::get('/carteira', [WalletController::class, 'index'])->name('wallet.index');
    Route::post('/carteira/adicionar', [WalletController::class, 'addFunds'])->name('wallet.add');
    Route::post('/comprar/{art}', [WalletController::class, 'purchase'])->name('art.purchase');

    // Configurações de Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Gestão da Vitrine
    Route::get('/minha-vitrine/editar', [ArtController::class, 'editShowcase'])->name('showcase.edit');
    Route::post('/minha-vitrine/atualizar', [ArtController::class, 'updateShowcase'])->name('showcase.update');
});

/*
|--------------------------------------------------------------------------
| Rotas de Autenticação
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';