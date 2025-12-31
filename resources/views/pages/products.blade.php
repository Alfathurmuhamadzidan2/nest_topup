@extends('layouts.app')
@section('title', 'Produk')

@section('content')
<div class="max-w-7xl mx-auto">
    <h2 class="text-2xl font-semibold text-orange-400 mb-6">Daftar Produk</h2>

    <div class="grid md:grid-cols-3 sm:grid-cols-2 gap-6">
        @forelse ($products as $product)
            <div class="bg-[#0b1220] border border-gray-800 p-4 rounded-lg hover:border-orange-400 transition">
                <h3 class="text-lg font-semibold text-white mb-2">{{ $product->name }}</h3>
                <p class="text-sm text-gray-400 mb-3">{{ $product->category }}</p>
                <p class="text-orange-400 font-semibold text-lg mb-3">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                <a href="#" class="block text-center bg-orange-500 hover:bg-orange-400 text-black font-semibold py-2 rounded-md">Beli Sekarang</a>
            </div>
        @empty
            <p class="text-gray-400">Belum ada produk tersedia.</p>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $products->links() }}
    </div>
</div>
@endsection
