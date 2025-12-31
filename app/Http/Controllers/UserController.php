<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TopupHistory;

class UserController extends Controller
{
    /**
     * 🔹 Dashboard User
     */
    public function dashboard()
    {
        $user = auth()->user();

        // Hitung jumlah total transaksi pembelian
        $transactionsCount = Transaction::where('user_id', $user->id)->count();

        // Ambil produk terbaru
        $products = Product::latest()->paginate(12);

        // Ambil 5 transaksi terakhir
        $recentTransactions = Transaction::with('product')
            ->where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        return view('user.dashboard', compact(
            'user',
            'products',
            'transactionsCount',
            'recentTransactions'
        ));
    }

    /**
     * 🔹 Detail Produk (USER)
     */
    public function productDetail($id)
    {
        $product = Product::findOrFail($id);
        return view('user.products.detail', compact('product'));
    }

    /**
     * 🔹 Halaman Profil User
     */
    public function profile()
    {
        return view('user.profile', [
            'user' => auth()->user()
        ]);
    }

    /**
     * 🔹 Update Profil User
     */
    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->update($request->only('name', 'email'));

        return back()->with('success', 'Profil berhasil diperbarui.');
    }

    /**
     * 🔹 Halaman Topup Saldo (HANYA TOPUP, TANPA PRODUK)
     */
    public function topup()
    {
        // Tidak perlu mengirimkan $products
        return view('user.topup');
    }

    /**
     * 🔹 Proses Topup Saldo
     */
    public function processTopup(Request $request)
    {
        $request->validate([
            'nominal' => 'required|numeric|min:1000',
        ]);

        $user = auth()->user();
        $nominal = $request->nominal;

        // Tambah saldo user
        $user->balance += $nominal;
        $user->save();

        // Simpan ke riwayat topup
        TopupHistory::create([
            'user_id' => $user->id,
            'amount' => $nominal,
        ]);

        return redirect()->route('user.dashboard')
            ->with('success', 'Saldo berhasil ditambahkan Rp ' . number_format($nominal, 0, ',', '.'));
    }
}
