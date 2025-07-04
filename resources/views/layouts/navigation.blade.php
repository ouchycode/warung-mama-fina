@php
    $role = Auth::user()->role;
@endphp

<nav x-data="{ open: false }" class="bg-emerald-800 border-b border-emerald-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center gap-6">
                <!-- Logo diganti jadi huruf WMF -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="text-white text-2xl font-extrabold tracking-wide hover:text-emerald-300 transition">
                        WMF
                    </a>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden sm:flex space-x-6">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-white hover:text-emerald-300">
                        Beranda
                    </x-nav-link>

                    @if($role === 'admin')
                        <x-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')" class="text-white hover:text-emerald-300">
                            Pengguna
                        </x-nav-link>
                        <x-nav-link :href="route('admin.makanan.index')" :active="request()->routeIs('admin.makanan.*')" class="text-white hover:text-emerald-300">
                            Barang
                        </x-nav-link>
                        <x-nav-link :href="route('admin.ulasan.index')" :active="request()->routeIs('admin.ulasan.*')" class="text-white hover:text-emerald-300">
                            Ulasan
                        </x-nav-link>
                    @elseif($role === 'pegawai')
                        <x-nav-link :href="route('pegawai.pesanan')" :active="request()->routeIs('pegawai.pesanan')" class="text-white hover:text-emerald-300">
                            Verifikasi Pesanan
                        </x-nav-link>
                    @elseif($role === 'kurir')
                        <x-nav-link :href="route('kurir.pesanan')" :active="request()->routeIs('kurir.pesanan')" class="text-white hover:text-emerald-300">
                            Pengiriman
                        </x-nav-link>
                    @elseif($role === 'pelanggan')
                        <x-nav-link :href="route('pelanggan.pesan')" :active="request()->routeIs('pelanggan.pesan')" class="text-white hover:text-emerald-300">
                            Pesan
                        </x-nav-link>
                        <x-nav-link :href="route('pelanggan.lacak')" :active="request()->routeIs('pelanggan.lacak')" class="text-white hover:text-emerald-300">
                            Lacak
                        </x-nav-link>
                        <x-nav-link :href="route('pelanggan.riwayat')" :active="request()->routeIs('pelanggan.riwayat')" class="text-white hover:text-emerald-300">
                            Riwayat
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-emerald-800 hover:bg-emerald-700 transition">
                            {{ Auth::user()->name }}
                            <svg class="ms-2 w-4 h-4 fill-current" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0L5.293 8.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            Profil
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                Keluar
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger (Mobile) -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = !open"
                        class="p-2 rounded-md text-white hover:bg-emerald-700 focus:outline-none transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="sm:hidden bg-emerald-700 text-white">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                Beranda
            </x-responsive-nav-link>

            @if($role === 'admin')
                <x-responsive-nav-link :href="route('admin.users.index')">Pengguna</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.makanan.index')">Barang</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.ulasan.index')">Ulasan</x-responsive-nav-link>
            @elseif($role === 'pegawai')
                <x-responsive-nav-link :href="route('pegawai.pesanan')">Verifikasi Pesanan</x-responsive-nav-link>
            @elseif($role === 'kurir')
                <x-responsive-nav-link :href="route('kurir.pesanan')">Pengiriman</x-responsive-nav-link>
            @elseif($role === 'pelanggan')
                <x-responsive-nav-link :href="route('pelanggan.pesan')">Pesan</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('pelanggan.lacak')">Lacak</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('pelanggan.riwayat')">Riwayat</x-responsive-nav-link>
            @endif
        </div>

        <div class="pt-4 pb-1 border-t border-emerald-600">
            <div class="px-4">
                <div class="font-medium">{{ Auth::user()->name }}</div>
                <div class="text-sm text-emerald-100">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">Profil</x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                        Keluar
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
