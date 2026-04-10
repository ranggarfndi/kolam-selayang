<nav class="bg-white shadow-sm border-b border-gray-100 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            
            <div class="flex items-center">
                <a href="{{ url('/') }}" class="group flex items-center gap-3">
                    <img src="{{ asset('img/logo-selayang.png') }}" alt="Logo Kolam Selayang" class="w-10 h-10 object-contain transition-transform group-hover:scale-110">
                    <span class="text-2xl font-extrabold text-primary-950 tracking-tighter">
                        Kolam <span class="text-primary-600">Selayang</span>
                    </span>
                </a>
            </div>

            <div class="hidden md:flex items-center gap-8">
                <a href="{{ url('/') }}" class="text-gray-600 hover:text-primary-700 text-sm font-semibold transition">Beranda</a>
                <a href="#status" class="text-gray-600 hover:text-primary-700 text-sm font-semibold transition">Status Kolam</a>
                <a href="#berita" class="text-gray-600 hover:text-primary-700 text-sm font-semibold transition">Berita</a>
                
                @auth
                    <div class="h-5 w-px bg-gray-300"></div>
                    <a href="{{ url('/admin/dashboard') }}" class="text-primary-700 hover:text-primary-800 text-sm font-bold transition">Dashboard Admin</a>
                    <a href="{{ route('admin.reports') }}" class="text-primary-700 hover:text-primary-800 text-sm font-bold whitespace-nowrap transition">Laporan</a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-red-500 hover:text-red-700 text-sm font-bold transition">Keluar</button>
                    </form>
                @endauth
            </div>

            <div class="flex items-center md:hidden">
                <button type="button" id="mobile-menu-button" class="text-gray-600 hover:text-primary-700 focus:outline-none p-2 rounded-md hover:bg-gray-50 transition">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path id="menu-icon" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        <path id="close-icon" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

        </div>
    </div>

    <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-gray-100 shadow-lg absolute w-full left-0">
        <div class="px-4 pt-3 pb-6 space-y-2 shadow-inner">
            <a href="{{ url('/') }}" class="block px-4 py-2.5 rounded-lg text-base font-semibold text-gray-700 hover:bg-primary-50 hover:text-primary-700 transition">Beranda</a>
            <a href="#status" class="block px-4 py-2.5 rounded-lg text-base font-semibold text-gray-700 hover:bg-primary-50 hover:text-primary-700 transition">Status Kolam</a>
            <a href="#berita" class="block px-4 py-2.5 rounded-lg text-base font-semibold text-gray-700 hover:bg-primary-50 hover:text-primary-700 transition">Berita</a>

            @auth
                <div class="border-t border-gray-100 my-3 pt-3"></div>
                <a href="{{ url('/admin/dashboard') }}" class="block px-4 py-2.5 rounded-lg text-base font-bold text-primary-700 hover:bg-primary-50 transition">Dashboard Admin</a>
                <a href="{{ route('admin.reports') }}" class="text-primary-700 hover:text-primary-800 text-sm font-bold whitespace-nowrap transition">Laporan</a>
                <form method="POST" action="{{ route('logout') }}" class="block w-full">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2.5 rounded-lg text-base font-bold text-red-500 hover:bg-red-50 hover:text-red-700 transition">Keluar</button>
                </form>
            @endauth
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const btn = document.getElementById('mobile-menu-button');
        const menu = document.getElementById('mobile-menu');
        const menuIcon = document.getElementById('menu-icon');
        const closeIcon = document.getElementById('close-icon');

        btn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
            menuIcon.classList.toggle('hidden');
            closeIcon.classList.toggle('hidden');
        });
    });
</script>