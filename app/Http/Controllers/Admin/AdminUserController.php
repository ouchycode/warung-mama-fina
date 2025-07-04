<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminUserController extends Controller
{
    /**
     * Menampilkan daftar user dengan filter role dan pencarian nama/email (kecuali admin)
     */
    public function index(Request $request)
    {
        $query = User::query()->where('role', '!=', 'admin');

        // Filter berdasarkan role jika disediakan
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        // Pencarian berdasarkan nama atau email
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $users = $query->orderBy('name')->paginate(10)->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Menghapus user jika bukan admin dan bukan diri sendiri
     */
    public function destroy(User $user)
    {
        if ($user->role === 'admin') {
            return redirect()->route('admin.users.index')
                ->with('error', 'User dengan role admin tidak boleh dihapus.');
        }

        if ($user->id === Auth::id()) {
            return redirect()->route('admin.users.index')
                ->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('status', 'User berhasil dihapus.');
    }
}
