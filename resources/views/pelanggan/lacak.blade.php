@section('title', 'Lacak Pengiriman | Warung Mama Fina')
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-extrabold text-emerald-900 leading-tight tracking-tight">
            Lacak Pengiriman
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto px-6 lg:px-8">
            <div class="bg-white border border-emerald-200 rounded-2xl shadow-xl p-8 transition-all duration-300">

                {{-- Notifikasi Sukses --}}
                @if (session('status'))
                    <div class="mb-6 bg-emerald-50 border border-emerald-300 text-emerald-800 px-4 py-3 rounded-lg shadow">
                        {{ session('status') }}
                    </div>
                @endif

                @if ($pesanan)
                    <h3 class="text-xl font-bold text-emerald-800 mb-4">Informasi Pesanan Anda</h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm text-emerald-800 mb-4">
                        <div><span class="font-semibold">ID Pesanan:</span> #{{ $pesanan->id }}</div>
                        <div><span class="font-semibold">Tanggal Pemesanan:</span> {{ \Carbon\Carbon::parse($pesanan->waktu_pesan)->translatedFormat('d F Y, H:i') }}</div>
                        <div><span class="font-semibold">Metode Pembayaran:</span> 
                            <span class="capitalize">
                                {{ $pesanan->metode_pembayaran === 'cod' ? 'Bayar di Tempat (COD)' : 'Transfer Bank (Demo)' }}
                            </span>
                        </div>
                        <div><span class="font-semibold">Alamat Pengantaran:</span> {{ $pesanan->alamat_pengantaran }}</div>
                        <div class="sm:col-span-2">
                            <span class="font-semibold">Status:</span>
                            <span class="ml-2 inline-block px-3 py-1 rounded-full text-white text-xs font-medium
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
                        </div>
                    </div>

                    <hr class="my-4 border-emerald-200">

                    <h4 class="text-md font-semibold text-emerald-800 mb-2">Detail Pembelian</h4>
                    <ul class="text-emerald-700 text-sm space-y-2">
                        @foreach ($pesanan->makanan as $makanan)
                            <li class="flex justify-between">
                                <span>{{ $makanan->nama }} x {{ $makanan->pivot->jumlah }}</span>
                                <span>Rp{{ number_format($makanan->harga * $makanan->pivot->jumlah, 0, ',', '.') }}</span>
                            </li>
                        @endforeach
                    </ul>

                    <div class="mt-4 border-t pt-4 text-right font-bold text-emerald-900">
                        Total: Rp{{ number_format($pesanan->makanan->sum(fn($m) => $m->harga * $m->pivot->jumlah), 0, ',', '.') }}
                    </div>

                    {{-- Tombol Batalkan jika status masih menunggu --}}
                    @if ($pesanan->status_pesanan === 'menunggu')
                        <form action="{{ route('pelanggan.batal', $pesanan->id) }}" method="POST" class="mt-6 text-center">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    onclick="return confirm('Yakin ingin membatalkan pesanan ini?')"
                                    class="bg-red-600 hover:bg-red-700 text-white font-semibold px-6 py-2 rounded-lg shadow-md transition duration-300">
                                Batalkan Pesanan
                            </button>
                        </form>
                    @endif

                    {{-- Ulasan --}}
                    @if ($pesanan->status_pesanan === 'selesai')
                        <div class="mt-6">
                            @if ($pesanan->ulasan)
                                <h4 class="text-lg font-semibold text-emerald-800 mb-2">Ulasan Anda</h4>
                                <div class="bg-emerald-50 border border-emerald-200 rounded-lg p-4 text-sm text-emerald-700">
                                    <div class="mb-2"><strong>Rating:</strong> {{ $pesanan->ulasan->rating }} / 5</div>
                                    @if($pesanan->ulasan->komentar)
                                        <div><strong>Komentar:</strong> {{ $pesanan->ulasan->komentar }}</div>
                                    @else
                                        <div class="italic text-emerald-500">Tanpa komentar.</div>
                                    @endif
                                </div>
                            @else
                                <h4 class="text-lg font-semibold text-emerald-800 mb-4">Beri Ulasan</h4>

                                <form action="{{ route('pelanggan.simpan-ulasan', $pesanan->id) }}" method="POST">
                                    @csrf

                                    <div class="mb-4">
                                        <label class="block text-emerald-800 font-medium">Rating</label>
                                        <input type="number" name="rating" min="1" max="5" class="w-full border border-emerald-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-600" required>
                                        @error('rating') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label class="block text-emerald-800 font-medium">Komentar</label>
                                        <textarea name="komentar" class="w-full border border-emerald-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-600" rows="3" placeholder="Tulis komentar di sini (opsional)"></textarea>
                                        @error('komentar') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                    </div>

                                    <button type="submit" class="bg-emerald-700 hover:bg-emerald-800 text-white px-6 py-3 rounded-lg shadow-md transition duration-300">
                                        Kirim Ulasan
                                    </button>
                                </form>
                            @endif
                        </div>
                    @endif

                @else
                    <div class="text-center py-16 text-emerald-500 text-sm italic">
                        Belum ada pesanan untuk dilacak.
                    </div>
                @endif

                <div class="mt-8 text-center">
                    <a href="{{ route('pelanggan.pesan') }}"
                       class="inline-block bg-emerald-700 hover:bg-emerald-800 text-white font-semibold py-2 px-6 rounded-lg shadow-md transition duration-300">
                        Buat Pesanan Baru
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
