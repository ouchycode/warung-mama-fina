<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-extrabold text-emerald-900 leading-tight tracking-tight">
            Detail Pesanan #{{ $pesanan->id }}
        </h2>
    </x-slot>

    <div class="py-8 max-w-4xl mx-auto">
        <div class="bg-white border border-emerald-200 rounded-xl p-6 shadow-md transition-all duration-300 hover:shadow-xl">
            <ul class="text-emerald-700 text-sm space-y-2 mb-4">
                <li>
                    <strong>Status:</strong> 
                    <span class="inline-block px-3 py-1 rounded-full text-white text-xs font-medium capitalize
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
                        {{ $pesanan->status_pesanan }}
                    </span>
                </li>
                <li><strong>Tanggal Pesan:</strong> {{ \Carbon\Carbon::parse($pesanan->waktu_pesan)->translatedFormat('d F Y, H:i') }}</li>
                <li><strong>Pelanggan:</strong> {{ $pesanan->pelanggan->name ?? '-' }}</li>
                <li><strong>Alamat Pengantaran:</strong> {{ $pesanan->alamat_pengantaran }}</li> {{-- ✅ Tambahan --}}
                <li><strong>Metode Pembayaran:</strong> 
                    {{ $pesanan->metode_pembayaran === 'cod' ? 'Bayar di Tempat (COD)' : 'Transfer Bank (Demo)' }}
                </li>
            </ul>
            

            <h4 class="text-lg font-semibold text-emerald-800 mb-2">Detail Produk</h4>
            <table class="w-full text-sm text-emerald-700 mb-4">
                <thead>
                    <tr class="border-b border-emerald-300">
                        <th class="text-left py-2">Nama</th>
                        <th class="text-center">Jumlah</th>
                        <th class="text-right">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pesanan->makanan as $makanan)
                        <tr class="border-b border-emerald-100">
                            <td class="py-1">{{ $makanan->nama }}</td>
                            <td class="text-center">{{ $makanan->pivot->jumlah }}</td>
                            <td class="text-right">Rp{{ number_format($makanan->harga * $makanan->pivot->jumlah) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="text-right font-bold text-emerald-900 mt-4">
                Total: Rp{{ number_format($pesanan->makanan->sum(fn($m) => $m->harga * $m->pivot->jumlah)) }}
            </div>

            <div class="mt-6 text-center">
                <a href="{{ route('pegawai.pesanan') }}" class="text-sm text-emerald-600 hover:text-emerald-800 underline transition duration-200">
                    ← Kembali ke Daftar Pesanan
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
