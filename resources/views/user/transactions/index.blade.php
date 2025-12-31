@extends('layouts.app')

@section('title', 'Riwayat Transaksi')

@section('content')
<div class="max-w-5xl mx-auto text-gray-100">

    {{-- HEADER --}}
    <h1 class="text-3xl font-bold mb-6 text-white">Riwayat Transaksi Saya</h1>

    {{-- ALERT --}}
    @if(session('success'))
        <div class="mb-4 p-4 bg-green-600/20 border border-green-700 text-green-400 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-4 p-4 bg-red-600/20 border border-red-700 text-red-400 rounded-lg">
            {{ session('error') }}
        </div>
    @endif

    {{-- JIKA TIDAK ADA DATA --}}
    @if ($transactions->isEmpty())
        <div class="p-6 bg-[#0E0E2C] border border-gray-700 rounded-xl text-center text-gray-400">
            Belum ada transaksi.
        </div>
    @endif

    {{-- LIST TRANSAKSI --}}
    <div class="space-y-5">
        @foreach ($transactions as $trx)
            <div class="bg-[#0E0E2C] border border-gray-700 rounded-xl p-5 flex flex-col md:flex-row gap-5">

                {{-- GAMBAR PRODUK --}}
                <div class="w-28 h-28 border border-gray-700 rounded-lg overflow-hidden bg-black/40">
                    @if ($trx->product && $trx->product->image)
                        <img src="{{ asset('storage/' . $trx->product->image) }}" class="w-full h-full object-cover">
                    @else
                        <div class="flex items-center justify-center h-full text-gray-500">
                            No Image
                        </div>
                    @endif
                </div>

                {{-- DETAIL --}}
                <div class="flex-1">
                    <h2 class="text-xl font-bold text-white">
                        {{ $trx->product->name ?? 'Produk Dihapus' }}
                    </h2>

                    <p class="text-gray-400 text-sm mt-1">
                        Varian: <span class="text-gray-300">{{ $trx->variant->name ?? '-' }}</span>
                    </p>

                    <p class="text-gray-400 text-sm mt-1">
                        Metode Pembayaran: <span class="text-gray-300">{{ ucfirst($trx->payment_method) }}</span>
                    </p>

                    <p class="text-gray-400 text-sm mt-1">
                        Account ID: <span class="text-gray-300">{{ $trx->account_id }}</span>
                    </p>

                    <p class="text-gray-400 text-sm mt-1">
                        Kontak: <span class="text-gray-300">{{ $trx->contact }}</span>
                    </p>

                    <p class="text-gray-300 font-semibold text-lg mt-3">
                        Total Harga:
                        <span class="text-green-400">
                            Rp {{ number_format($trx->total_price, 0, ',', '.') }}
                        </span>
                    </p>
                </div>

                {{-- STATUS + TANGGAL --}}
                <div class="flex flex-col justify-between text-right">

                    {{-- STATUS BADGE --}}
                    @if ($trx->status === 'success')
                        <span class="px-3 py-1 bg-green-600/20 text-green-400 border border-green-700 rounded-full text-sm">
                            Sukses
                        </span>
                    @elseif ($trx->status === 'pending')
                        <span class="px-3 py-1 bg-yellow-600/20 text-yellow-400 border border-yellow-700 rounded-full text-sm">
                            Pending
                        </span>
                    @else
                        <span class="px-3 py-1 bg-red-600/20 text-red-400 border border-red-700 rounded-full text-sm">
                            Gagal
                        </span>
                    @endif

                    <span class="text-gray-400 text-sm mt-3">
                        {{ $trx->created_at->format('d M Y - H:i') }}
                    </span>
                </div>
            </div>
        @endforeach
    </div>

</div>
@endsection
