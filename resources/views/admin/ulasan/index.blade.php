@section('title', 'Daftar Ulasan | Warung Mama Fina')
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-extrabold text-emerald-900 leading-tight tracking-tight">
            Daftar Ulasan
        </h2>
    </x-slot>

    <div class="py-12 max-w-5xl mx-auto px-6">
        @if (session('status'))
            <div class="mb-6 bg-emerald-100 border border-emerald-300 text-emerald-800 px-4 py-3 rounded-lg shadow">
                {{ session('status') }}
            </div>
        @endif

        <div class="bg-white shadow-md rounded-lg p-6 border border-emerald-200">
            <table class="w-full table-auto text-sm text-left">
                <thead class="bg-emerald-50 text-emerald-700 uppercase text-xs">
                    <tr>
                        <th class="px-4 py-2">Nama Pelanggan</th>
                        <th class="px-4 py-2">ID Pesanan</th>
                        <th class="px-4 py-2">Rating</th>
                        <th class="px-4 py-2">Komentar</th>
                        <th class="px-4 py-2">Tanggal</th>
                    </tr>
                </thead>
                <tbody class="text-emerald-800">
                    @forelse ($ulasans as $ulasan)
                        <tr class="border-t hover:bg-emerald-50 transition">
                            <td class="px-4 py-3">{{ $ulasan->pelanggan->name }}</td>
                            <td class="px-4 py-3">#{{ $ulasan->pesanan->id }}</td>
                            <td class="px-4 py-3">{{ $ulasan->rating }} ⭐</td>
                            <td class="px-4 py-3">{{ $ulasan->komentar ?? '-' }}</td>
                            <td class="px-4 py-3">{{ $ulasan->created_at->translatedFormat('d F Y, H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-emerald-400 py-4 italic">Belum ada ulasan yang masuk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
