@extends('layouts.app')

@section('content')

<div class="max-w-6xl mx-auto">

    <h1 class="text-3xl font-bold mb-6 text-indigo-300">📑 Transaksi Pengguna</h1>

    <div class="overflow-x-auto backdrop-blur-md bg-gray-800/40 border border-gray-700 rounded-xl shadow-xl animate-fadeIn">

        <table class="w-full text-left">
            <thead>
                <tr class="bg-gray-900/50 border-b border-gray-700 text-gray-300 text-sm">
                    <th class="p-3">User</th>
                    <th class="p-3">Produk</th>
                    <th class="p-3">Varian</th>
                    <th class="p-3">Harga</th>
                    <th class="p-3">Metode</th>
                    <th class="p-3">Status</th>
                    <th class="p-3">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($transactions as $trx)
                <tr class="border-b border-gray-800 hover:bg-gray-700/40 transition">
                    
                    {{-- User --}}
                    <td class="p-3 text-gray-200">
                        {{ $trx->user->name ?? 'User dihapus' }}
                    </td>

                    {{-- Produk --}}
                    <td class="p-3 text-gray-300">
                        {{ $trx->product->name ?? 'Produk dihapus' }}
                    </td>

                    {{-- Varian --}}
                    <td class="p-3 text-gray-400">
                        {{ $trx->variant->name ?? '-' }}
                    </td>

                    {{-- Harga --}}
                    <td class="p-3 text-indigo-400 font-medium">
                        Rp {{ number_format($trx->total_price) }}
                    </td>

                    {{-- Metode --}}
                    <td class="p-3 text-gray-300 uppercase">
                        {{ $trx->payment_method }}
                    </td>

                    {{-- Status --}}
                    <td class="p-3">
                        @php
                            $statusColor = [
                                'pending' => 'bg-yellow-500/20 text-yellow-300 border-yellow-500/40',
                                'success' => 'bg-green-500/20 text-green-300 border-green-500/40',
                                'failed'  => 'bg-red-500/20 text-red-300 border-red-500/40',
                            ];
                        @endphp
                        
                        <span class="px-3 py-1 rounded-lg border text-sm {{ $statusColor[$trx->status] ?? '' }}">
                            {{ ucfirst($trx->status) }}
                        </span>
                    </td>

                    {{-- Aksi --}}
                    <td class="p-3">
                        <form action="{{ route('admin.transactions.updateStatus', $trx->id) }}" method="POST" class="flex gap-2">
                            @csrf
                            
                            <select name="status"
                                class="bg-gray-900/60 border border-gray-700 text-gray-300 rounded-lg p-1 text-sm focus:ring focus:ring-indigo-500">
                                <option value="pending" {{ $trx->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="success" {{ $trx->status == 'success' ? 'selected' : '' }}>Success</option>
                                <option value="failed" {{ $trx->status == 'failed' ? 'selected' : '' }}>Failed</option>
                            </select>

                            <button
                                class="px-3 py-1 text-sm rounded-lg bg-indigo-600 hover:bg-indigo-500 text-white shadow-sm transition">
                                Update
                            </button>
                        </form>
                    </td>

                </tr>
                @endforeach
            </tbody>

        </table>

    </div>
</div>

{{-- Animasi --}}
<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fadeIn { animation: fadeIn .4s ease-out; }
</style>

@endsection
