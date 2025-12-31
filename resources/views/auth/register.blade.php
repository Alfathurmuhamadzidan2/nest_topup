<x-guest-layout>
    <x-slot name="title">Daftar Akun</x-slot>

    <h2 class="text-xl font-semibold text-center mb-6 text-gray-200">Buat Akun Baru</h2>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-300">Nama Lengkap</label>
            <input id="name" class="block w-full mt-1 p-2.5 rounded-lg bg-[#111827] border border-gray-700 text-gray-200 
                focus:ring-2 focus:ring-orange-500 focus:outline-none transition duration-150"
                type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-400 text-sm" />
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-300">Email</label>
            <input id="email" class="block w-full mt-1 p-2.5 rounded-lg bg-[#111827] border border-gray-700 text-gray-200 
                focus:ring-2 focus:ring-orange-500 focus:outline-none transition duration-150"
                type="email" name="email" value="{{ old('email') }}" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400 text-sm" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-300">Password</label>
            <input id="password" class="block w-full mt-1 p-2.5 rounded-lg bg-[#111827] border border-gray-700 text-gray-200 
                focus:ring-2 focus:ring-orange-500 focus:outline-none transition duration-150"
                type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400 text-sm" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-300">Konfirmasi Password</label>
            <input id="password_confirmation" class="block w-full mt-1 p-2.5 rounded-lg bg-[#111827] border border-gray-700 text-gray-200 
                focus:ring-2 focus:ring-orange-500 focus:outline-none transition duration-150"
                type="password" name="password_confirmation" required autocomplete="new-password" />
        </div>

        <div class="mt-6">
            <button type="submit" 
                class="w-full py-2.5 bg-orange-500 hover:bg-orange-400 text-black font-semibold rounded-lg 
                       transition duration-200 focus:ring-4 focus:ring-orange-600/50">
                Daftar
            </button>
        </div>

        <p class="text-center text-sm text-gray-400 mt-4">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-orange-400 hover:text-orange-300 font-medium">Masuk</a>
        </p>
    </form>
</x-guest-layout>
