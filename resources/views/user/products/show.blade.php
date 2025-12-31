@extends('layouts.app')

@section('title', 'Detail Produk')

@section('content')
<div class="max-w-4xl mx-auto text-gray-100">

    {{-- HEADER --}}
    <h1 class="text-3xl font-bold mb-6 text-white">{{ $product->name }}</h1>

    {{-- CARD PRODUK --}}
    <div class="bg-[#1A1A3A] p-6 rounded-xl border border-gray-700 flex gap-6">

        {{-- GAMBAR --}}
        <div class="w-40 h-40 bg-black/40 border border-gray-700 rounded-xl overflow-hidden">
            @if ($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-full object-cover">
            @else
                <div class="flex items-center justify-center h-full text-gray-400">No Image</div>
            @endif
        </div>

        {{-- DETAIL --}}
        <div class="flex-1">
            <p class="text-gray-400">{{ $product->category }}</p>
            <p class="mt-3 text-gray-300">{{ $product->description ?? 'Tidak ada deskripsi.' }}</p>
        </div>
    </div>

    {{-- VARIAN LIST --}}
    <div class="mt-10">
        <h2 class="text-xl font-semibold text-white mb-4">Pilih Varian</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            @foreach ($product->variants as $v)
                <div class="bg-[#0E0E2C] rounded-xl p-5 border border-gray-700">

                    <h3 class="text-lg font-bold text-orange-400">{{ $v->name }}</h3>

                    <p class="text-gray-300 mt-1">
                        Harga:
                        <span class="text-green-400 font-semibold">
                            Rp {{ number_format($v->promo_price ?? $v->price, 0, ',', '.') }}
                        </span>

                        @if($v->promo_price)
                            <span class="line-through text-gray-500 text-sm ml-2">
                                Rp {{ number_format($v->price, 0, ',', '.') }}
                            </span>
                        @endif
                    </p>

                    @if ($v->amount !== null)
                        <p class="text-gray-400 mt-1">Jumlah: {{ $v->amount }}</p>
                    @endif

                    {{-- FORM PEMBELIAN --}}
                    <form action="{{ route('user.transactions.store') }}" method="POST" class="mt-4 space-y-4">
                        @csrf

                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="variant_id" value="{{ $v->id }}">

                        {{-- ACCOUNT ID --}}
                        <div>
                            <label class="text-gray-300 font-semibold">Account ID Game</label>
                            <input type="text" name="account_id"
                                   required
                                   placeholder="Masukkan ID game Anda"
                                   class="w-full mt-2 bg-[#141432] border border-gray-700 text-gray-200 p-2 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                        </div>

                        {{-- KONTAK --}}
                        <div>
                            <label class="text-gray-300 font-semibold">Kontak (WhatsApp / Email)</label>
                            <input type="text" name="contact"
                                   required
                                   placeholder="Masukkan kontak"
                                   class="w-full mt-2 bg-[#141432] border border-gray-700 text-gray-200 p-2 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                        </div>

                        {{-- OPSI PEMBAYARAN --}}
                        <div>
                            <label class="text-gray-300 font-semibold">Metode Pembayaran</label>

                            <select name="payment_method"
                                    class="w-full mt-2 bg-[#141432] border border-gray-700 text-gray-200 p-2 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">

                                <option value="saldo">Potong Saldo</option>
                                <option value="dana">Dana</option>
                                <option value="qris">QRIS</option>
                                <option value="transfer">Transfer Bank</option>
                            </select>
                        </div>

                        {{-- INFO SALDO --}}
                        <div class="text-gray-400 text-sm">
                            Saldo Anda:
                            <span class="text-indigo-400 font-semibold">
                                Rp {{ number_format(auth()->user()->balance ?? 0, 0, ',', '.') }}
                            </span>
                        </div>

                        {{-- BUTTON BELI --}}
                        <button class="w-full py-2 bg-indigo-600 hover:bg-indigo-700 rounded-lg font-semibold text-white">
                            Beli Sekarang
                        </button>
                    </form>
                </div>
            @endforeach

        </div>
    </div>

</div>
@endsection
