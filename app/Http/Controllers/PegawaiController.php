<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;

class PegawaiController extends Controller
{
    public function index()
    {
        $pesanan = Pesanan::where('status_pesanan', 'menunggu')->get();
        return view('pegawai.daftar-pesanan', compact('pesanan'));
    }

    public function verifikasi($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $pesanan->status_pesanan = 'diproses';
        $pesanan->save();

        return redirect()->back()->with('status', 'Pesanan berhasil diverifikasi!');
    }

    public function show($id)
{
    $pesanan = Pesanan::with(['makanan', 'pelanggan'])->findOrFail($id);
    return view('pegawai.pesanan.show', compact('pesanan'));
}

}
