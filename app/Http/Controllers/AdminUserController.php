<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    /**
     * List pengguna + filter + search + sort + pagination
     */
    public function index(Request $request)
    {
        $query = User::query();

        // SEARCH
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%")
                  ->orWhere('email', 'like', "%{$request->search}%");
            });
        }

        // FILTER ROLE
        if ($request->role) {
            $query->where('role', $request->role);
        }

        // SORTING
        switch ($request->sort) {
            case 'name_asc':
                $query->orderBy('name', 'asc');
                break;

            case 'name_desc':
                $query->orderBy('name', 'desc');
                break;

            case 'balance_asc':
                $query->orderBy('balance', 'asc');
                break;

            case 'balance_desc':
                $query->orderBy('balance', 'desc');
                break;

            default:
                $query->orderBy('created_at', 'desc'); // default sorting
        }

        // PAGINATION
        $users = $query->paginate(15)->appends($request->query());

        return view('admin.users.index', compact('users'));
    }


    /**
     * Edit user
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }


    /**
     * Update user
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|email',
            'balance' => 'numeric|min:0'
        ]);

        $user->update($request->only('name', 'email', 'balance'));

        return redirect()->route('admin.users')->with('success', 'Data pengguna diperbarui.');
    }


    /**
     * Daftar transaksi user
     */
    public function transactions($id)
    {
        $user = User::findOrFail($id);
        $transactions = $user->transactions()->latest()->paginate(15);

        return view('admin.users.transactions', compact('user', 'transactions'));
    }


    /**
     * Hapus user
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->role === 'admin') {
            return back()->with('error', 'Admin tidak boleh dihapus.');
        }

        $user->delete();

        return back()->with('success', 'Pengguna berhasil dihapus.');
    }
}
