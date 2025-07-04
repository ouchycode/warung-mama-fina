@section('title', 'Daftarkan Akun | Warung Mama Fina')
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-bold text-emerald-800 leading-tight">
            Daftarkan Akun Baru
        </h2>
    </x-slot>

    <div class="max-w-lg mx-auto mt-10 bg-white p-8 rounded-xl shadow-lg border border-emerald-200">
        <form method="POST" action="{{ route('admin.register-user.store') }}">
            @csrf

            <div class="mb-4">
                <label for="name" class="block font-medium text-emerald-700">Nama</label>
                <input type="text" name="name" id="name" required value="{{ old('name') }}"
                       class="mt-1 w-full border border-slate-300 rounded-md px-4 py-2 focus:ring-emerald-500">
                @error('name') <div class="text-red-500 text-sm mt-1">{{ $message }}</div> @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block font-medium text-emerald-700">Email</label>
                <input type="email" name="email" id="email" required value="{{ old('email') }}"
                       class="mt-1 w-full border border-slate-300 rounded-md px-4 py-2 focus:ring-emerald-500">
                @error('email') <div class="text-red-500 text-sm mt-1">{{ $message }}</div> @enderror
            </div>

            <div class="mb-4">
                <label for="role" class="block font-medium text-emerald-700">Role</label>
                <select name="role" id="role" required class="mt-1 w-full border border-slate-300 rounded-md px-4 py-2 focus:ring-emerald-500">
                    <option value="">-- Pilih Role --</option>
                    <option value="admin">Admin</option>
                    <option value="pegawai">Pegawai</option>
                    <option value="kurir">Kurir</option>
                </select>
                @error('role') <div class="text-red-500 text-sm mt-1">{{ $message }}</div> @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block font-medium text-emerald-700">Password</label>
                <input type="password" name="password" id="password" required
                       class="mt-1 w-full border border-slate-300 rounded-md px-4 py-2 focus:ring-emerald-500">
                @error('password') <div class="text-red-500 text-sm mt-1">{{ $message }}</div> @enderror
            </div>

            <div class="mb-6">
                <label for="password_confirmation" class="block font-medium text-emerald-700">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required
                       class="mt-1 w-full border border-slate-300 rounded-md px-4 py-2 focus:ring-emerald-500">
            </div>

            <div class="text-right">
                <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-6 py-2 rounded-lg shadow">
                    Daftarkan Akun
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
