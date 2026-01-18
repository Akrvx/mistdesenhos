<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ArtController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminController; // <--- Importante: O Controller que criamos
use App\Models\Art;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| 1. ROTAS PÚBLICAS (Acessíveis para Visitantes)
|--------------------------------------------------------------------------
*/

// Home Page (Landing Page)
Route::get('/', function () {
    $arts = Art::with('user')->latest()->take(8)->get(); 
    return view('welcome', compact('arts'));
})->name('welcome');

// Perfil Público do Artista
Route::get('/artista/{user}', [ArtController::class, 'artist'])->name('artist.show');

// Detalhes da Arte
Route::get('/art/{art}', [ArtController::class, 'show'])->name('arts.show');


/*
|--------------------------------------------------------------------------
| 2. ROTAS DE ADMINISTRAÇÃO (Login Secreto)
|--------------------------------------------------------------------------
| URL personalizada (/staff-duckly) para segurança por obscuridade.
*/

// Tela de Login
Route::get('/staff-duckly', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');

// Processar Login
Route::post('/staff-duckly', [AdminAuthController::class, 'login'])->name('admin.login.submit');

// Logout do Admin
Route::post('/staff-duckly/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');


/*
|--------------------------------------------------------------------------
| 3. ÁREA RESTRITA DO ADMINISTRADOR
|--------------------------------------------------------------------------
| Protegido pelo middleware 'admin'. A URL base é /staff-duckly.
*/
    Route::middleware(['auth', 'admin'])->prefix('staff-duckly')->group(function () {
    
    // Dashboard (Lógica movida para o AdminController@index)
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // Rota para Banir/Deletar Arte (Nova funcionalidade)
    Route::delete('/artes/{id}/banir', [AdminController::class, 'destroyArt'])->name('admin.arts.ban');

    // --- NOVO: USUÁRIOS ---
    Route::get('/usuarios', [AdminController::class, 'users'])->name('admin.users');
    Route::delete('/usuarios/{id}/banir', [AdminController::class, 'destroyUser'])->name('admin.users.ban');

    // --- NOVO: ARTES & MODERAÇÃO ---
    Route::get('/artes', [AdminController::class, 'arts'])->name('admin.arts');

    // Configurações
    Route::get('/configuracoes', [AdminController::class, 'settings'])->name('admin.settings');
    Route::post('/configuracoes', [AdminController::class, 'updateSettings'])->name('admin.settings.update');
    

});


/*
|--------------------------------------------------------------------------
| 4. ROTAS DO USUÁRIO LOGADO (O Marketplace)
|--------------------------------------------------------------------------
| Tudo aqui exige login comum.
*/
Route::middleware(['auth', 'verified'])->group(function () {

    // --- NAVEGAÇÃO GERAL ---
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/feed', [ArtController::class, 'feed'])->name('feed');

    // --- ÁREA DO ARTISTA (VENDAS & VITRINE) ---
    Route::get('/vender', [ArtController::class, 'create'])->name('arts.create');
    Route::post('/vender', [ArtController::class, 'store'])->name('arts.store');
    
    // Gerenciar Vitrine
    Route::get('/minha-vitrine/editar', [ArtController::class, 'editShowcase'])->name('showcase.edit');
    Route::post('/minha-vitrine/atualizar', [ArtController::class, 'updateShowcase'])->name('showcase.update');

    // --- ECONOMIA (CARTEIRA & COMPRAS) ---
    Route::get('/carteira', [WalletController::class, 'index'])->name('wallet.index');
    Route::post('/carteira/adicionar', [WalletController::class, 'addFunds'])->name('wallet.add');
    Route::post('/comprar/{art}', [WalletController::class, 'purchase'])->name('art.purchase');

    // --- CONFIGURAÇÕES DA CONTA ---
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Rotas de Autenticação Padrão
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';