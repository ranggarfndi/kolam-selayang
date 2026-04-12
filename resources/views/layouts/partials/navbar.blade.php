<nav class="bg-white/90 md:bg-transparent backdrop-blur-xl md:backdrop-blur-none border-b border-gray-100 md:border-none sticky top-0 z-50 transition-all duration-500" id="main-navbar">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-24 transition-all duration-500 relative" id="navbar-container">
            
            <div class="flex items-center z-20 md:hidden">
                <a href="{{ url('/') }}" class="group flex items-center gap-4">
                    <div class="relative">
                        <div class="absolute -inset-1 bg-gradient-to-tr from-primary-600 to-sky-400 rounded-full blur opacity-25 group-hover:opacity-60 transition duration-500"></div>
                        <img src="{{ asset('img/logo-selayang.png') }}" alt="Logo" class="relative w-12 h-12 object-contain transition-transform duration-500 group-hover:rotate-12 group-hover:scale-110">
                    </div>
                    <div class="flex flex-col">
                        <span class="text-2xl font-black text-primary-950 tracking-tighter leading-none uppercase">
                            Kolam <span class="text-primary-600">Selayang</span>
                        </span>
                        <span class="text-[10px] font-bold text-gray-400 tracking-[0.2em] uppercase mt-1 leading-none">Medan • Sumatera Utara</span>
                    </div>
                </a>
            </div>

            <div class="hidden md:flex absolute inset-0 items-center justify-center pointer-events-none">
                <div class="flex items-center pointer-events-auto bg-white border border-gray-100 px-3 py-2 rounded-[3.5rem] shadow-xl shadow-primary-900/10 gap-2 transition-all duration-500" id="desktop-capsule">
                    <a href="{{ url('/') }}" class="relative px-10 py-3 text-xs font-black text-gray-500 hover:text-primary-600 transition-all group tracking-[0.15em]">
                        BERANDA
                        <span class="absolute bottom-2 left-1/2 -translate-x-1/2 w-0 h-1 bg-primary-600 rounded-full group-hover:w-6 transition-all"></span>
                    </a>
                    <div class="h-8 w-px bg-gray-100"></div>
                    <a href="{{ url('/') }}" class="px-6 group">
                        <img src="{{ asset('img/logo-selayang.png') }}" alt="Logo" class="w-14 h-14 object-contain transition-transform duration-500 group-hover:scale-110">
                    </a>
                    <div class="h-8 w-px bg-gray-100"></div>
                    <a href="{{ route('news.index') }}" class="relative px-10 py-3 text-xs font-black text-gray-500 hover:text-primary-600 transition-all group tracking-[0.15em]">
                        BERITA
                        <span class="absolute bottom-2 left-1/2 -translate-x-1/2 w-0 h-1 bg-primary-600 rounded-full group-hover:w-6 transition-all"></span>
                    </a>
                </div>
            </div>

            <div class="flex items-center gap-3 z-20">
                @auth
                    <div class="hidden md:flex items-center gap-2">
                        <a href="{{ url('/admin/dashboard') }}" class="bg-primary-950 text-white px-6 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-primary-800 transition-all shadow-xl shadow-primary-950/20 active:scale-95">
                            Dashboard Admin
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" title="Keluar" class="w-12 h-12 flex items-center justify-center bg-white text-red-500 rounded-2xl hover:bg-red-500 hover:text-white transition-all cursor-pointer border border-gray-100 shadow-sm active:scale-95">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                            </button>
                        </form>
                    </div>
                @endauth

                <button type="button" id="mobile-menu-button" class="md:hidden relative w-12 h-12 flex items-center justify-center bg-gray-50 text-primary-950 rounded-2xl hover:bg-primary-100 transition-all cursor-pointer focus:outline-none">
                    <div class="flex flex-col gap-1.5 w-6 items-end group">
                        <span id="hamb-1" class="block h-0.5 w-6 bg-current rounded-full transition-all duration-300"></span>
                        <span id="hamb-2" class="block h-0.5 w-4 bg-current rounded-full transition-all duration-300 group-hover:w-6"></span>
                        <span id="hamb-3" class="block h-0.5 w-5 bg-current rounded-full transition-all duration-300"></span>
                    </div>
                </button>
            </div>
        </div>
    </div>

    <div id="mobile-menu" class="hidden md:hidden overflow-hidden bg-white/98 backdrop-blur-2xl border-t border-gray-100 shadow-2xl absolute w-full left-0 transition-all duration-500 origin-top">
        <div class="px-6 py-8 space-y-1">
            <a href="{{ url('/') }}" class="block px-4 py-3 rounded-xl text-lg font-bold text-gray-800 hover:bg-primary-50 hover:text-primary-700 transition-all">Beranda</a>
            <a href="{{ route('news.index') }}" class="block px-4 py-3 rounded-xl text-lg font-bold text-gray-800 hover:bg-primary-50 hover:text-primary-700 transition-all">Berita</a>
            <a href="https://www.instagram.com/selayangsumutswimpool/" target="_blank" rel="noopener noreferrer" class="flex items-center gap-3 px-4 py-3 rounded-xl text-lg font-bold text-primary-600 hover:bg-primary-50 transition-all">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                Instagram
            </a>

            @auth
                <div class="my-6 border-t border-gray-100 mx-4"></div>
                <div class="space-y-3">
                    <span class="block px-4 mb-2 text-[10px] font-black tracking-[0.2em] text-gray-400 uppercase">Akses Administrasi</span>
                    <a href="{{ url('/admin/dashboard') }}" class="flex items-center gap-4 px-4 py-4 rounded-2xl bg-primary-950 text-white font-bold text-sm shadow-xl shadow-primary-950/20">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        Dashboard Admin
                    </a>
                    
                    <form method="POST" action="{{ route('logout') }}" class="block w-full">
                        @csrf
                        <button type="submit" class="w-full flex items-center justify-center gap-3 bg-red-50 text-red-600 p-4 rounded-2xl font-black text-xs uppercase transition active:bg-red-600 active:text-white border border-red-100">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                            Logout Sekarang
                        </button>
                    </form>
                </div>
            @endauth
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const navbar = document.getElementById('main-navbar');
        const container = document.getElementById('navbar-container');
        const btn = document.getElementById('mobile-menu-button');
        const menu = document.getElementById('mobile-menu');
        const capsule = document.getElementById('desktop-capsule');
        
        const h1 = document.getElementById('hamb-1');
        const h2 = document.getElementById('hamb-2');
        const h3 = document.getElementById('hamb-3');

        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                container.classList.replace('h-24', 'h-20');
                if (window.innerWidth < 768) {
                    navbar.classList.add('shadow-xl', 'bg-white/95');
                } else {
                    navbar.classList.remove('bg-white/95', 'shadow-xl');
                    navbar.classList.add('bg-transparent');
                }
                if(capsule) capsule.classList.add('scale-95', 'shadow-2xl');
            } else {
                container.classList.replace('h-20', 'h-24');
                navbar.classList.remove('shadow-xl', 'bg-white/95');
                if(capsule) capsule.classList.remove('scale-95', 'shadow-2xl');
            }
        });

        const toggleMenu = () => {
            const isHidden = menu.classList.contains('hidden');
            if (isHidden) {
                menu.classList.remove('hidden');
                h1.classList.add('rotate-45', 'translate-y-2');
                h2.classList.add('opacity-0');
                h3.classList.add('-rotate-45', '-translate-y-2', 'w-6');
            } else {
                menu.classList.add('hidden');
                h1.classList.remove('rotate-45', 'translate-y-2');
                h2.classList.remove('opacity-0');
                h3.classList.remove('-rotate-45', '-translate-y-2', 'w-6');
            }
        };

        btn.addEventListener('click', toggleMenu);
    });
</script>