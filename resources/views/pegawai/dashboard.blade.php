@section('title', 'Beranda Pegawai | Warung Mama Fina')

<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-extrabold text-emerald-900 leading-tight tracking-tight">
            Beranda Pegawai
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto px-6 lg:px-8">
            <div class="bg-white shadow-xl rounded-xl overflow-hidden border border-emerald-200">
                <div class="p-6 sm:p-8">
                    <h3 class="text-2xl font-extrabold text-emerald-800 mb-6 tracking-tight">
                        Halo, {{ Auth::user()->name }}!
                    </h3>
                    <p class="text-emerald-700 text-lg mb-6">
                        Selamat datang di halaman pegawai. Anda dapat memantau dan memverifikasi pesanan pelanggan yang masuk melalui tombol di bawah ini.
                    </p>

                    <div class="text-center mt-6">
                        <a href="{{ route('pegawai.pesanan') }}"
                           class="inline-block bg-emerald-700 hover:bg-emerald-800 text-white font-semibold py-3 px-8 rounded-lg shadow-md transition duration-300 transform hover:scale-105 hover:shadow-lg">
                            Kelola Pesanan Masuk
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
