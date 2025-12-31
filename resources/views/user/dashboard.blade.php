@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-8">

    {{-- QUICK STATS --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        
        <!-- SALDO -->
        <div class="bg-[#0d0d0d] p-5 rounded-xl shadow-lg border border-gray-800 hover:border-indigo-500 transition">
            <div class="text-sm text-gray-400">Saldo</div>
            <div class="text-3xl font-bold text-indigo-400 mt-1">
                Rp {{ number_format(auth()->user()->balance ?? 0, 0, ',', '.') }}
            </div>

            <a href="{{ route('user.topup') }}"
               class="inline-block mt-4 px-4 py-2 bg-indigo-600 hover:bg-indigo-500 rounded-lg font-semibold text-white shadow">
               Top Up
            </a>
        </div>

        <!-- TRANSACTION -->
        <div class="bg-[#0d0d0d] p-5 rounded-xl shadow-lg border border-gray-800 hover:border-indigo-500 transition">
            <div class="text-sm text-gray-400">Transaksi</div>
            <div class="text-3xl font-bold text-indigo-400 mt-1">
                {{ $transactionsCount ?? 0 }}
            </div>

            <a href="{{ route('user.transactions') }}"
               class="inline-block mt-4 px-4 py-2 border border-gray-700 hover:bg-gray-800 rounded-lg text-gray-300 font-semibold">
               Riwayat
            </a>
        </div>

        <!-- ACCOUNT -->
        <div class="bg-[#0d0d0d] p-5 rounded-xl shadow-lg border border-gray-800 hover:border-indigo-500 transition">
            <div class="text-sm text-gray-400">Akun</div>
            <div class="text-2xl font-bold text-indigo-400 mt-1">
                {{ auth()->user()->name }}
            </div>

            <a href="{{ route('user.profile') }}"
               class="inline-block mt-4 px-4 py-2 border border-gray-700 hover:bg-gray-800 rounded-lg text-gray-300 font-semibold">
               Edit Profil
            </a>
        </div>

    </div>

    {{-- SEARCH --}}
    <div class="flex items-center justify-between">
        <h2 class="text-xl font-semibold text-white">Produk Populer</h2>

        <input id="productSearch"
               type="text"
               placeholder="Cari produk..."
               class="px-4 py-2 bg-[#0f0f0f] border border-gray-700 rounded-lg text-gray-200 focus:ring-indigo-500 focus:border-indigo-500"
        />
    </div>

    {{-- PRODUCT LIST --}}
    <div id="productsGrid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
        @foreach($products as $product)
            <a href="{{ route('user.products.show', $product->id) }}"
               class="block bg-[#0f0f0f] rounded-xl p-4 shadow-lg border border-gray-800 
                      hover:scale-[1.04] hover:border-indigo-500 transition cursor-pointer">

                {{-- GAMBAR PRODUK --}}
                <div class="h-40 w-full rounded-lg overflow-hidden bg-black flex items-center justify-center mb-4 border border-gray-800">
                    @if($product->image)
                        <img src="{{ asset('storage/'.$product->image) }}"
                             class="h-full w-full object-cover">
                    @else
                        <span class="text-gray-500 text-4xl font-bold">
                            {{ strtoupper(substr($product->name, 0, 1)) }}
                        </span>
                    @endif
                </div>

                <h3 class="font-semibold text-white text-lg">{{ $product->name }}</h3>
                <p class="text-sm text-gray-400">{{ $product->category }}</p>

                {{-- HARGA MINIMAL --}}
                @php
                    $minPrice = $product->variants->min('price') ?? 0;
                @endphp

                <div class="mt-3 flex items-center justify-between">
                    <span class="text-indigo-400 font-bold text-lg">
                        Mulai Rp {{ number_format($minPrice, 0, ',', '.') }}
                    </span>

                    <span class="px-3 py-2 bg-indigo-600 hover:bg-indigo-500 rounded-lg text-white font-semibold shadow">
                        Detail
                    </span>
                </div>

            </a>
        @endforeach
    </div>

    <div class="mt-6">{{ $products->links() }}</div>
</div>

<script>
document.getElementById('productSearch').addEventListener('input', function(e){
    const q = e.target.value.toLowerCase();
    document.querySelectorAll('#productsGrid > a').forEach(card => {
        const title = card.querySelector('h3').textContent.toLowerCase();
        card.style.display = title.includes(q) ? '' : 'none';
    });
});
</script>

@endsection
