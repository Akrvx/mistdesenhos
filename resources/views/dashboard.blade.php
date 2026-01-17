@extends('layouts.site')

@section('content')
    <div class="py-12 px-4 max-w-7xl mx-auto">
        
        <div class="flex flex-col md:flex-row justify-between items-center mb-10 glass-card p-8 rounded-3xl border border-white/10">
            <div>
                <h2 class="text-3xl font-bold text-white mb-2">Hi, {{ Auth::user()->name }}!</h2>
                
                @if(Auth::user()->is_artist)
                    <p class="text-cyan-200">Manage your works here.</p>
                @else
                    <p class="text-cyan-200">Welcome to the lake. You are sailing as Collector.</p>
                @endif
            </div>
            
            <div class="mt-4 md:mt-0 flex gap-4">
                
                <a href="{{ route('feed') }}" class="px-5 py-3 rounded-xl border border-white/30 text-white hover:bg-white/10 transition flex items-center gap-2 font-semibold">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Back to Feed
                </a>

                @if(Auth::user()->is_artist)
                    <a href="{{ route('arts.create') }}" class="bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-400 hover:to-blue-500 text-white font-bold py-3 px-6 rounded-xl shadow-lg transition flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        New Art
                    </a>
                @endif
            </div>
        </div>

        @if(Auth::user()->is_artist)
            
            <h3 class="text-xl font-bold text-white mb-6 pl-2 border-l-4 border-cyan-400">My Works on the Lake</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse(Auth::user()->arts as $art)
                    <div class="glass-card group rounded-xl overflow-hidden hover:border-cyan-400/50 transition duration-300">
                        <div class="aspect-square relative overflow-hidden">
                            <img src="{{ asset('storage/' . $art->imagem_caminho) }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        </div>
                        <div class="p-4">
                            <h4 class="font-bold text-white truncate">{{ $art->titulo }}</h4>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-12 text-center bg-white/5 rounded-3xl border border-dashed border-white/20">
                        <p class="text-gray-300">You haven't posted any art yet.</p>
                    </div>
                @endforelse
            </div>

        @else

            <div class="glass-card p-12 text-center border border-white/10 rounded-3xl">
                <h3 class="text-2xl font-bold text-white mb-4">Become a Creator</h3>
                <p class="text-cyan-200 mb-8 max-w-lg mx-auto">You still can't sell art. Do you want to open your studio on the lake and start selling your creations?</p>
                
                <button class="bg-white text-blue-900 font-bold py-3 px-8 rounded-full hover:bg-cyan-100 transition shadow-[0_0_20px_rgba(255,255,255,0.3)]">
                    I want to become an Artist Now
                </button>
            </div>

        @endif

    </div>
@endsection