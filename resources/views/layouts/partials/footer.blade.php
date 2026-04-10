<footer class="bg-primary-950 pt-20 pb-10 relative overflow-hidden text-white">
    <div class="absolute top-0 right-0 w-80 h-80 bg-primary-600 rounded-full blur-[100px] opacity-10 -translate-y-1/2 translate-x-1/2"></div>
    <div class="absolute bottom-0 left-0 w-64 h-64 bg-sky-600 rounded-full blur-[100px] opacity-10 translate-y-1/2 -translate-x-1/2"></div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 mb-16">
            
            <div class="lg:col-span-5 space-y-6">
                <a href="{{ url('/') }}" class="flex items-center gap-3 group">
                    <img src="{{ asset('img/logo-selayang.png') }}" alt="Logo" class="w-12 h-12 object-contain brightness-0 invert group-hover:rotate-12 transition-all duration-500">
                    <span class="text-2xl font-black tracking-tighter uppercase">
                        Kolam <span class="text-sky-400">Selayang</span>
                    </span>
                </a>
                <p class="text-primary-100/60 text-lg font-medium leading-relaxed max-w-md">
                    Pusat rekreasi dan olahraga air pilihan di Kota Medan. Berkomitmen menghadirkan fasilitas modern dengan transparansi data untuk kenyamanan Anda.
                </p>
                
                <div class="flex flex-wrap items-center gap-3">
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-2xl bg-white/5 border border-white/10 text-primary-200 text-sm font-bold">
                        <svg class="w-4 h-4 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        Jl. Dr. Mansyur, Medan Selayang
                    </div>
                    
                    <a href="https://www.instagram.com/selayangsumutswimpool/" target="_blank" rel="noopener noreferrer" title="Ikuti kami di Instagram" class="w-10 h-10 flex items-center justify-center rounded-full bg-white/5 border border-white/10 text-primary-300 hover:bg-sky-500 hover:text-white hover:scale-110 hover:rotate-12 transition-all duration-300">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                    </a>
                </div>
            </div>

            <div class="lg:col-span-3">
                <h4 class="text-xs font-black text-primary-400 uppercase tracking-[0.2em] mb-8">Navigasi Utama</h4>
                <ul class="space-y-4">
                    <li><a href="{{ url('/') }}" class="text-primary-100/70 hover:text-sky-400 font-bold transition flex items-center gap-2 group"><span class="w-1.5 h-1.5 rounded-full bg-white/20 group-hover:bg-sky-400 transition-colors"></span> Beranda</a></li>
                    <li><a href="{{ route('news.index') }}" class="text-primary-100/70 hover:text-sky-400 font-bold transition flex items-center gap-2 group"><span class="w-1.5 h-1.5 rounded-full bg-white/20 group-hover:bg-sky-400 transition-colors"></span> Berita Terbaru</a></li>
                </ul>
            </div>

            <div class="lg:col-span-4">
                <h4 class="text-xs font-black text-primary-400 uppercase tracking-[0.2em] mb-8">Jam Operasional</h4>
                <div class="space-y-4">
                    <div class="bg-white/5 p-6 rounded-[2rem] border border-white/10 group hover:border-sky-500/50 hover:bg-white/10 transition-all duration-300">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-primary-400 text-xs font-bold uppercase tracking-widest">Senin</span>
                        </div>
                        <p class="text-xl lg:text-2xl font-black text-white">{{ $jamOperasional['senin'] ?? 'Tutup' }}</p>
                    </div>
                    <div class="bg-white/5 p-6 rounded-[2rem] border border-white/10 group hover:border-sky-500/50 hover:bg-white/10 transition-all duration-300">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-primary-400 text-xs font-bold uppercase tracking-widest">Selasa — Minggu</span>
                        </div>
                        <p class="text-xl lg:text-2xl font-black text-white">{{ $jamOperasional['selasa_minggu'] ?? 'Tutup' }}</p>
                    </div>
                </div>
            </div>

        </div>

        <div class="pt-10 border-t border-white/10 flex flex-col md:flex-row justify-between items-center gap-6 text-center md:text-left">
            <div>
                <p class="text-primary-100/40 text-sm font-bold tracking-tight">
                    &copy; {{ date('Y') }} <span class="text-primary-100/80">Kolam Renang Selayang</span>. Medan, Indonesia.
                </p>
            </div>
            
            <div class="flex items-center gap-8">
                @guest
                    <a href="{{ route('login') }}" class="text-[10px] font-black uppercase tracking-[0.2em] text-primary-100/30 hover:text-sky-400 transition-colors">
                        Admin Portal
                    </a>
                @endguest
            </div>
        </div>
    </div>
</footer>