@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="max-w-6xl mx-auto text-gray-100">

    {{-- 🔹 HEADER --}}
    <h1 class="text-3xl font-bold mb-6 text-white">Dashboard Admin</h1>

    {{-- 🔹 CARD STATISTIK --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-[#1E1E45] rounded-xl p-6 shadow-md border border-gray-700">
            <h2 class="text-sm font-medium text-gray-400">Total Pengguna</h2>
            <p class="text-3xl font-bold text-orange-400 mt-1">{{ $totalUsers ?? 0 }}</p>
        </div>

        <div class="bg-[#1E1E45] rounded-xl p-6 shadow-md border border-gray-700">
            <h2 class="text-sm font-medium text-gray-400">Total Transaksi</h2>
            <p class="text-3xl font-bold text-green-400 mt-1">{{ $totalTransactions ?? 0 }}</p>
        </div>

        <div class="bg-[#1E1E45] rounded-xl p-6 shadow-md border border-gray-700">
            <h2 class="text-sm font-medium text-gray-400">Total Pendapatan</h2>
            <p class="text-3xl font-bold text-yellow-400 mt-1">Rp {{ number_format($totalRevenue ?? 0, 0, ',', '.') }}</p>
        </div>
    </div>

    {{-- 🔹 TABEL TRANSAKSI --}}
    <div class="mt-10">
        <h2 class="text-xl font-semibold mb-4 text-white">Transaksi Terbaru</h2>
        <div class="bg-[#0E0E2C] rounded-xl shadow-lg overflow-x-auto border border-gray-700">
            <table class="min-w-full text-sm text-gray-200">
                <thead class="bg-[#1E1E45] text-orange-400">
                    <tr>
                        <th class="px-4 py-3 text-left">Kode</th>
                        <th class="px-4 py-3 text-left">User</th>
                        <th class="px-4 py-3 text-left">Produk</th>
                        <th class="px-4 py-3 text-center">Status</th>
                        <th class="px-4 py-3 text-center">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($recentTransactions as $trx)
                        <tr class="border-b border-gray-700 hover:bg-[#1E1E45]/50 transition">
                            <td class="px-4 py-3">{{ $trx->reference }}</td>
                            <td class="px-4 py-3 text-gray-300">{{ $trx->user->name }}</td>
                            <td class="px-4 py-3 text-gray-300">{{ $trx->product->name }}</td>
                            <td class="px-4 py-3 text-center">
                                @php
                                    $color = match($trx->status) {
                                        'success' => 'text-green-400',
                                        'pending' => 'text-yellow-400',
                                        'failed' => 'text-red-400',
                                        default => 'text-gray-300'
                                    };
                                @endphp
                                <span class="{{ $color }} font-semibold">{{ ucfirst($trx->status) }}</span>
                            </td>
                            <td class="px-4 py-3 text-center text-gray-400">{{ $trx->created_at->format('d M Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-6 text-gray-500">Belum ada transaksi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
