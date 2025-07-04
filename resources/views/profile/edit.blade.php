<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-extrabold text-emerald-900 leading-tight tracking-tight">
            Profil Pengguna
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto px-6 lg:px-8 space-y-8">

            {{-- Update Profile Information --}}
            <div class="bg-white border border-emerald-200 shadow-xl rounded-2xl p-8">
                <h3 class="text-xl font-bold text-emerald-800 mb-4">Informasi Profil</h3>
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            {{-- Update Password --}}
            <div class="bg-white border border-emerald-200 shadow-xl rounded-2xl p-8">
                <h3 class="text-xl font-bold text-emerald-800 mb-4">Ganti Password</h3>
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            {{-- Delete Account --}}
            <div class="bg-white border border-emerald-200 shadow-xl rounded-2xl p-8">
                <h3 class="text-xl font-bold text-emerald-800 mb-4">Hapus Akun</h3>
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
