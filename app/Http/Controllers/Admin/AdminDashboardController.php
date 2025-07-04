<?php

namespace App\Http\Controllers\Admin;
use App\Models\Pesanan; 
use App\Models\User; 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $totalPesanan = Pesanan::count();
    $pesananSelesai = Pesanan::where('status_pesanan', 'selesai')->count();
    $pesananAktif = Pesanan::whereIn('status_pesanan', ['menunggu', 'diproses', 'dikirim'])->count();

    $pendapatan = Pesanan::where('status_pesanan', 'selesai')
        ->with('makanan')
        ->get()
        ->flatMap(fn($p) => $p->makanan->map(fn($m) => $m->harga * $m->pivot->jumlah))
        ->sum();

    $totalAdmin = User::where('role', 'admin')->count();
    $totalPegawai = User::where('role', 'pegawai')->count();
    $totalKurir = User::where('role', 'kurir')->count();
    $totalPelanggan = User::where('role', 'pelanggan')->count();

    return view('admin.dashboard', compact(
        'totalPesanan', 'pesananSelesai', 'pesananAktif', 'pendapatan',
        'totalAdmin', 'totalPegawai', 'totalKurir', 'totalPelanggan'
    ));
}
}
