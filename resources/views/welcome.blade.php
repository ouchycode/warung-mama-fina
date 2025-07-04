<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Warung Mama Fina</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 dark:bg-gray-900 font-sans antialiased">

    <div class="min-h-screen flex flex-col justify-center items-center px-6 lg:px-8">
        <!-- Header -->
        <header class="w-full max-w-7xl mx-auto flex justify-between items-center py-8">
            <div class="text-2xl font-bold text-emerald-600 dark:text-emerald-400">
                WARUNG MAMA FINA
            </div>
            <nav class="flex gap-3">
                @auth
                    <a href="{{ url('/dashboard') }}"
                       class="bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-300">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}"
                       class="bg-white dark:bg-gray-700 border border-emerald-500 text-emerald-700 dark:text-white hover:bg-emerald-600 hover:text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-300">
                        Login
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                           class="bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-300">
                            Register
                        </a>
                    @endif
                @endauth
            </nav>
        </header>
        
        <!-- Main Content -->
        <main class="w-full max-w-7xl grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Produk -->
            <div class="rounded-lg bg-white dark:bg-gray-800 shadow-md p-6 ring-1 ring-gray-200 dark:ring-gray-700">
                <div class="flex items-center gap-4">
                    <div class="bg-emerald-100 dark:bg-emerald-800 p-3 rounded-full text-xl">🛒</div>
                    <h2 class="text-lg font-bold text-gray-800 dark:text-white">Sembako Lengkap</h2>
                </div>
                <p class="mt-4 text-sm text-gray-600 dark:text-gray-400">
                    Warung Mama Fina menyediakan kebutuhan harian seperti beras, minyak, telur, gula, sabun, mie instan, dan banyak lagi.
                </p>
            </div>

            <!-- Harga -->
            <div class="rounded-lg bg-white dark:bg-gray-800 shadow-md p-6 ring-1 ring-gray-200 dark:ring-gray-700">
                <div class="flex items-center gap-4">
                    <div class="bg-emerald-100 dark:bg-emerald-800 p-3 rounded-full text-xl">💰</div>
                    <h2 class="text-lg font-bold text-gray-800 dark:text-white">Harga Terjangkau</h2>
                </div>
                <p class="mt-4 text-sm text-gray-600 dark:text-gray-400">
                    Kami selalu menjaga harga tetap bersahabat agar bisa menjangkau seluruh lapisan masyarakat.
                </p>
            </div>

            <!-- Lokasi -->
            <div class="rounded-lg bg-white dark:bg-gray-800 shadow-md p-6 ring-1 ring-gray-200 dark:ring-gray-700">
                <div class="flex items-center gap-4">
                    <div class="bg-emerald-100 dark:bg-emerald-800 p-3 rounded-full text-xl">📍</div>
                    <h2 class="text-lg font-bold text-gray-800 dark:text-white">Lokasi Strategis</h2>
                </div>
                <p class="mt-4 text-sm text-gray-600 dark:text-gray-400">
                    Terletak di jantung perumahan warga, mudah dijangkau dan tersedia parkir motor yang luas.
                </p>
            </div>

            <!-- Pelayanan -->
            <div class="rounded-lg bg-white dark:bg-gray-800 shadow-md p-6 ring-1 ring-gray-200 dark:ring-gray-700">
                <div class="flex items-center gap-4">
                    <div class="bg-emerald-100 dark:bg-emerald-800 p-3 rounded-full text-xl">😊</div>
                    <h2 class="text-lg font-bold text-gray-800 dark:text-white">Pelayanan Ramah</h2>
                </div>
                <p class="mt-4 text-sm text-gray-600 dark:text-gray-400">
                    Mama Fina melayani setiap pelanggan dengan senyuman dan keramahan yang tulus. Belanja jadi nyaman dan akrab!
                </p>
            </div>
        </main>

        <!-- Footer -->
        <footer class="mt-12 text-center text-sm text-gray-500 dark:text-gray-400">
            &copy; 2025 Kevin Ardiansyah. All rights reserved.
        </footer>
    </div>

</body>
</html>
