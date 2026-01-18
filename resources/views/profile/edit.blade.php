@extends('layouts.site')

@section('content')
    <div class="pt-32 pb-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto min-h-screen">
        
        <div class="mb-10 text-center md:text-left">
            <h2 class="text-3xl font-bold text-white mb-2">Configurações do Perfil</h2>
            <p class="text-cyan-200">Gerencie seus dados, senha e segurança.</p>
        </div>

        <div class="space-y-8">
            <div class="glass-card p-8 rounded-3xl border border-white/10 relative overflow-hidden">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="glass-card p-8 rounded-3xl border border-white/10 relative overflow-hidden">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="glass-card p-8 rounded-3xl border border-red-500/30 relative overflow-hidden">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
@endsection