@extends('layouts.app')

@section('title', 'Daftar Pengguna')

@section('content')

<div class="bg-[#0b1220] border border-gray-800 rounded-xl p-6 shadow-lg">

    {{-- HEADER --}}
    <div class="flex flex-col md:flex-row justify-between md:items-center gap-4 mb-6">
        <h1 class="text-2xl font-semibold text-orange-400">Daftar Pengguna</h1>

        {{-- SEARCH + FILTER + SORT --}}
        <form method="GET" class="flex flex-wrap gap-3">

            {{-- Search --}}
            <input
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari nama atau email..."
                class="px-4 py-2 rounded-lg bg-black/40 border border-gray-700 text-gray-200 placeholder-gray-500 focus:ring-2 focus:ring-orange-500 focus:outline-none"
            >

            {{-- Filter role --}}
            <select name="role" class="px-4 py-2 rounded-lg bg-black/40 border border-gray-700 text-gray-200">
                <option value="">Semua Role</option>
                <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>User</option>
            </select>

            {{-- Sort --}}
            <select name="sort" class="px-4 py-2 rounded-lg bg-black/40 border border-gray-700 text-gray-200">
                <option value="">Urutkan</option>
                <option value="name_asc"  {{ request('sort')=='name_asc' ? 'selected' : '' }}>Nama A–Z</option>
                <option value="name_desc" {{ request('sort')=='name_desc' ? 'selected' : '' }}>Nama Z–A</option>
                <option value="balance_desc" {{ request('sort')=='balance_desc' ? 'selected' : '' }}>Saldo Tertinggi</option>
                <option value="balance_asc" {{ request('sort')=='balance_asc' ? 'selected' : '' }}>Saldo Terendah</option>
            </select>

            {{-- Submit Button --}}
            <button class="px-4 py-2 bg-orange-500 text-black font-semibold rounded-lg hover:bg-orange-400 transition">
                Terapkan
            </button>
        </form>
    </div>


    {{-- TABLE --}}
    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-800 rounded-xl overflow-hidden">
            <thead class="bg-black/40 text-gray-400 uppercase text-sm">
                <tr>
                    <th class="p-3 text-left">Nama</th>
                    <th class="p-3 text-left">Email</th>
                    <th class="p-3 text-left">Saldo</th>
                    <th class="p-3 text-left">Role</th>
                    <th class="p-3 text-left">Dibuat</th>
                    <th class="p-3 text-left">Aksi</th>
                </tr>
            </thead>

            <tbody class="text-gray-300">
                @forelse ($users as $u)
                <tr class="border-t border-gray-800 hover:bg-black/30 transition">
                    <td class="p-3 font-medium">{{ $u->name }}</td>
                    <td class="p-3">{{ $u->email }}</td>
                    <td class="p-3 text-orange-400 font-semibold">Rp {{ number_format($u->balance) }}</td>
                    <td class="p-3 capitalize">{{ $u->role }}</td>
                    <td class="p-3">{{ $u->created_at->format('d/m/Y') }}</td>

                    <td class="p-3 flex gap-2">

                        {{-- EDIT --}}
                        <a href="{{ route('admin.users.edit', $u->id) }}"
                            class="px-3 py-1 bg-indigo-500 text-white rounded hover:bg-indigo-400 transition text-sm">
                            Edit
                        </a>

                        {{-- DELETE --}}
                        <form method="POST" action="{{ route('admin.users.delete', $u->id) }}"
                              onsubmit="return confirm('Hapus pengguna ini?')">
                            @csrf
                            @method('DELETE')

                            <button class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-500 transition text-sm">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="p-6 text-center text-gray-400">
                        Tidak ada data pengguna ditemukan.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>


    {{-- PAGINATION --}}
    <div class="mt-6">
        {{ $users->appends(request()->query())->links('vendor.pagination.tailwind') }}
    </div>
</div>

@endsection
