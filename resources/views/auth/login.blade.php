<x-guest-layout>
    <x-slot name="title">Masuk Akun</x-slot>

    <h2 class="text-xl font-semibold text-center mb-6 text-gray-200">Masuk ke Akun Anda</h2>

    <!-- Session Status -->
    @if (session('status'))
        <div class="mb-4 text-green-400 text-sm text-center">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-300">Email</label>
            <input id="email" class="block w-full mt-1 p-2.5 rounded-lg bg-[#111827] border border-gray-700 text-gray-200 
                focus:ring-2 focus:ring-orange-500 focus:outline-none transition duration-150"
                type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400 text-sm" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-300">Password</label>
            <input id="password" class="block w-full mt-1 p-2.5 rounded-lg bg-[#111827] border border-gray-700 text-gray-200 
                focus:ring-2 focus:ring-orange-500 focus:outline-none transition duration-150"
                type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400 text-sm" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between mt-2">
            <label for="remember_me" class="flex items-center">
                <input id="remember_me" type="checkbox" name="remember" 
                    class="rounded border-gray-600 bg-[#111827] text-orange-500 focus:ring-orange-400">
                <span class="ms-2 text-sm text-gray-400">Ingat saya</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-orange-400 hover:text-orange-300 transition" 
                   href="{{ route('password.request') }}">
                    Lupa password?
                </a>
            @endif
        </div>

        <div class="mt-6">
            <button type="submit" 
                class="w-full py-2.5 bg-orange-500 hover:bg-orange-400 text-black font-semibold rounded-lg 
                       transition duration-200 focus:ring-4 focus:ring-orange-600/50">
                Masuk
            </button>
        </div>

        <p class="text-center text-sm text-gray-400 mt-4">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-orange-400 hover:text-orange-300 font-medium">Daftar Sekarang</a>
        </p>
    </form>
</x-guest-layout>
