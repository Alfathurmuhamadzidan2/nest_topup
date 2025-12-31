@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">

    <div class="backdrop-blur-md bg-gray-800/40 border border-gray-700 rounded-xl shadow-xl p-8 animate-fadeIn">

        <h2 class="text-3xl font-bold mb-8 text-indigo-300 tracking-wide">
            ✨ Edit Pengguna
        </h2>

        @if (session('success'))
            <div class="mb-5 p-3 bg-green-700/40 text-green-200 border border-green-500 rounded">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.users.update', $user->id) }}" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- Input Nama --}}
            <div>
                <label class="block font-medium mb-1 text-gray-300">Nama</label>
                <input type="text"
                       name="name"
                       value="{{ old('name', $user->name) }}"
                       class="w-full rounded-lg bg-gray-900 border border-gray-700 text-gray-200 p-3
                              focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                @error('name')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Input Email --}}
            <div>
                <label class="block font-medium mb-1 text-gray-300">Email</label>
                <input type="email"
                       name="email"
                       value="{{ old('email', $user->email) }}"
                       class="w-full rounded-lg bg-gray-900 border border-gray-700 text-gray-200 p-3
                              focus:ring-2 focus:ring-indigo-500 transition">
                @error('email')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Select Role --}}
            <div>
                <label class="block font-medium mb-1 text-gray-300">Role</label>
                <select name="role"
                        class="w-full rounded-lg bg-gray-900 border border-gray-700 text-gray-200 p-3
                               focus:ring-2 focus:ring-indigo-500 transition">
                    <option value="user" {{ $user->role=='user'?'selected':'' }}>User</option>
                    <option value="admin" {{ $user->role=='admin'?'selected':'' }}>Admin</option>
                </select>
            </div>

            {{-- Tombol --}}
            <div class="flex gap-4 pt-4">
                <button
                    class="px-6 py-3 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white font-semibold
                           shadow-md hover:shadow-lg transition-all duration-300">
                    Simpan Perubahan
                </button>

                <a href="{{ route('admin.users.index') }}"
                   class="px-6 py-3 rounded-lg bg-gray-700 hover:bg-gray-600 text-gray-200 transition-all duration-300">
                    Kembali
                </a>
            </div>

        </form>
    </div>
</div>

{{-- Animasi FadeIn --}}
<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(12px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fadeIn { animation: fadeIn .4s ease-out; }
</style>
@endsection
