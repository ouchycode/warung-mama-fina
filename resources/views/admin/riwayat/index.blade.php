@section('title', 'Riwayat Pembelian | Warung Mama Fina')

<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-extrabold text-emerald-900 leading-tight tracking-tight">
            Riwayat Pembelian Pelanggan
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto px-6 lg:px-8">
            {{-- Filter Tanggal --}}
            <form method="GET" class="mb-6 bg-emerald-50 border border-emerald-200 rounded-lg p-4">
                <div class="flex flex-col sm:flex-row sm:items-end gap-4">
                    <div class="flex-1">
                        <label for="dari" class="block text-emerald-800 font-medium">Dari Tanggal</label>
                        <input type="date" name="dari" id="dari" value="{{ request('dari') }}"
                               class="w-full border border-emerald-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-600">
                    </div>

                    <div class="flex-1">
                        <label for="sampai" class="block text-emerald-800 font-medium">Sampai Tanggal</label>
                        <input type="date" name="sampai" id="sampai" value="{{ request('sampai') }}"
                               class="w-full border border-emerald-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-600">
                    </div>

                    <div>
                        <button type="submit"
                                class="bg-emerald-700 hover:bg-emerald-800 text-white font-semibold px-6 py-2 rounded-lg shadow-md transition">
                            Filter
                        </button>
                    </div>
                </div>
            </form>

            {{-- Riwayat Pembelian --}}
            <div class="bg-white border border-emerald-200 shadow-xl rounded-2xl p-8">
                @if ($riwayat->count())
                    <div class="space-y-8">
                        @foreach ($riwayat as $pesanan)
                            <div class="border border-emerald-100 rounded-lg p-6 bg-emerald-50/20">
                                <div class="flex justify-between items-center mb-3">
                                    <div class="text-sm text-emerald-700">
                                        <strong>ID Pesanan:</strong> #{{ $pesanan->id }}<br>
                                        <strong>Pelanggan:</strong> {{ $pesanan->pelanggan->name ?? '-' }}<br>
                                        <strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($pesanan->waktu_pesan)->translatedFormat('d F Y, H:i') }}<br>
                                        <strong>Metode:</strong> {{ ucfirst($pesanan->metode_pembayaran ?? '-') }}
                                    </div>
                                    <span class="inline-block px-3 py-1 rounded-full text-xs font-medium text-white capitalize
                                        @if($pesanan->status_pesanan === 'menunggu') bg-yellow-600 
                                        @elseif($pesanan->status_pesanan === 'diproses') bg-orange-600 
                                        @elseif($pesanan->status_pesanan === 'dikirim') bg-blue-700 
                                        @elseif($pesanan->status_pesanan === 'selesai') bg-emerald-700 
                                        @else bg-gray-500 @endif">
                                        {{ $pesanan->status_pesanan }}
                                    </span>
                                </div>

                                <div class="text-sm text-emerald-800">
                                    <table class="w-full table-auto border-t border-b border-emerald-200 my-4">
                                        <thead>
                                            <tr class="text-left text-xs text-emerald-600">
                                                <th class="py-2">Nama Produk</th>
                                                <th class="py-2 text-center">Jumlah</th>
                                                <th class="py-2 text-right">Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($pesanan->makanan as $item)
                                                <tr>
                                                    <td class="py-1">{{ $item->nama }}</td>
                                                    <td class="text-center">{{ $item->pivot->jumlah }}</td>
                                                    <td class="text-right">Rp{{ number_format($item->harga * $item->pivot->jumlah, 0, ',', '.') }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    <div class="text-right font-bold text-emerald-900">
                                        Total: Rp{{ number_format($pesanan->makanan->sum(fn($m) => $m->harga * $m->pivot->jumlah), 0, ',', '.') }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center text-emerald-500 italic py-16">
                        Tidak ada data riwayat pembelian untuk tanggal yang dipilih.
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
