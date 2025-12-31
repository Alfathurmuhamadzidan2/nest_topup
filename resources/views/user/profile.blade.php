@extends('layouts.app')

@section('title', 'Profil')

@section('content')
<div class="bg-[#0b1220] rounded-xl p-6 shadow-lg border border-gray-800">
    <h2 class="text-2xl font-semibold mb-4">Pengaturan Profil</h2>

    <form action="{{ route('user.profile.update') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block text-gray-400 mb-1">Nama</label>
            <input type="text" name="name" value="{{ $user->name }}"
                   class="w-full bg-[#111827] border border-gray-700 rounded-lg px-3 py-2 text-white">
        </div>

        <div>
            <label class="block text-gray-400 mb-1">Email</label>
            <input type="email" name="email" value="{{ $user->email }}"
                   class="w-full bg-[#111827] border border-gray-700 rounded-lg px-3 py-2 text-white">
        </div>

        <button class="bg-orange-500 hover:bg-orange-400 text-black font-semibold px-5 py-2 rounded-lg">
            Simpan Perubahan
        </button>
    </form>
</div>
@endsection
