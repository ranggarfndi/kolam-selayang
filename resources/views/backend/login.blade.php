@extends('layouts.main')
@section('title', 'Login Admin - Kolam Selayang')

@section('content')
<div class="relative min-h-[80vh] flex items-center justify-center p-4 overflow-hidden">
    
    <div class="absolute inset-0 z-0 overflow-hidden pointer-events-none">
        <div class="absolute top-1/4 -right-20 w-96 h-96 bg-primary-400 rounded-full blur-[120px] opacity-20"></div>
        <div class="absolute bottom-1/4 -left-20 w-96 h-96 bg-sky-500 rounded-full blur-[120px] opacity-20"></div>
    </div>

    <div class="relative z-10 bg-white/90 backdrop-blur-xl p-8 sm:p-12 rounded-[2.5rem] shadow-2xl shadow-primary-900/10 border border-white/50 w-full max-w-lg transform hover:-translate-y-1 transition-transform duration-500">
        
        <div class="text-center mb-10">
            <div class="inline-flex items-center justify-center mb-6">
                <span class="inline-flex items-center gap-1.5 bg-primary-50 text-primary-700 border border-primary-100 px-4 py-1.5 rounded-full text-[10px] font-black tracking-widest uppercase">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    Akses Khusus Administrator
                </span>
            </div>
            
            <h2 class="text-3xl font-black text-primary-950 tracking-tighter mb-2">Login Sistem</h2>
            <p class="text-gray-500 font-medium">Silakan masukkan kredensial Anda untuk mengelola Kolam Selayang.</p>
        </div>
        
        @if ($errors->any())
            <div class="bg-red-50 text-red-700 border border-red-100 p-4 rounded-2xl mb-8 text-sm font-bold flex gap-3 items-start animate-pulse">
                <svg class="w-5 h-5 text-red-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                <span>Periksa kembali Alamat Email atau Password Anda.</span>
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST" class="space-y-6">
            @csrf
            
            <div class="space-y-2">
                <label for="email" class="block text-primary-950 text-xs font-black tracking-wider uppercase ml-1">Alamat Email</label>
                <div class="relative group">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400 group-focus-within:text-primary-600 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206"></path></svg>
                    </span>
                    <input type="email" id="email" name="email" class="w-full pl-12 pr-4 py-4 bg-gray-50/50 border border-gray-200 rounded-2xl focus:outline-none focus:bg-white focus:border-primary-500 focus:ring-4 focus:ring-primary-500/10 transition-all font-medium text-gray-900 placeholder-gray-400" required placeholder="email@gmail.com" autocomplete="email" autofocus>
                </div>
            </div>
            
            <div class="space-y-2">
                <label for="password" class="block text-primary-950 text-xs font-black tracking-wider uppercase ml-1">Password</label>
                <div class="relative group">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400 group-focus-within:text-primary-600 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    </span>
                    <input type="password" id="password" name="password" class="w-full pl-12 pr-4 py-4 bg-gray-50/50 border border-gray-200 rounded-2xl focus:outline-none focus:bg-white focus:border-primary-500 focus:ring-4 focus:ring-primary-500/10 transition-all font-medium text-gray-900 placeholder-gray-400" required placeholder="••••••••" autocomplete="current-password">
                </div>
            </div>

            <button type="submit" class="w-full bg-primary-600 hover:bg-primary-700 text-white font-bold py-4 px-6 rounded-2xl transition-all duration-300 hover:-translate-y-0.5 hover:shadow-xl shadow-primary-500/30 active:scale-[0.98] mt-2 flex justify-center items-center gap-2 group">
                Masuk Ke Dashboard
                <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </button>
            
            <div class="text-center mt-6">
                <a href="{{ url('/') }}" class="text-sm font-bold text-gray-400 hover:text-primary-600 transition-colors inline-flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali ke Halaman Utama
                </a>
            </div>
        </form>
    </div>
</div>
@endsection