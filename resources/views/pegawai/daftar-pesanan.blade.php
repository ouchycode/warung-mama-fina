@section('title', 'Daftar Pesanan Masuk | Warung Mama Fina')

<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-extrabold text-emerald-900 leading-tight tracking-tight">
            Daftar Pesanan Masuk
        </h2>
    </x-slot>

    <div class="py-12 max-w-5xl mx-auto px-6">
        @if (session('status'))
            <div class="mb-6 bg-emerald-50 border border-emerald-300 text-emerald-800 px-4 py-3 rounded-lg shadow-md">
                {{ session('status') }}
            </div>
        @endif

        @forelse ($pesanan as $item)
            <div class="bg-white shadow-lg rounded-lg mb-6 p-6 border border-emerald-200 transition duration-300 hover:shadow-xl hover:scale-105">
                <div class="mb-2">
                    <span class="text-sm text-emerald-600 font-semibold">ID #{{ $item->id }}</span>
                    <span class="ml-2 text-sm text-emerald-500">({{ $item->waktu_pesan->translatedFormat('d M Y, H:i') }})</span>
                </div>

                <ul class="text-sm text-emerald-700 mb-3 list-disc list-inside">
                    @foreach ($item->makanan as $m)
                        <li>{{ $m->nama }} x {{ $m->pivot->jumlah }}</li>
                    @endforeach
                </ul>

                <div class="flex items-center gap-4 mt-4">
                    {{-- Tombol Detail --}}
                    <a href="{{ route('pegawai.pesanan.show', $item->id) }}"
                       class="text-sm text-emerald-700 hover:text-emerald-900 font-medium transition duration-200 transform hover:scale-105 underline">
                        Lihat Detail
                    </a>

                    {{-- Tombol Verifikasi --}}
                    <form method="POST" action="{{ route('pegawai.verifikasi', $item->id) }}">
                        @csrf
                        <button type="submit"
                                class="bg-emerald-700 hover:bg-emerald-800 text-white px-5 py-2 rounded-lg shadow-md text-sm font-semibold transition duration-200 transform hover:scale-105">
                            Verifikasi
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <p class="text-center text-emerald-500 italic">Belum ada pesanan yang menunggu verifikasi.</p>
        @endforelse
    </div>
</x-app-layout>
