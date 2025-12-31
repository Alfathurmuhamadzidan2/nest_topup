@extends('layouts.app')

@section('title', 'Halaman Tidak Ditemukan')

@section('content')
<div class="flex flex-col items-center justify-center min-h-screen bg-gray-100">
    <h1 class="text-6xl font-bold text-gray-800">404</h1>
    <p class="text-xl text-gray-600 mt-4">Halaman yang Anda cari tidak ditemukan.</p>

    <a href="{{ url('/') }}" 
       class="mt-6 px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
        Kembali ke Beranda
    </a>
</div>
@endsection
