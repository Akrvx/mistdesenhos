<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Duckly') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://cdn.tailwindcss.com"></script>

        <style>
            /* --- EFEITO DE ÁGUA VIVA (FUNDO) --- */
            body {
                background: linear-gradient(180deg, #0f172a 0%, #1e3a8a 50%, #0891b2 100%);
                background-size: 400% 400%;
                min-height: 100vh;
                color: white;
                font-family: 'Figtree', sans-serif;
                animation: oceanFlow 15s ease infinite;
            }

            @keyframes oceanFlow {
                0% { background-position: 0% 50%; }
                50% { background-position: 100% 50%; }
                100% { background-position: 0% 50%; }
            }

            /* --- BOLHAS FLUTUANTES --- */
            .bubbles {
                position: fixed; top: 0; left: 0; width: 100%; height: 100%;
                z-index: -1; overflow: hidden; pointer-events: none;
            }
            .bubble {
                position: absolute; bottom: -100px;
                background-color: rgba(255, 255, 255, 0.1);
                border-radius: 50%; opacity: 0;
                animation: rise 10s infinite ease-in;
            }
            .bubble:nth-child(1) { width: 40px; height: 40px; left: 10%; animation-duration: 8s; }
            .bubble:nth-child(2) { width: 20px; height: 20px; left: 20%; animation-duration: 5s; animation-delay: 1s; }
            .bubble:nth-child(3) { width: 50px; height: 50px; left: 35%; animation-duration: 10s; animation-delay: 2s; }
            .bubble:nth-child(4) { width: 80px; height: 80px; left: 50%; animation-duration: 11s; animation-delay: 0s; }
            .bubble:nth-child(5) { width: 35px; height: 35px; left: 55%; animation-duration: 6s; animation-delay: 1s; }

            @keyframes rise {
                0% { bottom: -100px; transform: translateX(0); opacity: 0; }
                50% { opacity: 0.4; }
                100% { bottom: 120vh; transform: translateX(-50px); opacity: 0; }
            }

            /* --- CARD DE VIDRO --- */
            .glass-card {
                background: rgba(255, 255, 255, 0.1);
                backdrop-filter: blur(16px);
                -webkit-backdrop-filter: blur(16px);
                border: 1px solid rgba(255, 255, 255, 0.2);
                box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            }

            /* --- CORREÇÃO DE CORES E ESPAÇAMENTO --- */
            .glass-card .text-gray-600, 
            .glass-card .text-gray-700, 
            .glass-card .text-gray-900,
            .glass-card label,
            .glass-card span {
                color: #e0f2fe !important; /* Cyan-100 */
            }

            .glass-card a {
                color: #67e8f9 !important; /* Cyan-300 */
                text-decoration: none;
            }
            .glass-card a:hover {
                color: #ffffff !important;
                text-decoration: underline;
            }

            /* Inputs (Campos de texto) - CORREÇÃO AQUI */
            input[type="email"], input[type="password"], input[type="text"] {
                background-color: rgba(0, 0, 0, 0.2) !important;
                border: 1px solid rgba(255, 255, 255, 0.3) !important;
                color: white !important;
                border-radius: 0.5rem;
                padding-left: 1rem !important;  /* Espaço à esquerda */
                padding-right: 1rem !important; /* Espaço à direita */
            }
            input::placeholder { color: rgba(255, 255, 255, 0.5); }
            input:focus {
                background-color: rgba(0, 0, 0, 0.4) !important;
                border-color: #22d3ee !important; 
                box-shadow: 0 0 0 2px rgba(34, 211, 238, 0.5) !important;
            }

            /* Botão */
            .glass-card button {
                background-color: #06b6d4 !important;
                color: white !important;
                font-weight: bold;
                transition: transform 0.2s;
            }
            .glass-card button:hover {
                background-color: #0891b2 !important;
                transform: scale(1.02);
            }
        </style>
    </head>
    <body class="font-sans antialiased text-gray-900">
        <div class="bubbles">
            <div class="bubble"></div><div class="bubble"></div><div class="bubble"></div>
            <div class="bubble"></div><div class="bubble"></div>
        </div>

        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <div class="mb-6 animate-pulse">
                <a href="/" class="text-4xl font-bold tracking-widest text-cyan-100 hover:text-white transition drop-shadow-lg">
                    Duck<span class="text-white">ly</span>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-8 py-8 glass-card rounded-2xl overflow-hidden shadow-2xl">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>