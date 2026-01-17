<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ArtController;
use Illuminate\Support\Facades\Route;
use App\Models\Art; // <--- Importante: Importar o Model

/*
|--------------------------------------------------------------------------
| Rotas Públicas
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    // Busca as artes no banco de dados
    $arts = Art::with('user')->latest()->get();

    // Passa a variável $arts para a view (corrige o erro "Undefined variable")
    return view('welcome', compact('arts'));
})->name('home');

    Route::get('/artista/{user}', [ArtController::class, 'artist'])->name('artist.show');

    Route::get('/feed', [ArtController::class, 'feed'])->name('feed');

/*
|--------------------------------------------------------------------------
| Rotas Privadas (Dashboard e Vendas)
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Vender Arte
    Route::get('/vender', [ArtController::class, 'create'])->name('arts.create');
    Route::post('/vender', [ArtController::class, 'store'])->name('arts.store');

    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Autenticação (Gerado pelo Breeze)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';