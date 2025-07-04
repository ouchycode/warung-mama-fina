@section('title', 'Beranda Kurir | Warung Mama Fina')

<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-extrabold text-emerald-900 leading-tight tracking-tight">
            Beranda Kurir
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto px-6 lg:px-8">
            <div class="bg-white shadow-xl rounded-xl p-8 border border-emerald-200">
                <h3 class="text-xl font-semibold text-emerald-800 mb-2">
                    Hai, {{ Auth::user()->name }}!
                </h3>
                <p class="text-emerald-700 mb-6 text-sm">
                    Anda bisa melihat dan mengelola pengiriman pesanan dari pelanggan di sini.
                </p>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <a href="{{ route('kurir.pesanan') }}"
                       class="block bg-emerald-700 hover:bg-emerald-800 text-white text-center font-semibold py-4 px-6 rounded-lg shadow-md transition duration-200 transform hover:scale-105">
                        Lihat Daftar Pengiriman
                    </a>

                    {{-- Menu pengganti sementara --}}
                    <a href="#"
                       class="block bg-emerald-400/60 text-white text-center font-semibold py-4 px-6 rounded-lg shadow-inner cursor-not-allowed">
                        Riwayat Pengiriman<br><span class="text-xs">(Segera Hadir)</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
