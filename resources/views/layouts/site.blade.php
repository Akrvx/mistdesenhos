<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Duckly - Marketplace</title>
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        /* --- EFEITO DE ÁGUA VIVA (FUNDO) --- */
        body {
            /* O gradiente base (Azul Profundo -> Ciano) */
            background: linear-gradient(180deg, #0f172a 0%, #1e3a8a 50%, #0891b2 100%);
            background-size: 400% 400%;
            min-height: 100vh;
            color: white;
            font-family: 'Segoe UI', sans-serif;
            overflow-x: hidden;
            
            /* Animação suave da cor do fundo */
            animation: oceanFlow 15s ease infinite;
        }

        @keyframes oceanFlow {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* --- BOLHAS FLUTUANTES (PARTÍCULAS) --- */
        .bubbles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1; /* Fica atrás de tudo */
            overflow: hidden;
            pointer-events: none;
        }

        .bubble {
            position: absolute;
            bottom: -100px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            opacity: 0;
            animation: rise 10s infinite ease-in;
        }

        /* Tamanhos e posições variadas das bolhas */
        .bubble:nth-child(1) { width: 40px; height: 40px; left: 10%; animation-duration: 8s; }
        .bubble:nth-child(2) { width: 20px; height: 20px; left: 20%; animation-duration: 5s; animation-delay: 1s; }
        .bubble:nth-child(3) { width: 50px; height: 50px; left: 35%; animation-duration: 10s; animation-delay: 2s; }
        .bubble:nth-child(4) { width: 80px; height: 80px; left: 50%; animation-duration: 11s; animation-delay: 0s; }
        .bubble:nth-child(5) { width: 35px; height: 35px; left: 55%; animation-duration: 6s; animation-delay: 1s; }
        .bubble:nth-child(6) { width: 45px; height: 45px; left: 65%; animation-duration: 8s; animation-delay: 3s; }
        .bubble:nth-child(7) { width: 90px; height: 90px; left: 70%; animation-duration: 12s; animation-delay: 2s; }
        .bubble:nth-child(8) { width: 25px; height: 25px; left: 80%; animation-duration: 6s; animation-delay: 2s; }
        .bubble:nth-child(9) { width: 15px; height: 15px; left: 70%; animation-duration: 5s; animation-delay: 1s; }
        .bubble:nth-child(10){ width: 90px; height: 90px; left: 25%; animation-duration: 10s; animation-delay: 4s; }

        @keyframes rise {
            0% {
                bottom: -100px;
                transform: translateX(0);
                opacity: 0;
            }
            50% {
                opacity: 0.4; /* Fica visível no meio do caminho */
            }
            100% {
                bottom: 120vh; /* Sobe até sair da tela */
                transform: translateX(-50px); /* Leve desvio para o lado */
                opacity: 0;
            }
        }

        /* --- GLASSMORPHISM (NAVBAR & CARDS) --- */
        .glass-card {
            background: rgba(255, 255, 255, 0.1); /* Mais transparente para ver a água */
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 16px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        }

        /* Animações e Utilitários */
        .animate-fade-in-up { animation: fadeInUp 1s ease-out; }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translate3d(0, 40px, 0); }
            to { opacity: 1; transform: translate3d(0, 0, 0); }
        }
    </style>
</head>
<body class="relative">

    <div class="bubbles">
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
    </div>

    <nav class="glass-card fixed top-4 left-4 right-4 z-50 px-6 py-4 flex justify-between items-center transition-all duration-300">
        <a href="/" class="text-2xl font-bold tracking-widest text-cyan-100 hover:text-white transition">
            Duck<span class="text-white">ly</span>
        </a>

        <div class="flex items-center space-x-6">
            @if (Route::has('login'))
                @auth
                    <a href="{{ route('dashboard') }}" class="text-cyan-100 hover:text-white font-semibold transition">
                            Dashboard
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="bg-red-500/10 hover:bg-red-500/30 text-red-200 px-4 py-2 rounded-full font-bold text-sm transition border border-red-500/20">
                            Sair
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-cyan-200 hover:text-white font-semibold transition tracking-wide">
                        Log in
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="bg-cyan-500 hover:bg-cyan-600 text-white px-6 py-2 rounded-full font-bold shadow-[0_0_15px_rgba(6,182,212,0.5)] hover:shadow-[0_0_25px_rgba(6,182,212,0.8)] transform hover:-translate-y-0.5 transition duration-300">
                            Register
                        </a>
                    @endif
                @endauth
            @endif
        </div>
    </nav>

    <main class="{{ Request::is('/') ? 'w-full' : 'pt-28 pb-20 px-4 container mx-auto' }}">
        @yield('content')
    </main>

    <style>
        /* CSS Tremor para quando arrastar */
        @keyframes shake {
            0% { transform: translate(1px, 1px) rotate(0deg); }
            10% { transform: translate(-1px, -2px) rotate(-1deg); }
            20% { transform: translate(-3px, 0px) rotate(1deg); }
            30% { transform: translate(3px, 2px) rotate(0deg); }
            40% { transform: translate(1px, -1px) rotate(1deg); }
            50% { transform: translate(-1px, 2px) rotate(-1deg); }
            60% { transform: translate(-3px, 1px) rotate(0deg); }
            70% { transform: translate(3px, 1px) rotate(-1deg); }
            80% { transform: translate(-1px, -1px) rotate(1deg); }
            90% { transform: translate(1px, 2px) rotate(0deg); }
            100% { transform: translate(1px, -2px) rotate(-1deg); }
        }
        .shaking {
            animation: shake 0.5s;
            animation-iteration-count: infinite;
        }
    </style>

    <div id="pato-container" class="fixed bottom-10 z-50 cursor-grab select-none touch-none" style="left: -100px; transition: left 3s linear;">
        <img id="img-pato-visual" src="{{ asset('img/pato.gif') }}" alt="Pato Mascote" class="w-20 drop-shadow-lg pointer-events-none transition-transform duration-300">
        
        <div id="balao" class="hidden absolute -top-20 -right-16 bg-white text-blue-900 font-bold px-4 py-2 rounded-2xl shadow-[0_0_15px_rgba(0,255,255,0.5)] border-2 border-cyan-400 whitespace-nowrap text-sm z-50
        after:content-[''] after:absolute after:top-full after:left-6 after:border-[8px] after:border-transparent after:border-t-cyan-400">
            Hey! Let me go!
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const patoContainer = document.getElementById('pato-container');
            const balao = document.getElementById('balao');
            const imgPatoTag = document.getElementById('img-pato-visual');
            
            const gifAndando = "{{ asset('img/pato.gif') }}";
            const gifArrastando = "{{ asset('img/pato-dragging.gif') }}"; // Mudei para .gif conforme conversamos

            let isDragging = false;
            let startX, startY, initialLeft, initialTop;
            let autoMoveTimer;
            let reclamacoes = [
                "Hey! UNHAND ME, human!", "Where are you taking me?!", "I have fear of heights! Quack!",
                "HELP! I'm being ducknapped!", "Put me down right now!", "Does your mother know you do this?"
            ];

            function moverPatoSozinho() {
                if (isDragging) return;
                imgPatoTag.src = gifAndando;
                imgPatoTag.classList.remove('shaking');
                patoContainer.style.transition = "left 3s linear, top 1s ease";

                const larguraTela = window.innerWidth;
                const novaPosicao = Math.random() * (larguraTela - 100);
                
                const posicaoAtual = parseFloat(patoContainer.style.left || 0);
                if (novaPosicao > posicaoAtual) {
                    imgPatoTag.style.transform = "scaleX(1)"; 
                } else {
                    imgPatoTag.style.transform = "scaleX(-1)";
                }

                patoContainer.style.left = novaPosicao + 'px';
                patoContainer.style.top = ''; 
                patoContainer.style.bottom = '40px'; 
                autoMoveTimer = setTimeout(moverPatoSozinho, Math.random() * 5000 + 4000);
            }

            patoContainer.addEventListener('mousedown', iniciarArrasto);

            function iniciarArrasto(e) {
                isDragging = true;
                clearTimeout(autoMoveTimer);
                patoContainer.style.transition = "none";
                patoContainer.style.cursor = "grabbing";
                imgPatoTag.src = gifArrastando;
                // imgPatoTag.classList.add('shaking'); // Se o GIF já mexe, pode comentar essa linha
                imgPatoTag.style.transform = "scaleX(1)"; 

                startX = e.clientX;
                startY = e.clientY;
                const rect = patoContainer.getBoundingClientRect();
                initialLeft = rect.left;
                initialTop = rect.top;
                falarAlgo();

                document.addEventListener('mousemove', arrastar);
                document.addEventListener('mouseup', pararArrasto);
            }

            function arrastar(e) {
                if (!isDragging) return;
                const dx = e.clientX - startX;
                const dy = e.clientY - startY;
                patoContainer.style.left = `${initialLeft + dx}px`;
                patoContainer.style.top = `${initialTop + dy}px`;
                patoContainer.style.bottom = 'auto';
            }

            function pararArrasto() {
                isDragging = false;
                patoContainer.style.cursor = "grab";
                document.removeEventListener('mousemove', arrastar);
                document.removeEventListener('mouseup', pararArrasto);
                balao.classList.add('hidden');
                autoMoveTimer = setTimeout(moverPatoSozinho, 1500);
            }

            function falarAlgo() {
                const frase = reclamacoes[Math.floor(Math.random() * reclamacoes.length)];
                balao.innerText = frase;
                balao.classList.remove('hidden');
            }

            setTimeout(moverPatoSozinho, 1000);
        });
    </script>
</body>
</html>