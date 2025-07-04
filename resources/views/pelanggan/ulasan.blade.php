<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-extrabold text-emerald-900 leading-tight tracking-tight">
            Ulasan Pesanan #{{ $pesanan->id }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-xl mx-auto">
        <div class="bg-white shadow-xl rounded-lg p-6 border border-emerald-200">
            <form action="{{ route('pelanggan.simpan-ulasan', $pesanan->id) }}" method="POST">
                @csrf

                {{-- Rating --}}
                <div class="mb-6">
                    <label class="block font-semibold text-emerald-800 mb-2">Nilai Rating (1-5)</label>
                    <input type="number" name="rating" value="{{ old('rating') }}" min="1" max="5"
                           class="w-full border border-emerald-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-600 transition transform hover:scale-105">
                    @error('rating') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                {{-- Komentar --}}
                <div class="mb-6">
                    <label class="block font-semibold text-emerald-800 mb-2">Komentar (opsional)</label>
                    <textarea name="komentar" class="w-full border border-emerald-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-600 transition transform hover:scale-105" rows="4">{{ old('komentar') }}</textarea>
                    @error('komentar') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                {{-- Tombol Submit --}}
                <div class="text-right">
                    <a href="{{ route('pelanggan.lacak') }}" class="text-emerald-500 hover:text-emerald-700 transition duration-200 mr-4">Batal</a>
                    <button type="submit" class="bg-emerald-700 hover:bg-emerald-800 text-white font-semibold px-5 py-2 rounded-lg shadow-md transition duration-300 transform hover:scale-105">
                        Kirim Ulasan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
