@extends('layouts.site')

@section('content')
<div class="py-12 px-4 flex justify-center items-center min-h-[80vh]">
    
    <div class="max-w-2xl w-full">
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-white mb-2">Mergulhar Nova Arte</h1>
            <p class="text-cyan-200">Preencha os detalhes para exibir sua obra no lago.</p>
        </div>

        <div class="glass-card p-8 rounded-3xl border border-white/10 shadow-2xl relative overflow-hidden">
            
            <div class="absolute -top-20 -right-20 w-64 h-64 bg-cyan-500/20 rounded-full blur-3xl pointer-events-none"></div>

            <form action="{{ route('arts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 relative z-10">
                @csrf

                <div class="space-y-2">
                    <label class="block text-cyan-100 font-bold mb-1">A Obra (Imagem)</label>
                    
                    <div class="relative w-full h-64 border-2 border-dashed border-cyan-400/30 rounded-xl hover:bg-white/5 transition flex flex-col justify-center items-center cursor-pointer group overflow-hidden" id="upload-box">
                        
                        <input type="file" name="imagem" id="imagem" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-20" onchange="previewImage(event)" required>
                        
                        <div class="text-center p-4 group-hover:scale-105 transition duration-300" id="placeholder">
                            <svg class="w-12 h-12 text-cyan-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <p class="text-cyan-100 font-semibold">Clique para selecionar</p>
                            <p class="text-xs text-cyan-200/60">JPG, PNG ou GIF (Max 2MB)</p>
                        </div>

                        <img id="preview" class="absolute inset-0 w-full h-full object-cover hidden z-10 rounded-xl" />
                    </div>
                    @error('imagem') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="titulo" class="block text-cyan-100 font-bold mb-2">Título da Obra</label>
                        <input type="text" name="titulo" id="titulo" placeholder="Ex: Ocaso Cibernético" 
                            class="w-full bg-white/10 border border-white/20 rounded-lg px-4 py-3 text-white placeholder-white/30 focus:outline-none focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 transition" required>
                    </div>

                    <div>
                        <label for="category" class="block text-cyan-100 font-bold mb-2">Categoria</label>
                        <select name="category" id="category" 
                            class="w-full bg-white/10 border border-white/20 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 transition [&>option]:bg-gray-900">
                            <option value="Digital">Arte Digital</option>
                            <option value="Pintura">Pintura Tradicional</option>
                            <option value="3D">Modelagem 3D</option>
                            <option value="Fotografia">Fotografia</option>
                            <option value="Pixel Art">Pixel Art</option>
                            <option value="IA">Inteligência Artificial</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label for="preco" class="block text-cyan-100 font-bold mb-2">Valor do Investimento (R$)</label>
                    <div class="relative">
                        <span class="absolute left-4 top-3 text-cyan-200 font-bold">R$</span>
                        <input type="number" name="preco" id="preco" step="0.01" placeholder="0,00" 
                            class="w-full bg-white/10 border border-white/20 rounded-lg pl-12 pr-4 py-3 text-white placeholder-white/30 focus:outline-none focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 transition" required>
                    </div>
                </div>

                <div>
                    <label for="descricao" class="block text-cyan-100 font-bold mb-2">História da Obra</label>
                    <textarea name="descricao" id="descricao" rows="4" placeholder="Conte um pouco sobre a inspiração..." 
                        class="w-full bg-white/10 border border-white/20 rounded-lg px-4 py-3 text-white placeholder-white/30 focus:outline-none focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 transition"></textarea>
                </div>

                <div class="flex items-center justify-end gap-4 pt-4 border-t border-white/10">
                    <a href="{{ route('dashboard') }}" class="text-cyan-200 hover:text-white transition font-semibold">Cancelar</a>
                    
                    <button type="submit" class="bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-400 hover:to-blue-500 text-white font-bold py-3 px-8 rounded-full shadow-lg shadow-cyan-500/30 transform hover:-translate-y-1 transition">
                        Publicar Arte
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function(){
            const output = document.getElementById('preview');
            output.src = reader.result;
            output.classList.remove('hidden'); // Mostra a imagem
            document.getElementById('placeholder').classList.add('hidden'); // Esconde o texto
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection