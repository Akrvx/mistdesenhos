@extends('layouts.site')

@section('content')
    <div class="pt-32 pb-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto min-h-screen">
        
        <div class="mb-8">
            <h2 class="text-3xl font-bold text-white">Configurações de Perfil</h2>
            <p class="text-cyan-200">Gerencie seus dados pessoais e preferências.</p>
        </div>

        <div class="space-y-8">

            <div class="glass-card p-8 rounded-3xl border border-white/10">
                <div class="max-w-xl">
                    <h3 class="text-xl font-bold text-white mb-4">Preferências de Conteúdo</h3>
                    
                    @if($user->age >= 18)
                        <form method="post" action="{{ route('profile.update-nsfw') }}" class="flex items-center justify-between bg-white/5 p-4 rounded-xl border border-white/5">
                            @csrf
                            @method('patch')
                            
                            <div class="pr-4">
                                <p class="text-sm text-white font-bold flex items-center gap-2">
                                    Conteúdo Sensível (NSFW)
                                    <span class="text-[10px] bg-red-500 text-white px-2 py-0.5 rounded uppercase">18+</span>
                                </p>
                                <p class="text-xs text-slate-400 mt-1">
                                    Ao ativar, você confirma ter mais de 18 anos e aceita visualizar conteúdo adulto na plataforma.
                                </p>
                            </div>

                            <label class="relative inline-flex items-center cursor-pointer shrink-0">
                                <input type="checkbox" name="show_nsfw" value="1" class="sr-only peer" onchange="this.form.submit()" {{ $user->show_nsfw ? 'checked' : '' }}>
                                <div class="w-11 h-6 bg-slate-700 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-red-600 border border-white/10"></div>
                            </label>
                        </form>
                    @else
                        <div class="bg-red-500/10 border border-red-500/20 p-4 rounded-xl flex items-center gap-4">
                            <div class="text-3xl">🔞</div>
                            <div>
                                <p class="text-red-400 font-bold text-sm">Restrição de Idade</p>
                                <p class="text-white/60 text-xs mt-1">
                                    Sua conta foi identificada como menor de 18 anos ou sem data de nascimento definida ({{ $user->birth_date ? 'nascido em ' . $user->birth_date->format('d/m/Y') : 'Data não informada' }}). 
                                    O acesso a conteúdo sensível está bloqueado permanentemente de acordo com nossos termos.
                                </p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="glass-card p-8 rounded-3xl border border-white/10">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="glass-card p-8 rounded-3xl border border-white/10">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="glass-card p-8 rounded-3xl border border-red-500/30">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>
@endsection