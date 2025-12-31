<?php

namespace App\Http\Controllers;

use App\Models\TopupHistory;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transaction;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalUsers = User::count();
        $totalTransactions = Transaction::count();
        $totalRevenue = Transaction::where('status', 'success')->sum('amount');
        $recentTransactions = Transaction::with(['user', 'product'])->latest()->take(10)->get();

        return view('admin.dashboard', compact('totalUsers', 'totalTransactions', 'totalRevenue', 'recentTransactions'));
    }
    public function topups()
{
    $topups = TopupHistory::with('user')
        ->latest()
        ->paginate(20);

    return view('admin.topups.index', compact('topups'));
}

public function approveTopup($id)
{
    $topup = TopupHistory::findOrFail($id);

    if ($topup->status === 'approved') {
        return back()->with('error', 'Topup sudah disetujui sebelumnya.');
    }

    // Update saldo user
    $topup->user->balance += $topup->amount;
    $topup->user->save();

    // Update status topup
    $topup->status = 'approved';
    $topup->save();

    return back()->with('success', 'Topup berhasil disetujui dan saldo user ditambahkan.');
}

public function rejectTopup($id)
{
    $topup = TopupHistory::findOrFail($id);

    if ($topup->status === 'rejected') {
        return back()->with('error', 'Topup sudah ditolak sebelumnya.');
    }

    $topup->status = 'rejected';
    $topup->save();

    return back()->with('success', 'Topup berhasil ditolak.');
}

}
