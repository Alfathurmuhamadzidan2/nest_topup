<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserProfileController extends Controller
{
    /**
     * Halaman Profil User
     */
    public function index()
    {
        $user = auth()->user();
        return view('user.profile', compact('user'));
    }


    /**
     * Update Informasi Profil
     */
    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name'  => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->update([
            'name'  => $request->name,
            'email' => $request->email,
        ]);

        return back()->with('success', 'Profil berhasil diperbarui.');
    }


    /**
     * Update Password User
     */
    public function updatePassword(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'current_password' => ['required'],
            'password'         => ['required', 'confirmed', 'min:6'],
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors([
                'current_password' => 'Password lama tidak sesuai.',
            ]);
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Password berhasil diperbarui.');
    }


    /**
     * Hapus Akun — hanya boleh untuk user role:biasa
     */
    public function destroy(Request $request)
    {
        $user = auth()->user();

        // Jika admin → tidak boleh hapus akun
        if (!$user->hasRole('user')) {
            return back()->with('error', 'Admin tidak dapat menghapus akun.');
        }

        // Validasi password konfirmasi
        $request->validate([
            'password' => ['required', 'current_password'],
        ], [
            'password.current_password' => 'Password salah, tidak dapat menghapus akun.'
        ]);

        // Hapus akun
        $user->delete();

        return redirect('/')
            ->with('success', 'Akun berhasil dihapus.');
    }
}
