<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    /**
     * Transforma o usuário em Artista.
     */
    public function becomeArtist(Request $request): RedirectResponse
    {
        $user = $request->user();
        
        // Ativa o modo artista e já abre as encomendas
        $user->is_artist = true;
        $user->commissions_open = true; 
        $user->save();

        return Redirect::route('dashboard')->with('success', 'Parabéns! Agora você é um Artista oficial.');
    }

    public function updateNsfw(Request $request): RedirectResponse
    {
        $user = $request->user();

        // SEGURANÇA: Só permite ativar se for maior de 18
        if ($user->age < 18) {
            return back()->with('error', 'Ação não permitida para menores de idade.');
        }

        // Se marcou o checkbox, é true. Se não, é false.
        $user->show_nsfw = $request->has('show_nsfw');
        $user->save();

        $status = $user->show_nsfw ? 'Conteúdo NSFW ativado.' : 'Conteúdo NSFW oculto.';
        return back()->with('success', $status);
    }
    
}
