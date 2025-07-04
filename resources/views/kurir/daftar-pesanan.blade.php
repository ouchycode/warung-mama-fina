@section('title', 'Daftar Pengiriman | Warung Mama Fina')

<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-extrabold text-emerald-900 leading-tight tracking-tight">
            Daftar Pengiriman
        </h2>
    </x-slot>

    <div class="py-10 max-w-5xl mx-auto px-6">
        @if(session('status'))
            <div class="mb-4 bg-emerald-100 border border-emerald-300 text-emerald-800 px-4 py-3 rounded-lg shadow">
                {{ session('status') }}
            </div>
        @endif

        @forelse ($pesanan as $item)
            <div class="mb-6 p-6 bg-white rounded-xl border border-emerald-200 shadow-md hover:shadow-lg transition duration-200">
                <h3 class="text-lg font-bold text-emerald-800 mb-2">
                    #{{ $item->id }} – 
                    <span class="capitalize inline-block px-3 py-1 text-white text-xs font-medium rounded-full
                        @if($item->status_pesanan === 'menunggu') bg-yellow-600
                        @elseif($item->status_pesanan === 'diproses') bg-orange-600
                        @elseif($item->status_pesanan === 'dikirim') bg-blue-700
                        @elseif($item->status_pesanan === 'selesai') bg-emerald-700
                        @else bg-gray-500 @endif">
                        {{ $item->status_pesanan }}
                    </span>
                </h3>

                {{-- Detail Tambahan --}}
                <ul class="text-emerald-700 text-sm mb-3 space-y-1">
                    <li><strong>Tanggal Pemesanan:</strong> {{ \Carbon\Carbon::parse($item->waktu_pesan)->translatedFormat('d F Y, H:i') }}</li>
                    <li><strong>Alamat Pengantaran:</strong> {{ $item->alamat_pengantaran }}</li>
                    <li><strong>Metode Pembayaran:</strong> 
                        {{ $item->metode_pembayaran === 'cod' ? 'Bayar di Tempat (COD)' : 'Transfer Bank (Demo)' }}
                    </li>
                    <li><strong>Item Pesanan:</strong>
                        <ul class="list-disc list-inside">
                            @foreach ($item->makanan as $makanan)
                                <li>{{ $makanan->nama }} × {{ $makanan->pivot->jumlah }}</li>
                            @endforeach
                        </ul>
                    </li>
                </ul>

                <div class="flex gap-3">
                    @if($item->status_pesanan === 'diproses')
                        <form method="POST" action="{{ route('kurir.kirim', $item->id) }}">
                            @csrf
                            <button type="submit"
                                    class="bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-2 rounded-lg shadow-md text-sm font-semibold transition duration-200 transform hover:scale-105">
                                Tandai Dikirim
                            </button>
                        </form>
                    @endif

                    @if($item->status_pesanan === 'dikirim')
                        <form method="POST" action="{{ route('kurir.selesai', $item->id) }}">
                            @csrf
                            <button type="submit"
                                    class="bg-emerald-700 hover:bg-emerald-800 text-white px-5 py-2 rounded-lg shadow-md text-sm font-semibold transition duration-200 transform hover:scale-105">
                                Selesaikan
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        @empty
            <p class="text-center text-emerald-500 italic">Belum ada pesanan untuk dikirim saat ini.</p>
        @endforelse
    </div>
</x-app-layout>
