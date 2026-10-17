<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{
    public function index()
    {
        $users = User::orderByRaw("FIELD(role, 'super_admin', 'rt', 'bendahara')")
            ->orderBy('name')
            ->get();

        return view('kelola-akun.index', compact('users'));
    }

    public function store(Request $request)
    {
        // HANYA Super Admin yang bisa tambah akun baru
        if (Auth::user()->role !== 'super_admin') {
            return back()->with('success', 'Akses ditolak: Hanya Super Admin yang dapat menambah akun baru.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'role' => 'required|in:rt,bendahara',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.unique' => 'Email sudah digunakan.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'role.required' => 'Role wajib dipilih.',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return back()->with('success', 'Akun baru berhasil dibuat!');
    }

    public function resetPassword(Request $request, User $user)
    {
        // Cegah reset akun sendiri (pakai menu Profil)
        if ($user->id === Auth::id()) {
            return back()->with('success', 'Gunakan menu Profil untuk ganti password sendiri.');
        }

        // RT tidak boleh reset Super Admin
        if (Auth::user()->role === 'rt' && $user->role === 'super_admin') {
            return back()->with('success', 'Anda tidak berhak reset password Super Admin.');
        }

        $request->validate([
            'password_baru' => 'required|min:8',
        ], [
            'password_baru.required' => 'Password baru wajib diisi.',
            'password_baru.min' => 'Password minimal 8 karakter.',
        ]);

        $user->update([
            'password' => Hash::make($request->password_baru),
        ]);

        return back()->with('success', 'Password ' . $user->name . ' berhasil direset!');
    }

    public function destroy(User $user)
    {
        if ($user->id === Auth::id()) {
            return back()->with('success', 'Tidak bisa menghapus akun sendiri.');
        }

        if ($user->role === 'super_admin') {
            return back()->with('success', 'Super Admin tidak dapat dihapus.');
        }

        // RT tidak boleh hapus sesama RT (hanya Super Admin)
        if (Auth::user()->role === 'rt' && $user->role === 'rt') {
            return back()->with('success', 'Anda tidak berhak menghapus akun RT lain.');
        }

        $user->delete();
        return back()->with('success', 'Akun berhasil dihapus!');
    }
}