<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Schema; // ✅ Tambahkan ini

class PageController extends Controller
{
    /**
     * Halaman utama (landing page)
     */
    public function welcome()
    {
        // Jika tabel memiliki kolom 'status', tampilkan hanya produk aktif
        $query = Product::query();
        if (Schema::hasColumn('products', 'status')) { // ✅ Ganti schema() → Schema::
            $query->where('status', true);
        }

        $products = $query->latest()->take(6)->get();

        return view('welcome', compact('products'));
    }

    /**
     * Halaman tentang
     */
    public function about()
    {
        return view('pages.about');
    }

    /**
     * Halaman kontak
     */
    public function contact()
    {
        return view('pages.contact');
    }

    /**
     * Halaman daftar semua produk publik
     */
    public function products()
    {
        $query = Product::query();
        if (Schema::hasColumn('products', 'status')) { // ✅ Perbaiki juga di sini
            $query->where('status', true);
        }

        $products = $query->latest()->paginate(12);

        return view('pages.products', compact('products'));
    }
}
