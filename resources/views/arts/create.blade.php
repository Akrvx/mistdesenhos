@extends('layouts.site')

@section('content')
    <div class="pt-32 pb-12 px-4 sm:px-6 lg:px-8 max-w-4xl mx-auto min-h-screen">
        
        <div class="text-center mb-10">
            <h2 class="text-3xl font-bold text-white mb-2">Publicar Nova Arte</h2>
            <p class="text-cyan-200">Mostre sua obra prima para o lago.</p>
        </div>

        <div class="glass-card p-8 rounded-3xl border border-white/10 relative overflow-hidden">
            
            <div class="absolute top-0 right-0 w-64 h-64 bg-cyan-500/10 rounded-full blur-3xl pointer-events-none"></div>

            @if ($errors->any())
                <div class="mb-6 p-4 rounded-xl bg-red-500/20 border border-red-500/30 text-red-200 text-sm">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('arts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 relative z-10">
                @csrf

                <div>
                    <label for="titulo" class="block text-white font-bold mb-2 text-sm">Título da Obra</label>
                    <input type="text" name="titulo" id="titulo" required
                        class="w-full bg-white/5 border border-white/10 rounded-xl p-3 text-white focus:outline-none focus:border-cyan-400 placeholder-white/20 transition"
                        placeholder="Ex: Pato Cyberpunk 2077">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="category" class="block text-white font-bold mb-2 text-sm">Categoria</label>
                        <select name="category" id="category" required
                            class="w-full bg-white/5 border border-white/10 rounded-xl p-3 text-white focus:outline-none focus:border-cyan-400 transition [&>option]:bg-gray-900">
                            <option value="Digital">Arte Digital</option>
                            <option value="Pintura">Pintura Tradicional</option>
                            <option value="3D">Modelagem 3D</option>
                            <option value="Pixel Art">Pixel Art</option>
                            <option value="Fotografia">Fotografia</option>
                            <option value="IA">Inteligência Artificial</option>
                        </select>
                    </div>

                    <div>
                        <label for="preco" class="block text-white font-bold mb-2 text-sm">Valor do Investimento</label>
                        <div class="relative">
                            <span class="absolute left-3 top-3 text-yellow-400 text-lg">🪙</span>
                            <input type="number" name="preco" id="preco" required min="1" step="1"
                                class="w-full bg-white/5 border border-white/10 rounded-xl p-3 pl-10 text-white focus:outline-none focus:border-cyan-400 placeholder-white/20 transition"
                                placeholder="0">
                        </div>
                    </div>
                </div>

                <div>
                    <label for="descricao" class="block text-white font-bold mb-2 text-sm">Descrição / História</label>
                    <textarea name="descricao" id="descricao" rows="4"
                        class="w-full bg-white/5 border border-white/10 rounded-xl p-3 text-white focus:outline-none focus:border-cyan-400 placeholder-white/20 transition"
                        placeholder="Conte sobre o processo criativo, ferramentas usadas..."></textarea>
                </div>

                <div>
                    <label class="block text-white font-bold mb-2 text-sm">Arquivo da Arte</label>
                    <div class="relative border-2 border-dashed border-white/20 rounded-xl p-8 text-center hover:border-cyan-400/50 transition bg-white/5 group cursor-pointer">
                        <input type="file" name="imagem" id="imagem" required class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" onchange="previewImage(this)">
                        
                        <div id="upload-placeholder">
                            <div class="text-4xl mb-2 opacity-50 group-hover:scale-110 transition transform">📂</div>
                            <p class="text-white/60 text-sm font-medium">Arraste ou clique para selecionar</p>
                            <p class="text-white/30 text-xs mt-1">JPG, PNG ou GIF (Máx. 2MB)</p>
                        </div>
                        
                        <img id="image-preview" class="hidden max-h-64 mx-auto rounded-lg shadow-lg">
                    </div>
                </div>

                <div class="flex items-center justify-between bg-white/5 p-4 rounded-xl border border-white/10">
                    <div>
                        <span class="text-white font-bold text-sm block">Conteúdo Sensível (NSFW)</span>
                        <span class="text-white/40 text-xs">Marque se a arte contém nudez ou violência.</span>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_nsfw" value="1" class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-700 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-red-500 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-red-600"></div>
                    </label>
                </div>

                <div class="flex items-center gap-4 pt-4">
                    <a href="{{ url()->previous() }}" class="px-6 py-3 rounded-xl border border-white/10 text-white hover:bg-white/5 transition font-bold">
                        Cancelar
                    </a>
                    <button type="submit" class="flex-grow bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-400 hover:to-blue-500 text-white font-bold py-3 px-6 rounded-xl shadow-lg transition transform hover:-translate-y-1">
                        Publicar Arte 🎨
                    </button>
                </div>

            </form>
        </div>
    </div>

    <script>
        function previewImage(input) {
            const placeholder = document.getElementById('upload-placeholder');
            const preview = document.getElementById('image-preview');
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    placeholder.classList.add('hidden');
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection