<footer class="bg-white border-t border-gray-100 mt-auto pt-12 pb-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-10">
            
            <div>
                <h3 class="text-lg font-extrabold text-primary-950 mb-4 flex items-center gap-3">
                    <img src="{{ asset('img/logo-selayang.png') }}" alt="Logo Kolam Selayang" class="w-7 h-7 object-contain">
                    Kolam Selayang
                </h3>
                <p class="text-gray-500 text-sm leading-relaxed">
                    Fasilitas kolam renang terbaik di Medan. Kami menyediakan informasi pembaruan status kolam dan jumlah pengunjung secara langsung (real-time) demi kenyamanan Anda.
                </p>
            </div>

            <div>
                <h3 class="text-lg font-bold text-gray-900 mb-4">Navigasi</h3>
                <ul class="space-y-2.5 text-sm">
                    <li><a href="{{ url('/') }}" class="text-gray-500 hover:text-primary-600 transition flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-gray-300"></span> Beranda</a></li>
                    <li><a href="#status" class="text-gray-500 hover:text-primary-600 transition flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-gray-300"></span> Status Kolam Atas & Bawah</a></li>
                    <li><a href="#berita" class="text-gray-500 hover:text-primary-600 transition flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-gray-300"></span> Berita Terbaru</a></li>
                </ul>
            </div>

            <div>
                <h3 class="text-lg font-bold text-gray-900 mb-4">Jam Operasional</h3>
                <div class="bg-primary-50 rounded-xl p-4 border border-primary-100">
                    <ul class="space-y-3 text-sm">
                        <li class="flex justify-between items-center border-b border-primary-100 pb-2">
                            <span class="text-gray-600 font-medium">Senin</span> 
                            <span class="text-primary-800 font-bold">12.00 - 17.15 WIB</span>
                        </li>
                        <li class="flex justify-between items-center pt-1">
                            <span class="text-gray-600 font-medium">Selasa - Minggu</span> 
                            <span class="text-primary-800 font-bold">07.00 - 17.15 WIB</span>
                        </li>
                    </ul>
                </div>
            </div>
            
        </div>

        <div class="border-t border-gray-100 pt-6 flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-gray-400 text-xs text-center md:text-left font-medium">
                &copy; {{ date('Y') }} Kolam Renang Selayang Medan. Semua Hak Dilindungi.
            </p>
            
            @guest
                <a href="{{ route('login') }}" class="text-[11px] text-gray-300 hover:text-gray-500 font-medium tracking-wide transition">
                    Akses Administrator
                </a>
            @endguest
        </div>

    </div>
</footer>