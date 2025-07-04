@section('title', 'Dashboard Admin | Warung Mama Fina')

<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-extrabold text-emerald-900 leading-tight tracking-tight">
            Dashboard Admin
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto px-6 lg:px-8">
            <div class="bg-white shadow-2xl rounded-2xl overflow-hidden border border-emerald-200">
                <div class="p-8 sm:p-10">
                    <h3 class="text-3xl font-extrabold text-emerald-800 mb-6 tracking-tight">
                        Halo, {{ Auth::user()->name }}!
                    </h3>
                    <p class="text-emerald-700 text-lg mb-8">
                        Anda login sebagai <strong>Administrator</strong>. Gunakan menu dan data di bawah ini untuk mengelola pengguna dan barang dalam sistem <strong>Warung Mama Fina</strong>.
                    </p>

                    {{-- Statistik Pesanan --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
                        <x-admin.card label="Total Pesanan" :value="$totalPesanan" color="emerald" />
                        <x-admin.card label="Pesanan Selesai" :value="$pesananSelesai" color="emerald" />
                        <x-admin.card label="Pesanan Aktif" :value="$pesananAktif" color="emerald" />
                        <x-admin.card label="Pendapatan" :value="'Rp ' . number_format($pendapatan)" color="emerald" />
                    </div>

                    {{-- Statistik Pengguna --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                        <x-admin.card label="Admin" :value="$totalAdmin" color="emerald" />
                        <x-admin.card label="Pegawai" :value="$totalPegawai" color="emerald" />
                        <x-admin.card label="Kurir" :value="$totalKurir" color="emerald" />
                        <x-admin.card label="Pelanggan" :value="$totalPelanggan" color="emerald" />
                    </div>

                    {{-- Navigasi Tindakan --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6 mb-10">
                        <a href="{{ route('admin.users.index') }}"
                           class="block text-center bg-emerald-700 hover:bg-emerald-800 text-white font-semibold py-5 px-4 rounded-xl shadow-lg transition duration-300">
                            Kelola Pengguna
                        </a>
                        <a href="{{ route('admin.makanan.index') }}"
                           class="block text-center bg-emerald-700 hover:bg-emerald-800 text-white font-semibold py-5 px-4 rounded-xl shadow-lg transition duration-300">
                            Kelola Barang
                        </a>
                        <a href="{{ route('admin.ulasan.index') }}"
                           class="block text-center bg-emerald-700 hover:bg-emerald-800 text-white font-semibold py-5 px-4 rounded-xl shadow-lg transition duration-300">
                            Lihat Ulasan
                        </a>
                        <a href="{{ route('admin.riwayat.index') }}"
                           class="block text-center bg-emerald-700 hover:bg-emerald-800 text-white font-semibold py-5 px-4 rounded-xl shadow-lg transition duration-300">
                            Riwayat Pembelian
                        </a>
                        <a href="{{ route('admin.register-user') }}"
                           class="block text-center bg-emerald-700 hover:bg-emerald-800 text-white font-semibold py-5 px-4 rounded-xl shadow-lg transition duration-300">
                            + Daftar Akun Baru
                        </a>
                    </div>

                    <div class="text-center text-emerald-500 text-sm italic">
                        Pastikan semua data selalu diperbarui dan tertata untuk menjaga kelancaran sistem.
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
