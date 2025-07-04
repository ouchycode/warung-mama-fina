@section('title', 'Menu | Warung Mama Fina')

<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-extrabold text-emerald-900 leading-tight tracking-tight">
            Menu Warung
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto px-6 lg:px-8" x-data="pesananHandler()">
            {{-- Filter Kategori --}}
            <div class="mb-6">
                <form method="GET" action="{{ route('pelanggan.pesan') }}" class="flex flex-col sm:flex-row sm:items-end gap-4">
                    <div class="w-full sm:w-1/2">
                        <label for="kategori" class="block text-sm font-medium text-emerald-800 mb-1">Pilih Kategori:</label>
                        <div class="relative">
                            <select name="kategori" id="kategori"
                                    onchange="this.form.submit()"
                                    class="appearance-none w-full border border-emerald-300 bg-white rounded-lg px-4 py-2 pr-10 text-emerald-800 focus:outline-none focus:ring-2 focus:ring-emerald-600 shadow-sm transition">
                                <option value="">-- Semua Kategori --</option>
                                @foreach ($kategoriList as $kategori)
                                    <option value="{{ $kategori }}" {{ request('kategori') === $kategori ? 'selected' : '' }}>
                                        {{ ucfirst($kategori) }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2"
                                     viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            {{-- Notifikasi --}}
            @if (session('status'))
                <div class="mb-6 bg-emerald-100 border border-emerald-300 text-emerald-800 px-4 py-3 rounded-lg shadow">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 bg-red-100 border border-red-300 text-red-800 px-4 py-3 rounded-lg shadow">
                    <ul class="list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Form Pemesanan --}}
            <div class="bg-white border border-emerald-200 rounded-2xl p-8 shadow-xl">
                <h3 class="text-xl font-semibold text-emerald-800 mb-6">
                    Pilih produk yang ingin Anda beli:
                </h3>

                <form method="POST" action="{{ route('pelanggan.simpan') }}" x-ref="form">
                    @csrf

                    @forelse ($makanan as $index => $item)
                        <div class="mb-5 p-5 bg-white border border-emerald-200 rounded-xl shadow-sm hover:shadow-md transition">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                                <div class="flex items-start gap-4">
                                    @if ($item->gambar)
                                        <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama }}"
                                             class="w-24 h-24 object-cover rounded-lg border border-emerald-300">
                                    @else
                                        <div class="w-24 h-24 bg-emerald-50 flex items-center justify-center text-emerald-400 text-sm border rounded-lg">
                                            Tidak ada gambar
                                        </div>
                                    @endif

                                    <div>
                                        <h4 class="text-lg font-bold text-emerald-900">{{ $item->nama }}</h4>
                                        <p class="text-sm text-emerald-700">Harga: Rp{{ number_format($item->harga) }}</p>
                                        <p class="text-xs text-emerald-500 italic">Kategori: {{ $item->kategori ?? '-' }}</p>
                                    </div>
                                </div>

                                <div class="flex items-center gap-2">
                                    <input type="hidden" name="makanan_id[]" value="{{ $item->id }}">
                                    <input type="number"
                                           name="jumlah[]"
                                           min="0"
                                           placeholder="0"
                                           class="w-20 border border-emerald-300 rounded-md text-center py-2 px-3 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-600"
                                           x-model.number="jumlah[{{ $index }}]"
                                           @input="hitungTotal()"
                                    >
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-emerald-500 italic">Menu belum tersedia untuk kategori ini.</p>
                    @endforelse

                    {{-- Alamat Pengantaran --}}
<div class="mt-6">
    <label for="alamat_pengantaran" class="block font-semibold text-emerald-800 mb-2">Alamat Tujuan Pengantaran:</label>
    <textarea name="alamat_pengantaran" id="alamat_pengantaran"
              rows="3"
              required
              class="w-full border border-emerald-300 rounded-md px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-600"
              placeholder="Contoh: Jl. Melati No. 123, RT 04 RW 02, Kel. Sukamaju, Kec. Sukaraja">
        {{ old('alamat_pengantaran') }}
    </textarea>
    @error('alamat_pengantaran')
        <span class="text-sm text-red-500 mt-1 block">{{ $message }}</span>
    @enderror
</div>


                    {{-- Pilihan Metode Pembayaran --}}
                    <div class="mt-6">
                        <label class="block font-semibold text-emerald-800 mb-2">Metode Pembayaran:</label>
                        <select name="metode_pembayaran" required
                                class="w-full border border-emerald-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-600">
                            <option value="">-- Pilih --</option>
                            <option value="cod">Bayar di Tempat (COD)</option>
                            <option value="transfer">Transfer Bank (Demo)</option>
                        </select>
                    </div>

                    {{-- Total Harga --}}
                    <div class="mt-8 text-right text-lg font-semibold text-emerald-800">
                        Total Belanja:
                        <span class="text-emerald-700">
                            Rp <span x-text="formatRupiah(total)"></span>
                        </span>
                        <div class="text-sm text-emerald-500" x-show="jumlah.filter(j => j > 0).length > 0">
                            (<span x-text="jumlah.filter(j => j > 0).length"></span> item dipilih)
                        </div>
                    </div>

                    {{-- Tombol Pesan --}}
                    <div class="mt-8 text-center">
                        <button type="button"
                                @click="konfirmasiSubmit"
                                :disabled="total <= 0"
                                class="bg-emerald-700 hover:bg-emerald-800 text-white text-base font-semibold py-3 px-8 rounded-lg shadow-md transition duration-200 disabled:opacity-50 disabled:cursor-not-allowed">
                            Lanjutkan Pemesanan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Alpine.js --}}
    <script>
        function pesananHandler() {
            return {
                jumlah: [],
                total: 0,
                hitungTotal() {
                    const hargaList = @json($makanan->pluck('harga')->values());
                    this.total = this.jumlah.reduce((sum, qty, i) => {
                        const harga = hargaList[i] || 0;
                        return sum + (parseInt(qty) > 0 ? harga * parseInt(qty) : 0);
                    }, 0);
                },
                formatRupiah(value) {
                    return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                },
                konfirmasiSubmit() {
                    if (this.total > 0) {
                        Swal.fire({
                            title: 'Konfirmasi Pemesanan',
                            html: `Total belanja: <strong>Rp ${this.formatRupiah(this.total)}</strong><br><br>Yakin ingin melanjutkan?`,
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonColor: '#047857',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ya, Pesan',
                            cancelButtonText: 'Batal'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                this.$refs.form.submit();
                            }
                        });
                    }
                }
            }
        }
    </script>
</x-app-layout>
