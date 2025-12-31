<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'NestTopup')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: radial-gradient(circle at top, #0b1220, #06060b 70%);
            color: #e6eef8;
        }

        /* Smooth fade-in animation */
        .fade-in {
            animation: fadeIn 0.9s ease-out forwards;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(12px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Glow Hover */
        .glow:hover {
            box-shadow: 0 0 20px rgba(245, 158, 11, 0.5);
            transform: translateY(-2px);
        }
    </style>
</head>

<body class="min-h-screen flex flex-col fade-in">

<!-- NAVBAR -->
<header class="fixed top-0 w-full backdrop-blur-md bg-[#0b1220]/60 border-b border-gray-700 z-50">
    <div class="max-w-7xl mx-auto px-6 h-16 flex items-center justify-between">
        
        <!-- Logo -->
        <div class="flex items-center gap-2">
            <svg class="w-9 h-9 text-orange-400" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <path d="M12 2L2 7l10 5 10-5-10-5z"/>
                <path d="M2 17l10 5 10-5"/>
            </svg>
            <span class="text-2xl font-semibold text-orange-400 drop-shadow-lg">NestTopup</span>
        </div>

        <!-- Links -->
        <nav class="hidden md:flex gap-6 text-gray-300 font-medium">
            <a href="/" class="hover:text-orange-400 transition">Beranda</a>
            <a href="/produk" class="hover:text-orange-400 transition">Produk</a>
            <a href="/kontak" class="hover:text-orange-400 transition">Kontak</a>
        </nav>

        <!-- Login Button -->
        <a href="{{ route('login') }}"
            class="px-5 py-2 rounded-md bg-orange-500 text-black font-semibold hover:bg-orange-400 glow transition">
            Login
        </a>
    </div>
</header>

<!-- SPACE FIX (karena navbar fixed) -->
<div class="h-16"></div>

<!-- MAIN SECTION -->
<main class="flex-1 flex justify-center py-10 px-6">
    <div class="w-full max-w-5xl fade-in">
        @yield('content')
    </div>
</main>

<!-- FOOTER -->
<footer class="py-6 text-center text-gray-400 border-t border-gray-800 mt-10">
    &copy; {{ date('Y') }} NestTopup — All rights reserved.
</footer>

</body>
</html>
        