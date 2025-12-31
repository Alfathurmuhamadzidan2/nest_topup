<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    // USER LIST TRANSAKSI
    public function index()
    {
        $transactions = Transaction::where('user_id', Auth::id())
            ->with('product', 'variant')
            ->latest()
            ->get();

        return view('user.transactions.index', compact('transactions'));
    }

    // HITUNG TOTAL HARGA (AJAX)
    public function calculate(Request $request)
    {
        $variant = ProductVariant::findOrFail($request->variant_id);

        $price = $variant->promo_price ?? $variant->price;

        return response()->json([
            'price' => $price,
        ]);
    }

    // PROSES TRANSAKSI
    public function store(Request $request)
    {
        $request->validate([
            'product_id'     => 'required',
            'variant_id'     => 'required',
            'payment_method' => 'required',
            'account_id'     => 'required',
            'contact'        => 'required',
        ]);

        $variant = ProductVariant::findOrFail($request->variant_id);
        $price   = $variant->promo_price ?? $variant->price;

        $user = Auth::user();

        // ============================
        // 1️⃣ Jika bayar pakai saldo
        // ============================
        if ($request->payment_method === 'saldo') {

            if ($user->balance < $price) {
                return back()->with('error', 'Saldo tidak mencukupi');
            }

            $user->balance -= $price;
            $user->save();

            Transaction::create([
                'reference'      => 'TRX' . time(),
                'user_id'        => $user->id,
                'product_id'     => $request->product_id,
                'variant_id'     => $request->variant_id,
                'amount'         => $variant->amount,
                'total_price'    => $price,
                'payment_method' => 'saldo',
                'account_id'     => $request->account_id,
                'contact'        => $request->contact,
                'status'         => 'success', // langsung sukses
            ]);

            return redirect()->route('user.transactions')
                ->with('success', 'Transaksi berhasil, saldo telah dipotong');
        }

        // ============================
        // 2️⃣ Jika bayar NON saldo
        // ============================
        Transaction::create([
            'reference'      => 'TRX' . time(),
            'user_id'        => $user->id,
            'product_id'     => $request->product_id,
            'variant_id'     => $request->variant_id,
            'amount'         => $variant->amount,
            'total_price'    => $price,
            'payment_method' => $request->payment_method,
            'account_id'     => $request->account_id,
            'contact'        => $request->contact,
            'status'         => 'pending', // menunggu admin
        ]);

        return redirect()->route('user.transactions')
            ->with('success', 'Transaksi dibuat, menunggu konfirmasi admin');
    }
}
