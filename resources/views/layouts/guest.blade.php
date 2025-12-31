<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'NestTopup') }}</title>

  <!-- Tailwind & Font -->
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

  <style>
    body { 
      font-family: 'Poppins', sans-serif; 
      background: linear-gradient(160deg, #06060b, #0b1220); 
      color: #e6eef8; 
    }
    .card-glow {
      box-shadow: 0 0 20px rgba(255, 166, 0, 0.08);
    }
  </style>
</head>

<body class="min-h-screen flex items-center justify-center px-4">
  <div class="w-full max-w-md">
    {{-- Logo / Header --}}
    <div class="text-center mb-8">
      <a href="/" class="inline-flex items-center justify-center space-x-2">
        <x-application-logo class="w-16 h-16 fill-current text-orange-500" />
      </a>
      <h1 class="mt-4 text-2xl font-bold text-orange-400">NestTopup</h1>
      <p class="text-gray-400 text-sm">Masuk atau buat akun untuk mulai transaksi</p>
    </div>

    {{-- Card --}}
    <div class="bg-[#0b1220] border border-gray-800 rounded-2xl shadow-lg card-glow p-6 sm:p-8 backdrop-blur-sm">
      {{ $slot }}
    </div>

    {{-- Footer --}}
    <div class="text-center text-sm text-gray-500 mt-8">
      &copy; {{ date('Y') }} NestTopup — Semua Hak Dilindungi.
    </div>
  </div>

  {{-- Background Accent --}}
  <div class="fixed inset-0 -z-10 overflow-hidden">
    <div class="absolute w-72 h-72 bg-orange-500/10 rounded-full blur-3xl top-20 left-10 animate-pulse"></div>
    <div class="absolute w-96 h-96 bg-indigo-500/10 rounded-full blur-3xl bottom-20 right-10 animate-pulse"></div>
  </div>

</body>
</html>
