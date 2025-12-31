@extends('layouts.public')
@section('title', 'NestTopup')

@section('content')
<div class="space-y-20">

  {{-- HERO SECTION --}}
  <section class="text-center py-24 bg-gradient-to-b from-[#06060b] to-[#0b1220] rounded-xl shadow-xl">
    <div class="max-w-4xl mx-auto px-6">
      <h1 class="text-5xl md:text-6xl font-extrabold text-orange-400 leading-tight mb-6 drop-shadow-sm">
        Selamat Datang di <span class="text-white">NestTopup</span>
      </h1>
      <p class="text-gray-300 text-lg md:text-xl leading-relaxed mb-8">
        Top-up game favorit kamu dengan <span class="text-orange-400 font-semibold">cepat</span>, 
        <span class="text-orange-400 font-semibold">aman</span> dan <span class="text-orange-400 font-semibold">harga terbaik</span>.  
        Nikmati transaksi mudah kapan pun, di mana pun.
      </p>
      <a href="{{ route('pages.products') ?? '#' }}"
         class="inline-block bg-orange-500 hover:bg-orange-400 text-black font-semibold px-8 py-4 rounded-full transition transform hover:scale-105 shadow-md shadow-orange-500/20">
         Lihat Produk
      </a>
    </div>
  </section>

  {{-- FITUR UTAMA --}}
  <section class="max-w-6xl mx-auto px-6">
    <h2 class="text-2xl text-orange-400 font-semibold text-center mb-10">Kenapa Memilih NestTopup?</h2>

    <div class="grid md:grid-cols-3 sm:grid-cols-2 gap-6">
      <div class="bg-[#0b1220] border border-gray-800 rounded-2xl p-8 text-center hover:border-orange-400 transition hover:scale-105 shadow-lg shadow-orange-500/5">
        <div class="text-4xl mb-3">⚡</div>
        <h3 class="text-lg font-semibold text-white mb-2">Transaksi Cepat</h3>
        <p class="text-gray-400 text-sm">Diamond masuk dalam hitungan detik setelah pembayaran berhasil.</p>
      </div>

      <div class="bg-[#0b1220] border border-gray-800 rounded-2xl p-8 text-center hover:border-orange-400 transition hover:scale-105 shadow-lg shadow-orange-500/5">
        <div class="text-4xl mb-3">🛡️</div>
        <h3 class="text-lg font-semibold text-white mb-2">Aman & Terpercaya</h3>
        <p class="text-gray-400 text-sm">Sistem keamanan berlapis untuk melindungi transaksi kamu.</p>
      </div>

      <div class="bg-[#0b1220] border border-gray-800 rounded-2xl p-8 text-center hover:border-orange-400 transition hover:scale-105 shadow-lg shadow-orange-500/5">
        <div class="text-4xl mb-3">💰</div>
        <h3 class="text-lg font-semibold text-white mb-2">Harga Kompetitif</h3>
        <p class="text-gray-400 text-sm">Harga terbaik untuk semua game tanpa biaya tersembunyi.</p>
      </div>
    </div>
  </section>

  {{-- PRODUK TERBARU --}}
  <section class="max-w-7xl mx-auto px-6">
    <div class="flex items-center justify-between mb-6">
      <h2 class="text-2xl font-semibold text-orange-400">Produk Terbaru</h2>
      <a href="{{ route('pages.products') ?? '#' }}" class="text-sm text-orange-400 hover:underline">
        Lihat Semua →
      </a>
    </div>

    <div class="grid lg:grid-cols-3 md:grid-cols-2 gap-6">
      @forelse ($products as $product)
        <div class="bg-[#0b1220] border border-gray-800 p-5 rounded-2xl hover:border-orange-400 transition transform hover:scale-[1.03] shadow-lg hover:shadow-orange-500/20">
          
          {{-- GAMBAR PRODUK --}}
          <div class="aspect-w-16 aspect-h-9 mb-4 overflow-hidden rounded-xl">
            <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/400x200?text=No+Image' }}"

                 alt="{{ $product->name }}"
                 class="object-cover w-full h-full hover:scale-110 transition duration-300">
          </div>

          {{-- INFO PRODUK --}}
          <h3 class="text-lg font-semibold text-white mb-1">{{ $product->name }}</h3>
          <p class="text-sm text-gray-400 mb-2">{{ $product->category ?? 'Umum' }}</p>
          {{-- BUTTON --}}
          <a href="#" 
             class="block w-full text-center bg-orange-500 hover:bg-orange-400 text-black font-semibold py-2 rounded-md transition shadow-md">
            Beli Sekarang
          </a>
        </div>
      @empty
        <div class="col-span-full text-center text-gray-400 py-10">
          Belum ada produk tersedia.
        </div>
      @endforelse
    </div>
  </section>

  {{-- TESTIMONI --}}
  <section class="bg-[#0b1220] border border-gray-800 rounded-2xl max-w-6xl mx-auto p-10">
    <h2 class="text-2xl font-semibold text-orange-400 text-center mb-8">Apa Kata Pengguna?</h2>

    <div class="grid md:grid-cols-3 gap-6">
      <div class="bg-[#111827] p-6 rounded-xl shadow-lg hover:shadow-orange-500/20 transition">
        <p class="text-gray-300 italic mb-3">"Cepat banget prosesnya! Ga sampai 1 menit diamond masuk!"</p>
        <p class="text-orange-400 font-semibold">— Dika, Mobile Legends</p>
      </div>

      <div class="bg-[#111827] p-6 rounded-xl shadow-lg hover:shadow-orange-500/20 transition">
        <p class="text-gray-300 italic mb-3">"Harga murah, pelayanan cepat, pokoknya mantap!"</p>
        <p class="text-orange-400 font-semibold">— Rani, Free Fire</p>
      </div>

      <div class="bg-[#111827] p-6 rounded-xl shadow-lg hover:shadow-orange-500/20 transition">
        <p class="text-gray-300 italic mb-3">"Website-nya keren dan mudah dipakai."</p>
        <p class="text-orange-400 font-semibold">— Eko, Genshin Impact</p>
      </div>
    </div>
  </section>

  {{-- AJAKAN AKHIR --}}
  <section class="text-center py-16">
    <h2 class="text-3xl font-semibold text-orange-400 mb-4">
      Yuk, Mulai Top-up Sekarang!
    </h2>
    <p class="text-gray-300 mb-6">
      Bergabunglah dengan ribuan pengguna yang sudah menikmati kemudahan bertransaksi di NestTopup.
    </p>

    <a href="{{ route('register') ?? '#' }}"
       class="inline-block bg-orange-500 hover:bg-orange-400 text-black font-semibold px-8 py-4 rounded-full transition transform hover:scale-105 shadow-md shadow-orange-500/20">
      Daftar Sekarang
    </a>
  </section>

</div>
@endsection
