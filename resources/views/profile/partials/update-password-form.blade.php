<section>
    <header>
        <h2 class="text-lg font-bold text-white">
            Atualizar Senha
        </h2>
        <p class="mt-1 text-sm text-cyan-200">
            Certifique-se de que sua conta esteja usando uma senha longa e aleatória para permanecer segura.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password" class="block font-bold text-sm text-cyan-100 mb-2">Senha Atual</label>
            <input id="update_password_current_password" name="current_password" type="password" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 transition" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 text-red-300" />
        </div>

        <div>
            <label for="update_password_password" class="block font-bold text-sm text-cyan-100 mb-2">Nova Senha</label>
            <input id="update_password_password" name="password" type="password" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 transition" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 text-red-300" />
        </div>

        <div>
            <label for="update_password_password_confirmation" class="block font-bold text-sm text-cyan-100 mb-2">Confirmar Nova Senha</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 transition" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 text-red-300" />
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-400 hover:to-blue-500 text-white font-bold py-2 px-6 rounded-xl shadow-lg transition transform hover:-translate-y-0.5">
                Salvar
            </button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-400 font-bold"
                >Salvo.</p>
            @endif
        </div>
    </form>
</section>