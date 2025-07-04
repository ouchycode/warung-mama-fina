@section('title', 'Masuk | Warung Mama Fina')


<x-guest-layout>
    <!-- Status Session -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Header Branding -->
    <div class="text-center mb-6">
        <h1 class="text-3xl font-extrabold text-emerald-700">Warung Mama Fina</h1>
        <p class="text-sm text-slate-600 dark:text-slate-300">Masuk ke akun Anda untuk belanja kebutuhan harian</p>
    </div>

    <!-- Login Form -->
    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-emerald-700" />
            <x-text-input id="email" class="block mt-1 w-full border border-slate-300 focus:ring-2 focus:ring-emerald-500 rounded-md"
                          type="email"
                          name="email"
                          :value="old('email')"
                          required
                          autofocus
                          autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" class="text-emerald-700" />
            <x-text-input id="password" class="block mt-1 w-full border border-slate-300 focus:ring-2 focus:ring-emerald-500 rounded-md"
                          type="password"
                          name="password"
                          required
                          autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500" />
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                       class="rounded border-slate-300 text-emerald-600 shadow-sm focus:ring-emerald-500"
                       name="remember">
                <span class="ml-2 text-sm text-slate-600 dark:text-slate-300">Ingat saya</span>
            </label>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}"
                   class="text-sm text-emerald-600 hover:underline dark:text-emerald-400">
                    Lupa password?
                </a>
            @endif
        </div>

        <!-- Submit -->
        <div>
            <x-primary-button class="w-full bg-emerald-600 hover:bg-emerald-700 text-white focus:ring-2 focus:ring-emerald-500">
                Masuk
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
