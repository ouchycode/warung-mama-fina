@section('title', 'Riwayat Pembelian | Warung Mama Fina')

<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-extrabold text-emerald-900 leading-tight tracking-tight">
            Riwayat Pembelian
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-xl p-6 border border-emerald-200">
                @if ($pesananList->isEmpty())
                    <p class="text-center text-emerald-500 italic">Anda belum memiliki riwayat pembelian.</p>
                @else
                    <div class="space-y-6">
                        @foreach ($pesananList as $pesanan)
                            <div class="border border-emerald-200 rounded-lg p-4 shadow-sm hover:shadow-xl transition transform hover:scale-105 bg-white">
                                <div class="flex justify-between items-center mb-2">
                                    <h4 class="font-bold text-emerald-800 text-lg">
                                        #{{ $pesanan->id }} • 
                                        <span class="inline-block px-2 py-0.5 rounded-full text-white text-xs font-medium
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
                                    </h4>
                                    <span class="text-sm text-emerald-600">
                                        {{ \Carbon\Carbon::parse($pesanan->waktu_pesan)->translatedFormat('d F Y, H:i') }}
                                    </span>
                                </div>
                                <ul class="list-disc list-inside text-emerald-700 text-sm">
                                    @foreach ($pesanan->makanan as $item)
                                        <li>{{ $item->nama }} <span class="text-emerald-400">x{{ $item->pivot->jumlah }}</span></li>
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
