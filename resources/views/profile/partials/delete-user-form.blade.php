<section class="space-y-6">
    <header>
        <h2 class="text-lg font-bold text-red-400">
            Deletar Conta
        </h2>
        <p class="mt-1 text-sm text-white/60">
            Depois que sua conta for excluída, todos os seus recursos e dados serão excluídos permanentemente.
        </p>
    </header>

    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="bg-red-500/10 hover:bg-red-500/20 text-red-400 border border-red-500/30 font-bold py-2 px-6 rounded-xl transition"
    >
        Deletar Conta
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6 bg-[#0f172a] border border-white/20 text-white">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-white">
                Tem certeza que deseja deletar sua conta?
            </h2>

            <p class="mt-1 text-sm text-gray-300">
                Uma vez deletada, não há volta. Por favor, digite sua senha para confirmar.
            </p>

            <div class="mt-6">
                <label for="password" class="sr-only">Senha</label>

                <input
                    id="password"
                    name="password"
                    type="password"
                    class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-red-500"
                    placeholder="Sua senha"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2 text-red-400" />
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <button type="button" x-on:click="$dispatch('close')" class="bg-white/10 hover:bg-white/20 text-white py-2 px-4 rounded-lg transition">
                    Cancelar
                </button>

                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg transition shadow-lg">
                    Deletar Conta
                </button>
            </div>
        </form>
    </x-modal>
</section>