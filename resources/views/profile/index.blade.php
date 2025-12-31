<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight flex items-center gap-3">
            <span class="inline-block w-2 h-6 bg-orange-500 rounded"></span>
            {{ __('Profil Pengguna') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-10">

            {{-- CARD: Update Profile --}}
            <div class="bg-white/90 dark:bg-gray-800/80 backdrop-blur-xl shadow-lg rounded-2xl p-8 border border-gray-200/40 dark:border-gray-700/50 
                        hover:shadow-orange-500/20 transition duration-300 transform hover:scale-[1.01]">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-6 flex items-center gap-2">
                    <svg class="w-6 h-6 text-orange-400" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M5.121 17.804A5 5 0 1115.95 7.05l-7.778 7.778a5 5 0 01-3.05 3.05z"/>
                        <path d="M12 9l3 3"/>
                    </svg>
                    Informasi Profil
                </h3>
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            {{-- CARD: Update Password --}}
            <div class="bg-white/90 dark:bg-gray-800/80 backdrop-blur-xl shadow-lg rounded-2xl p-8 border border-gray-200/40 dark:border-gray-700/50
                        hover:shadow-orange-500/20 transition duration-300 transform hover:scale-[1.01]">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-6 flex items-center gap-2">
                    <svg class="w-6 h-6 text-orange-400" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M5 13l4 4L19 7"/>
                    </svg>
                    Ganti Password
                </h3>
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            {{-- CARD: Delete Account (Admin Only) --}}
            @if(auth()->user()->role === 'admin')
            <div class="bg-red-50/70 dark:bg-red-900/20 backdrop-blur-xl shadow-lg rounded-2xl p-8 border border-red-300/40 dark:border-red-700/40
                        hover:shadow-red-500/30 transition duration-300 transform hover:scale-[1.01]">
                <h3 class="text-xl font-semibold text-red-700 dark:text-red-300 mb-6 flex items-center gap-2">
                    <svg class="w-6 h-6 text-red-500 dark:text-red-400" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M9 13h6m2 9H7a2 2 0 01-2-2V7h14v13a2 2 0 01-2 2z"/>
                        <path d="M10 7V4h4v3"/>
                    </svg>
                    Hapus Akun
                </h3>
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
            @endif

        </div>
    </div>
</x-app-layout>
