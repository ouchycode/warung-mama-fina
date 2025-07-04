<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;

class KurirController extends Controller
{
    public function index()
{
    $pesanan = \App\Models\Pesanan::with('makanan')
                ->whereIn('status_pesanan', ['diproses', 'dikirim'])
                ->latest()
                ->get();

    return view('kurir.daftar-pesanan', compact('pesanan'));
}

public function kirim($id)
{
    $pesanan = \App\Models\Pesanan::findOrFail($id);
    $pesanan->update(['status_pesanan' => 'dikirim']);

    return back()->with('status', 'Pesanan telah dikirim.');
}

public function selesai($id)
{
    $pesanan = \App\Models\Pesanan::findOrFail($id);
    $pesanan->update(['status_pesanan' => 'selesai']);

    return back()->with('status', 'Pesanan telah selesai.');
}
}