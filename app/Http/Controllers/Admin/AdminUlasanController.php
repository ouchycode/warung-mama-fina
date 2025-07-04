<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ulasan;
use Illuminate\Http\Request;

class AdminUlasanController extends Controller
{
    /**
     * Menampilkan daftar ulasan pelanggan
     */
    public function index()
    {
        // Ambil semua ulasan dengan relasi pesanan dan pelanggan
        $ulasans = Ulasan::with('pesanan', 'pelanggan')->latest()->get();

        return view('admin.ulasan.index', compact('ulasans'));
    }
}
