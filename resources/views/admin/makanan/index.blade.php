@section('title', 'Daftar Barang | Warung Mama Fina')

<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-extrabold text-emerald-900 leading-tight tracking-tight">
            Daftar Barang
        </h2>
    </x-slot>

    <div class="py-8 max-w-5xl mx-auto">
        @if (session('status'))
            <div class="mb-4 bg-emerald-100 border border-emerald-300 text-emerald-800 px-4 py-3 rounded shadow">
                {{ session('status') }}
            </div>
        @endif

        <div class="mb-4 text-right">
            <a href="{{ route('admin.makanan.create') }}"
               class="bg-emerald-700 hover:bg-emerald-800 text-white py-2 px-4 rounded-lg shadow transition">
                Tambah Barang
            </a>
        </div>

        <div class="bg-white shadow rounded-lg border border-emerald-200 overflow-x-auto">
            <table class="min-w-full text-sm text-left border-collapse">
                <thead class="bg-emerald-50 text-emerald-700 uppercase text-xs">
                    <tr>
                        <th class="px-4 py-3">Gambar</th>
                        <th class="px-4 py-3">Nama</th>
                        <th class="px-4 py-3">Kategori</th>
                        <th class="px-4 py-3">Harga</th>
                        <th class="px-4 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-emerald-800">
                    @forelse ($makanan as $item)
                        <tr class="border-t hover:bg-emerald-50 transition">
                            <td class="px-4 py-3">
                                @if ($item->gambar)
                                    <img src="{{ asset('storage/' . $item->gambar) }}" alt="gambar" class="w-14 h-14 object-cover rounded-md border border-emerald-200">
                                @else
                                    <span class="text-emerald-400 italic">Tidak ada</span>
                                @endif
                            </td>
                            <td class="px-4 py-3">{{ $item->nama }}</td>
                            <td class="px-4 py-3">{{ $item->kategori ?? '-' }}</td>
                            <td class="px-4 py-3">Rp{{ number_format($item->harga) }}</td>
                            <td class="px-4 py-3 text-right space-x-2">
                                <!-- Tombol Edit -->
                                <a href="{{ route('admin.makanan.edit', $item) }}"
                                   class="bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-5 py-2 rounded-lg shadow-md transition duration-200">
                                    Edit
                                </a>

                                <!-- Tombol Hapus -->
                                <form action="{{ route('admin.makanan.destroy', $item) }}" method="POST" class="inline-block"
                                      onsubmit="return confirm('Yakin ingin menghapus barang ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                            class="bg-red-600 hover:bg-red-700 text-white font-semibold px-5 py-2 rounded-lg shadow-md transition duration-200">
                                            Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-emerald-400 py-6 italic">Belum ada barang tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
