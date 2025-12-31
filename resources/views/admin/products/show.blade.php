@extends('layouts.app')

@section('title', 'Detail Produk - ' . $product->name)

@section('content')
<div class="max-w-5xl mx-auto text-white space-y-8">

    {{-- HEADER PRODUK --}}
    <div class="bg-[#111] p-6 rounded-xl border border-gray-800 shadow flex gap-6">
        @if($product->image)
            <img src="{{ asset('storage/' . $product->image) }}"
                 class="w-32 h-32 object-cover rounded-lg border border-gray-700">
        @endif

        <div class="space-y-1">
            <h1 class="text-3xl font-bold">{{ $product->name }}</h1>
            <p class="text-gray-400">{{ $product->category ?? 'Tidak ada kategori' }}</p>
            <p class="text-indigo-400">Status: {{ ucfirst($product->status) }}</p>
        </div>
    </div>

    {{-- VARIANTS MANAGEMENT --}}
    <div class="bg-[#111] p-6 rounded-xl border border-gray-800 shadow space-y-6">

        <h2 class="text-xl font-semibold">Daftar Varian</h2>

        {{-- TABLE VARIANTS --}}
        <table class="w-full text-left border border-gray-700">
            <thead class="bg-gray-900 text-gray-300">
                <tr>
                    <th class="p-3">Nama</th>
                    <th class="p-3">Jumlah</th>
                    <th class="p-3">Harga</th>
                    <th class="p-3">Harga Promo</th>
                    <th class="p-3">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($product->variants as $variant)
                    <tr class="border-b border-gray-700">
                        <td class="p-3">{{ $variant->name }}</td>
                        <td class="p-3">{{ $variant->amount ?? '-' }}</td>
                        <td class="p-3">Rp {{ number_format($variant->price, 0, ',', '.') }}</td>
                        <td class="p-3">
                            @if($variant->promo_price)
                                Rp {{ number_format($variant->promo_price, 0, ',', '.') }}
                            @else
                                -
                            @endif
                        </td>
                        <td class="p-3 flex gap-3">

                            {{-- DELETE VARIANT --}}
                            <form action="{{ route('admin.products.variants.delete', [$product->id, $variant->id]) }}"
                                  method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus varian ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-500 hover:underline">Hapus</button>
                            </form>

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="p-3 text-gray-400" colspan="5">Belum ada varian.</td>
                    </tr>
                @endforelse
            </tbody>

        </table>

        {{-- FORM TAMBAH VARIANT --}}
        <div class="mt-6">
            <h3 class="text-lg font-semibold mb-3">Tambah Varian Baru</h3>

            <form action="{{ route('admin.products.variants.store', $product->id) }}"
                  method="POST"
                  class="space-y-4 bg-black p-5 rounded-xl border border-gray-700">
                @csrf

                <div>
                    <label class="block mb-1">Nama Varian</label>
                    <input type="text" name="name"
                           class="w-full bg-gray-900 text-white p-2 rounded border border-gray-700"
                           required>
                </div>

                <div>
                    <label class="block mb-1">Jumlah (Optional)</label>
                    <input type="number" name="amount"
                           class="w-full bg-gray-900 text-white p-2 rounded border border-gray-700">
                </div>

                <div>
                    <label class="block mb-1">Harga</label>
                    <input type="number" name="price"
                           class="w-full bg-gray-900 text-white p-2 rounded border border-gray-700"
                           required>
                </div>

                <div>
                    <label class="block mb-1">Harga Promo (Optional)</label>
                    <input type="number" name="promo_price"
                           class="w-full bg-gray-900 text-white p-2 rounded border border-gray-700">
                </div>

                <div>
                    <label class="block mb-1">Deskripsi (Optional)</label>
                    <textarea name="description"
                              class="w-full bg-gray-900 text-white p-2 rounded border border-gray-700"
                              rows="3"></textarea>
                </div>

                <button class="px-4 py-2 bg-indigo-600 hover:bg-indigo-500 rounded-lg text-white font-semibold">
                    Tambahkan Varian
                </button>
            </form>
        </div>

    </div>

</div>
@endsection
