<section class="space-y-6">
    <header>
        <h2 class="text-lg font-semibold text-red-600 dark:text-red-400 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M9 13h6m2 9H7a2 2 0 01-2-2V7h14v13a2 2 0 01-2 2z"/>
                <path d="M10 7V4h4v3"/>
            </svg>
            {{ __('Hapus Akun') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400 leading-relaxed">
            {{ __('Setelah akun Anda dihapus, semua data akan hilang permanen. Pastikan Anda telah mengunduh atau menyimpan data penting sebelum melanjutkan.') }}
        </p>
    </header>

    {{-- Tombol Hapus Akun --}}
    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="!bg-red-600 hover:!bg-red-700 focus:ring-red-500"
    >
        {{ __('Hapus Akun') }}
    </x-danger-button>

    {{-- Modal Konfirmasi --}}
    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('user.profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-2">
                {{ __('Apakah Anda yakin ingin menghapus akun ini?') }}
            </h2>

            <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">
                {{ __('Tindakan ini tidak dapat dibatalkan. Masukkan password Anda untuk mengonfirmasi.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Masukkan password Anda') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Batal') }}
                </x-secondary-button>

                <x-danger-button class="!bg-red-600 hover:!bg-red-700 focus:ring-red-500">
                    {{ __('Hapus Akun') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
