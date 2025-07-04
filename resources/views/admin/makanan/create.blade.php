@section('title', 'Tambah Barang | Warung Mama Fina')

<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-extrabold text-emerald-900 leading-tight tracking-tight">
            Tambah Barang
        </h2>
    </x-slot>

    <div class="py-8 max-w-xl mx-auto">
        <div class="bg-white shadow rounded-lg p-6 border border-emerald-200">
            <form action="{{ route('admin.makanan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf

                {{-- Nama Barang --}}
                <div>
                    <label class="block font-semibold text-emerald-800 mb-1">Nama Barang</label>
                    <input type="text" name="nama" value="{{ old('nama') }}"
                           class="w-full border border-emerald-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-600">
                    @error('nama') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                {{-- Harga --}}
                <div>
                    <label class="block font-semibold text-emerald-800 mb-1">Harga (Rp)</label>
                    <input type="number" name="harga" value="{{ old('harga') }}"
                           class="w-full border border-emerald-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-600">
                    @error('harga') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                {{-- Kategori --}}
                <div>
                    <label class="block font-semibold text-emerald-800 mb-1">Kategori</label>
                    <input type="text" name="kategori" value="{{ old('kategori') }}"
                           placeholder="Contoh: kebutuhan harian, minuman, camilan"
                           class="w-full border border-emerald-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-600">
                    @error('kategori') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                {{-- Gambar --}}
                <div>
                    <label class="block font-semibold text-emerald-800 mb-1">Gambar Barang</label>
                    <input type="file" name="gambar" accept="image/*"
                           class="w-full text-sm text-emerald-700 file:mr-4 file:py-2 file:px-4
                                  file:rounded-md file:border-0 file:text-sm file:font-semibold
                                  file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                    @error('gambar') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                {{-- Tombol Simpan --}}
                <div class="text-right">
                    <a href="{{ route('admin.makanan.index') }}"
                       class="inline-block text-emerald-500 hover:text-emerald-700 mr-4">Batal</a>
                    <button type="submit"
                            class="bg-emerald-700 hover:bg-emerald-800 text-white font-semibold px-5 py-2 rounded-lg shadow-md transition">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
