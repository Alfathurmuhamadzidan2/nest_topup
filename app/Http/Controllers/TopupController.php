<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Str;

class TopupController extends Controller
{
    public function index()
    {
        return view('user.topup');
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:10000',
            'payment_method' => 'required|string',
            'payment_proof' => 'nullable|image|max:2048'
        ]);

        $path = null;
        if ($request->hasFile('payment_proof')) {
            $path = $request->file('payment_proof')->store('bukti', 'public');
        }

        Transaction::create([
            'user_id' => auth()->id(),
            'product_id' => null, // karena ini topup saldo, bukan produk
            'target_number' => '-',
            'amount' => $request->amount,
            'status' => 'pending',
            'payment_method' => $request->payment_method,
            'payment_proof' => $path,
            'reference' => 'TOPUP-' . strtoupper(Str::random(8)),
        ]);

        return redirect()->route('user.transactions')->with('success', 'Permintaan top-up dikirim.');
    }
}
