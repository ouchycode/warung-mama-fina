@section('title', 'Daftarkan Akun | Warung Mama Fina')


<x-guest-layout>
    <div class="max-w-md mx-auto mt-12 bg-white p-8 rounded-2xl shadow-xl border border-emerald-200">
        <!-- Judul Branding -->
        <h2 class="text-3xl font-extrabold text-emerald-700 text-center mb-2">Warung Mama Fina</h2>
        <p class="text-center text-slate-600 text-sm mb-6">
            Daftar akun baru untuk mulai berbelanja kebutuhan harian Anda
        </p>

        <!-- Form -->
        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf

            <!-- Nama -->
            <div>
                <label for="name" class="block text-sm font-medium text-emerald-800">Nama Lengkap</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                       class="mt-1 block w-full border border-slate-300 rounded-md shadow-sm px-4 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-500">
                @error('name') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-emerald-800">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required
                       class="mt-1 block w-full border border-slate-300 rounded-md shadow-sm px-4 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-500">
                @error('email') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-emerald-800">Password</label>
                <input id="password" type="password" name="password" required autocomplete="new-password"
                       class="mt-1 block w-full border border-slate-300 rounded-md shadow-sm px-4 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-500">
                @error('password') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>

            <!-- Konfirmasi Password -->
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-emerald-800">Konfirmasi Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required
                       class="mt-1 block w-full border border-slate-300 rounded-md shadow-sm px-4 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-500">
                @error('password_confirmation') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>

            <!-- Hidden Role (Otomatis pelanggan) -->
            <input type="hidden" name="role" value="pelanggan">

            <!-- Tombol Daftar -->
            <div class="flex items-center justify-between pt-4">
                <a href="{{ route('login') }}" class="text-sm text-slate-500 hover:text-slate-700">
                    Sudah punya akun?
                </a>
                <button type="submit"
                        class="bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-6 py-2 rounded-lg shadow-md transition duration-200">
                    Daftar
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>
