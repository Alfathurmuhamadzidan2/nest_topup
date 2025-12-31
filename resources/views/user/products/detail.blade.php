@extends('layouts.app')
@section('title', 'Top Up ' . $product->name)

@section('content')
<div class="max-w-6xl mx-auto px-4">
    {{-- Breadcrumb --}}
    <div class="text-sm text-gray-500 mb-4">
        <a href="{{ route('user.dashboard') }}" class="hover:underline">Beranda</a> / 
        <span>{{ $product->name }}</span>
    </div>

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:space-x-8 bg-white shadow rounded-xl overflow-hidden mb-10">
        <div class="md:w-1/3">
            <img src="https://via.placeholder.com/600x400?text={{ urlencode($product->name) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
        </div>
        <div class="p-6 md:w-2/3">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $product->name }}</h1>
            <p class="text-gray-500 mb-4">{{ ucfirst($product->category) }}</p>
            <p class="text-indigo-600 font-semibold text-lg mb-6">Harga mulai dari Rp {{ number_format($product->price, 0, ',', '.') }}</p>

            <p class="text-gray-600 leading-relaxed">
                Top up {{ $product->name }} hanya dalam hitungan detik! Masukkan ID dan pilih nominal yang kamu inginkan. Proses cepat & aman.
            </p>
        </div>
    </div>

    {{-- Form Top Up --}}
    <form action="{{ route('user.product.buy', $product->id) }}" method="POST" class="bg-white shadow rounded-xl p-6 space-y-6">
        @csrf

        {{-- Step 1: ID Player --}}
        <div>
            <h2 class="font-semibold text-lg mb-2 text-gray-800">1. Masukkan Data Akun</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="text-sm text-gray-600">ID Player *</label>
                    <input type="text" name="player_id" required class="w-full border border-gray-300 rounded-lg px-3 py-2 mt-1 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                <div>
                    <label class="text-sm text-gray-600">Server / User ID</label>
                    <input type="text" name="server_id" class="w-full border border-gray-300 rounded-lg px-3 py-2 mt-1 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>
            </div>
        </div>

        {{-- Step 2: Pilih Paket --}}
        <div>
            <h2 class="font-semibold text-lg mb-2 text-gray-800">2. Pilih Nominal</h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                @foreach(['86 Diamonds', '170 Diamonds', '257 Diamonds', '344 Diamonds', '429 Diamonds', '514 Diamonds'] as $package)
                <label class="cursor-pointer">
                    <input type="radio" name="package" value="{{ $package }}" class="hidden peer" required>
                    <div class="border border-gray-300 rounded-lg p-3 text-center peer-checked:border-indigo-600 peer-checked:ring-2 peer-checked:ring-indigo-400 transition">
                        <p class="font-medium">{{ $package }}</p>
                    </div>
                </label>
                @endforeach
            </div>
        </div>

        {{-- Step 3: Metode Pembayaran --}}
        <div>
            <h2 class="font-semibold text-lg mb-2 text-gray-800">3. Metode Pembayaran</h2>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                @foreach(['Dana', 'OVO', 'Gopay', 'QRIS', 'Bank Transfer'] as $method)
                <label class="cursor-pointer">
                    <input type="radio" name="payment_method" value="{{ $method }}" class="hidden peer" required>
                    <div class="border border-gray-300 rounded-lg p-3 text-center peer-checked:border-indigo-600 peer-checked:ring-2 peer-checked:ring-indigo-400 transition">
                        <p class="font-medium">{{ $method }}</p>
                    </div>
                </label>
                @endforeach
            </div>
        </div>

        {{-- Tombol Beli --}}
        <div class="text-center pt-4">
            <button type="submit" class="bg-indigo-600 text-white px-8 py-3 rounded-lg text-lg font-medium hover:bg-indigo-700 transition">
                Beli Sekarang
            </button>
        </div>
    </form>
</div>
@endsection
