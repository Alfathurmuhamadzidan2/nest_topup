<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class AdminTransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('user', 'product', 'variant')
            ->latest()
            ->get();

        return view('admin.transactions.index', compact('transactions'));
    }

    public function updateStatus(Request $request, $id)
    {
        $trx = Transaction::findOrFail($id);

        $trx->update([
            'status' => $request->status,
        ]);

        return back()->with('success', 'Status transaksi diperbarui');
    }

    public function destroy($id)
    {
        Transaction::findOrFail($id)->delete();
        return back()->with('success', 'Transaksi dihapus');
    }
}
