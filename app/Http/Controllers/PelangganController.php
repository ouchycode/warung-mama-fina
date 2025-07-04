<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Makanan;
use App\Models\Pesanan;
use App\Models\Ulasan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PelangganController extends Controller
{
    public function pesan(Request $request)
    {
        $kategoriDipilih = $request->get('kategori');
        $query = Makanan::query();

        if ($kategoriDipilih) {
            $query->where('kategori', $kategoriDipilih);
        }

        $kategoriTerpilih = $request->kategori;
        $kategoriList = Makanan::select('kategori')->distinct()->pluck('kategori');
        $makanan = Makanan::when($kategoriTerpilih, fn($q) => $q->where('kategori', $kategoriTerpilih))->get();

        return view('pelanggan.pesan', compact('makanan', 'kategoriList', 'kategoriTerpilih'));
    }

    public function simpanPesanan(Request $request)
    {
        Log::info('Data pemesanan diterima:', $request->all());

        $validated = $request->validate([
            'makanan_id' => 'required|array',
            'makanan_id.*' => 'required|exists:makanans,id',
            'jumlah' => 'required|array',
            'metode_pembayaran' => 'required|in:cod,transfer',
            'alamat_pengantaran' => 'required|string|max:255'
        ]);

        if (!collect($request->jumlah)->contains(fn($j) => intval($j) > 0)) {
            return back()->withErrors(['jumlah' => 'Minimal satu menu harus dipesan.'])->withInput();
        }

        $pesanan = Pesanan::create([
            'pelanggan_id' => Auth::id(),
            'status_pesanan' => 'menunggu',
            'waktu_pesan' => now(),
            'alamat_pengantaran' => $validated['alamat_pengantaran'],
            'metode_pembayaran' => $validated['metode_pembayaran'],
        ]);

        foreach ($validated['makanan_id'] as $i => $id) {
            $jumlah = intval($validated['jumlah'][$i] ?? 0);
            if ($jumlah > 0) {
                $pesanan->makanan()->attach($id, ['jumlah' => $jumlah]);
            }
        }

        return redirect()->route('pelanggan.lacak')->with('status', 'Pesanan berhasil dibuat!');
    }

    public function lacak()
    {
        $pesanan = Pesanan::with(['makanan', 'ulasan'])
            ->where('pelanggan_id', Auth::id())
            ->latest()
            ->first();

        return view('pelanggan.lacak', compact('pesanan'));
    }

    public function dashboard()
    {
        $pesanan = Pesanan::with('makanan')
            ->where('pelanggan_id', Auth::id())
            ->latest()
            ->first();

        return view('pelanggan.dashboard', compact('pesanan'));
    }

    public function riwayat()
    {
        $pesananList = Pesanan::with(['makanan', 'ulasan'])
            ->where('pelanggan_id', Auth::id())
            ->latest()
            ->get();

        return view('pelanggan.riwayat', compact('pesananList'));
    }

    public function batal($id)
    {
        $pesanan = Pesanan::with('makanan')
            ->where('id', $id)
            ->where('pelanggan_id', Auth::id())
            ->where('status_pesanan', 'menunggu')
            ->firstOrFail();

        $pesanan->makanan()->detach();
        $pesanan->delete();

        return redirect()->route('pelanggan.dashboard')->with('status', 'Pesanan berhasil dibatalkan.');
    }

    public function beriUlasan($pesanan_id)
    {
        $pesanan = Pesanan::with('ulasan')->find($pesanan_id);

        if (!$pesanan || $pesanan->pelanggan_id !== Auth::id() || $pesanan->status_pesanan !== 'selesai') {
            return redirect()->route('pelanggan.lacak')->with('error', 'Pesanan tidak dapat diulas.');
        }

        if ($pesanan->ulasan) {
            return redirect()->route('pelanggan.lacak')->with('status', 'Pesanan ini sudah diulas.');
        }

        return view('pelanggan.ulasan', compact('pesanan'));
    }

    public function simpanUlasan(Request $request, $pesanan_id)
    {
        $pesanan = Pesanan::with('ulasan')->where('id', $pesanan_id)->where('pelanggan_id', Auth::id())->first();

        if (!$pesanan || $pesanan->status_pesanan !== 'selesai') {
            return redirect()->route('pelanggan.lacak')->with('error', 'Pesanan tidak dapat diulas.');
        }

        if ($pesanan->ulasan) {
            return redirect()->route('pelanggan.lacak')->with('status', 'Ulasan sudah pernah diberikan.');
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'nullable|string|max:500',
        ]);

        Ulasan::create([
            'pesanan_id' => $pesanan_id,
            'pelanggan_id' => Auth::id(),
            'rating' => $request->rating,
            'komentar' => $request->komentar,
        ]);

        return redirect()->route('pelanggan.lacak')->with('status', 'Ulasan berhasil ditambahkan!');
    }
}
