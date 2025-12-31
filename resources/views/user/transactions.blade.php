@extends('layouts.app')

@section('title', 'Riwayat Transaksi')

@section('content')
  <div class="bg-[#071225] p-4 rounded-lg mb-4">
    <h2 class="text-lg font-semibold">Riwayat Transaksi</h2>
    <p class="text-sm text-gray-400">Semua transaksi Anda ditampilkan di sini.</p>
  </div>

  <div class="bg-[#071225] rounded-lg p-4 shadow">
    <div class="overflow-x-auto">
      <table class="min-w-full">
        <thead class="text-left text-gray-300">
          <tr>
            <th class="px-4 py-2">Kode</th>
            <th class="px-4 py-2">Produk</th>
            <th class="px-4 py-2">Akun</th>
            <th class="px-4 py-2">Jumlah</th>
            <th class="px-4 py-2">Status</th>
            <th class="px-4 py-2">Tanggal</th>
          </tr>
        </thead>
        <tbody>
          @foreach($transactions as $trx)
            <tr class="border-t border-gray-800 hover:bg-[#0f1724]">
              <td class="px-4 py-3 font-medium">{{ $trx->reference ?? $trx->id }}</td>
              <td class="px-4 py-3">{{ $trx->product->name ?? '-' }}</td>
              <td class="px-4 py-3">{{ $trx->account_id ?? '-' }}</td>
              <td class="px-4 py-3 text-orange-400">Rp {{ number_format($trx->amount,0,',','.') }}</td>
              <td class="px-4 py-3">
                @if($trx->status === 'pending')
                  <span class="px-3 py-1 bg-yellow-500 text-black rounded">Pending</span>
                @elseif($trx->status === 'success')
                  <span class="px-3 py-1 bg-green-600 text-black rounded">Sukses</span>
                @else
                  <span class="px-3 py-1 bg-red-600 text-black rounded">Gagal</span>
                @endif
              </td>
              <td class="px-4 py-3 text-sm text-gray-400">{{ $trx->created_at->format('d M Y H:i') }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <div class="mt-4">
      {{ $transactions->links() }}
    </div>
  </div>
@endsection
