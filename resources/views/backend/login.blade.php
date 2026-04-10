@extends('layouts.main')
@section('title', 'Login Admin Ke Kolam Selayang')

@section('content')
<div class="flex items-center justify-center min-h-[60vh] p-4">
    <div class="bg-white p-10 rounded-3xl shadow-lg border border-gray-100 w-full max-w-md transition-all">
        
        <div class="text-center mb-10">
            <span class="inline-flex items-center gap-1.5 bg-primary-100 border border-primary-200 text-primary-950 px-4 py-1.5 rounded-full text-xs font-bold mb-4">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                AKSES KHUSUS ADMINISTRATOR
            </span>
            <h2 class="text-3xl font-extrabold text-primary-950 tracking-tighter">Login Sistem</h2>
            <p class="text-gray-600 mt-2">Silakan masukkan akun Anda untuk mengelola kolam.</p>
        </div>
        
        @if ($errors->any())
            <div class="bg-red-50 text-red-700 border border-red-200 p-4 rounded-xl mb-6 text-sm font-medium flex gap-3 items-center">
                <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                Periksa kembali Email atau Password Anda!
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label class="block text-primary-950 text-sm font-bold mb-1.5">Alamat Email</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-gray-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206"></path></svg>
                    </span>
                    <input type="email" name="email" class="w-full pl-11 pr-4 py-3.5 border border-gray-200 rounded-xl focus:outline-none focus:border-primary-500 focus:ring-1 focus:ring-primary-100 transition" required placeholder="admin@selayang.com">
                </div>
            </div>
            
            <div>
                <label class="block text-primary-950 text-sm font-bold mb-1.5">Password</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-gray-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    </span>
                    <input type="password" name="password" class="w-full pl-11 pr-4 py-3.5 border border-gray-200 rounded-xl focus:outline-none focus:border-primary-500 focus:ring-1 focus:ring-primary-100 transition" required placeholder="••••••••">
                </div>
            </div>

            <button type="submit" class="w-full bg-primary-700 hover:bg-primary-800 text-white font-bold py-4 px-6 rounded-full transition-all duration-300 hover:scale-[1.01] hover:shadow-lg shadow-primary-200">
                Masuk Ke Dashboard
            </button>
        </form>
    </div>
</div>
@endsection