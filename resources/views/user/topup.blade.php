@extends('layouts.app')

@section('title', 'Topup Saldo')

@section('content')
<div class="max-w-2xl mx-auto py-10">
  <h1 class="text-3xl font-semibold text-orange-400 mb-6">Topup Saldo</h1>

  <form method="POST" action="{{ route('user.topup.process') }}" class="space-y-4">
    @csrf

    <div>
      <label class="block text-gray-300 mb-1">Nominal Topup</label>
      <input 
        type="number" 
        name="nominal" 
        class="w-full bg-[#0b1220] border border-gray-700 text-gray-200 rounded px-3 py-2" 
        required 
        placeholder="Masukkan nominal, contoh: 10000">
    </div>

    <button type="submit" class="bg-orange-500 hover:bg-orange-400 text-black font-semibold px-6 py-2 rounded">
      Kirim Topup
    </button>
  </form>
</div>
@endsection
