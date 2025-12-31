@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="max-w-4xl mx-auto text-white space-y-8">

    {{-- Header --}}
    <div class="bg-[#111] p-6 rounded-xl border border-gray-800 shadow flex gap-6">
        @if($product->image)
            <img src="{{ asset('storage/'.$product->image) }}"
                 class="w-32 h-32 object-cover rounded-lg border border-gray-700">
        @endif

        <div>
            <h1 class="text-3xl font-bold">{{ $product->name }}</h1>
            <p class="text-gray-400">{{ $product->category }}</p>
        </div>
    </div>

    {{-- USER PURCHASE AREA --}}
    <div class="bg-[#111] p-6 rounded-xl border border-gray-800 shadow">

        <h2 class="text-xl font-semibold mb-4">Pilih Varian</h2>

        <form action="{{ route('transaction.create') }}" method="POST">
            @csrf

            <input type="hidden" name="product_id" value="{{ $product->id }}">

            {{-- Select Varian --}}
            <select name="variant_id" id="variantSelect"
                    class="w-full p-3 bg-[#0d0d0d] border border-gray-700 rounded-lg text-gray-200">
                @foreach($product->variants as $variant)
                    <option value="{{ $variant->id }}" data-price="{{ $variant->price }}">
                        {{ $variant->name }} - Rp {{ number_format($variant->price, 0, ',', '.') }}
                    </option>
                @endforeach
            </select>

            {{-- Payment --}}
            <div class="mt-6">
                <h3 class="text-lg font-semibold">Metode Pembayaran</h3>

                <select name="payment_method"
                        class="w-full p-3 bg-[#0d0d0d] mt-2 border border-gray-700 rounded-lg text-gray-200">
                    <option value="saldo">Saldo</option>
                    <option value="qris">QRIS</option>
                    <option value="dana">DANA</option>
                    <option value="gopay">GoPay</option>
                    <option value="transfer">Bank Transfer</option>
                </select>
            </div>

            {{-- Total --}}
            <div class="mt-6 text-lg">
                <span class="text-gray-400">Total:</span>
                <span id="priceDisplay" class="font-bold text-indigo-400">
                    Rp {{ number_format($product->variants->first()->price ?? 0, 0, ',', '.') }}
                </span>
            </div>

            {{-- Submit --}}
            <button type="submit"
                class="w-full mt-6 py-3 bg-indigo-600 hover:bg-indigo-500 rounded-lg font-semibold text-white">
                Beli Sekarang
            </button>
        </form>

    </div>

</div>

<script>
const variant = document.getElementById('variantSelect');
const display = document.getElementById('priceDisplay');

variant.addEventListener('change', () => {
    const price = variant.options[variant.selectedIndex].dataset.price;
    display.textContent = "Rp " + parseInt(price).toLocaleString("id-ID");
});
</script>
@endsection
