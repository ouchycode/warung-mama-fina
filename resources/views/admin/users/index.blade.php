@section('title', 'Kelola Pengguna | Warung Mama Fina')

<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-extrabold text-emerald-900 leading-tight tracking-tight">
            Kelola Pengguna
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            {{-- Notifikasi --}}
            @if (session('status'))
                <div class="mb-4 px-4 py-3 bg-emerald-100 text-emerald-800 border border-emerald-300 rounded shadow-sm">
                    {{ session('status') }}
                </div>
            @elseif (session('error'))
                <div class="mb-4 px-4 py-3 bg-red-100 text-red-800 border border-red-300 rounded shadow-sm">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Filter dan Pencarian --}}
            <div class="mb-6">
                <form method="GET" action="{{ route('admin.users.index') }}">
                    <div class="flex flex-col sm:flex-row sm:items-end gap-4">
                        {{-- Filter Peran --}}
                        <div class="w-full sm:w-1/3">
                            <label for="role" class="block text-sm font-medium text-emerald-800 mb-1">Filter Peran:</label>
                            <select name="role" id="role"
                                    class="w-full border border-emerald-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-600">
                                <option value="">-- Semua Peran --</option>
                                <option value="pegawai" {{ request('role') == 'pegawai' ? 'selected' : '' }}>Pegawai</option>
                                <option value="kurir" {{ request('role') == 'kurir' ? 'selected' : '' }}>Kurir</option>
                                <option value="pelanggan" {{ request('role') == 'pelanggan' ? 'selected' : '' }}>Pelanggan</option>
                            </select>
                        </div>

                        {{-- Pencarian --}}
                        <div class="w-full sm:w-1/3">
                            <label for="search" class="block text-sm font-medium text-emerald-800 mb-1">Cari Nama / Email:</label>
                            <input type="text" name="search" id="search" value="{{ request('search') }}"
                                   placeholder="Contoh: Andi, andi@mail.com"
                                   class="w-full border border-emerald-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-600">
                        </div>

                        {{-- Tombol --}}
                        <div class="flex gap-2">
                            <button type="submit"
                                    class="bg-emerald-700 hover:bg-emerald-800 text-white font-semibold px-5 py-2 rounded-md shadow-md transition duration-200">
                                Terapkan
                            </button>
                            @if(request()->has('role') || request()->has('search'))
                                <a href="{{ route('admin.users.index') }}"
                                   class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold px-5 py-2 rounded-md shadow-sm transition duration-200">
                                    Reset
                                </a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>

            {{-- Tabel Pengguna --}}
            <div class="bg-white shadow-xl border border-emerald-200 rounded-xl overflow-hidden">
                <table class="min-w-full divide-y divide-emerald-100 text-sm">
                    <thead class="bg-emerald-50 text-left">
                        <tr>
                            <th class="px-6 py-3 font-semibold text-emerald-700">Nama</th>
                            <th class="px-6 py-3 font-semibold text-emerald-700">Email</th>
                            <th class="px-6 py-3 font-semibold text-emerald-700">Peran</th>
                            <th class="px-6 py-3 text-right font-semibold text-emerald-700">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-emerald-100">
                        @forelse ($users as $user)
                            <tr>
                                <td class="px-6 py-4">{{ $user->name }}</td>
                                <td class="px-6 py-4">{{ $user->email }}</td>
                                <td class="px-6 py-4">
                                    <span class="inline-block px-3 py-1 text-xs rounded-full font-semibold
                                        {{
                                            match($user->role) {
                                                'pegawai' => 'bg-emerald-100 text-emerald-800',
                                                'kurir' => 'bg-lime-100 text-lime-800',
                                                'pelanggan' => 'bg-teal-100 text-teal-800',
                                                default => 'bg-slate-100 text-slate-700'
                                            }
                                        }}">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    @if ($user->role !== 'admin')
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pengguna ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="bg-red-600 hover:bg-red-700 text-white font-semibold px-5 py-2 rounded-lg shadow-md transition duration-200">
                                                Hapus
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-gray-400 italic text-sm">Tidak dapat dihapus</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-6 text-emerald-500 italic">Tidak ada pengguna dengan filter tersebut.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination (opsional) --}}
            <div class="mt-6">
                {{ $users->withQueryString()->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
