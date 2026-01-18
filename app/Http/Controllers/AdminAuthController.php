<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    // 1. Mostra a tela de login exclusiva do Admin
    public function showLoginForm()
    {
        if (Auth::check() && Auth::user()->is_admin) {
            return redirect()->route('admin.dashboard');
        }
        return view('auth.admin-login');
    }

    // 2. Processa o login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (!Auth::user()->is_admin) {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Acesso negado. Esta área é restrita.',
                ]);
            }

            // CORREÇÃO AQUI:
            // Antes estava: return redirect()->intended('admin/dashboard');
            // Agora usamos o NOME da rota, que é mais seguro:
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors([
            'email' => 'As credenciais não conferem.',
        ]);
    }

// 3. Logout do Admin
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        // CORREÇÃO: Usar a rota nomeada em vez da URL fixa
        // Isso vai redirecionar automaticamente para /staff-duckly
        return redirect()->route('admin.login'); 
    }
}