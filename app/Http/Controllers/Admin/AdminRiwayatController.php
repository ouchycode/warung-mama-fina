<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class AdminRiwayatController extends Controller
{
    /**
     * Menampilkan daftar riwayat pembelian semua pelanggan
     */
    public function index()
    {
        $riwayat = Pesanan::with(['makanan', 'pelanggan'])
                    ->orderByDesc('waktu_pesan')
                    ->get();

        return view('admin.riwayat.index', compact('riwayat'));
    }
}
