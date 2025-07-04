@section('title', 'Beranda Pelanggan | Warung Mama Fina')

<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-extrabold text-emerald-900 leading-tight tracking-tight">
            Beranda Pelanggan
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto px-6 lg:px-8">
            <div class="bg-white shadow-xl rounded-2xl overflow-hidden border border-emerald-200">
                <div class="p-8 sm:p-10">
                    <!-- Greeting and Introduction -->
                    <h3 class="text-3xl font-extrabold text-emerald-900 mb-6 tracking-tight">Selamat datang, {{ Auth::user()->name }}!</h3>
                    <p class="text-emerald-700 text-lg mb-8">
                        Terima kasih telah berbelanja di <strong>Warung Mama Fina</strong>. Di sini Anda bisa memesan kebutuhan harian, melihat status pengiriman, dan mengecek riwayat pesanan dengan mudah.
                    </p>

                    <!-- Action Buttons -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-12">
                        <a href="{{ route('pelanggan.pesan') }}"
                           class="group flex items-center justify-center gap-4 bg-emerald-700 hover:bg-emerald-800 text-white font-semibold py-4 px-8 rounded-xl shadow-md transition duration-300 transform hover:scale-105 hover:shadow-lg">
                            <span class="text-lg font-medium">Belanja Sekarang</span>
                        </a>
                        <a href="{{ route('pelanggan.lacak') }}"
                           class="group flex items-center justify-center gap-4 bg-emerald-700 hover:bg-emerald-800 text-white font-semibold py-4 px-8 rounded-xl shadow-md transition duration-300 transform hover:scale-105 hover:shadow-lg">
                            <span class="text-lg font-medium">Lacak Kiriman</span>
                        </a>
                        <a href="{{ route('pelanggan.riwayat') }}"
                           class="group flex items-center justify-center gap-4 bg-emerald-700 hover:bg-emerald-800 text-white font-semibold py-4 px-8 rounded-xl shadow-md transition duration-300 transform hover:scale-105 hover:shadow-lg">
                            <span class="text-lg font-medium">Cek Riwayat</span>
                        </a>
                    </div>

                    <!-- Pesanan Terakhir -->
                    @if($pesanan)
                        <div class="bg-white border border-emerald-300 rounded-lg p-6 mb-8 shadow-lg">
                            <h4 class="text-xl font-semibold text-emerald-800 mb-4">Pesanan Terakhir</h4>
                            <ul class="text-emerald-700 text-sm space-y-2">
                                <li><strong>Status:</strong>
                                    <span class="inline-block px-3 py-1 rounded-full text-white font-medium text-xs
                                        @if($pesanan->status_pesanan === 'menunggu') 
                                            bg-yellow-600 
                                        @elseif($pesanan->status_pesanan === 'diproses') 
                                            bg-orange-600 
                                        @elseif($pesanan->status_pesanan === 'dikirim') 
                                            bg-blue-700 
                                        @elseif($pesanan->status_pesanan === 'selesai') 
                                            bg-emerald-700 
                                        @else 
                                            bg-gray-500 
                                        @endif">
                                        {{ ucfirst($pesanan->status_pesanan) }}
                                    </span>
                                </li>
                                <li><strong>Waktu Pemesanan:</strong>
                                    {{ \Carbon\Carbon::parse($pesanan->waktu_pesan)->translatedFormat('d F Y, H:i') }}
                                </li>
                            </ul>
                        </div>
                    @else
                        <div class="text-center text-emerald-500 text-sm mt-10 italic">
                            Anda belum melakukan pemesanan.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
