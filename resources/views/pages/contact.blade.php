@extends('layouts.app')
@section('title', 'Kontak Kami')
@section('content')
  <div class="max-w-2xl mx-auto py-10">
    <h1 class="text-3xl font-semibold text-orange-400 mb-4">Hubungi Kami</h1>
    <p class="text-gray-400 mb-6">Kami siap membantu Anda 24 jam setiap hari.</p>
    <form class="space-y-4">
      <div>
        <input type="text" placeholder="Nama" class="w-full px-4 py-2 rounded bg-[#0b1220] border border-gray-700 text-gray-200" />
      </div>
      <div>
        <input type="email" placeholder="Email" class="w-full px-4 py-2 rounded bg-[#0b1220] border border-gray-700 text-gray-200" />
      </div>
      <div>
        <textarea placeholder="Pesan" class="w-full px-4 py-2 rounded bg-[#0b1220] border border-gray-700 text-gray-200 h-32"></textarea>
      </div>
      <button type="submit" class="px-6 py-2 bg-orange-500 hover:bg-orange-400 text-black rounded">Kirim Pesan</button>
    </form>
  </div>
@endsection
