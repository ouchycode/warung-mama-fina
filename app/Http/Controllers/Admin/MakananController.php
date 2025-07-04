<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Makanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MakananController extends Controller
{
    public function index()
    {
        $makanan = Makanan::latest()->get();
        return view('admin.makanan.index', compact('makanan'));
    }

    public function create()
    {
        return view('admin.makanan.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:100',
            'harga' => 'required|numeric|min:0',
            'gambar' => 'nullable|image|max:2048',
            'kategori' => 'required|string|max:50',

        ]);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('makanan', 'public');
        }

        Makanan::create($data);
        return redirect()->route('admin.makanan.index')->with('status', 'Menu berhasil ditambahkan.');
    }

    public function edit(Makanan $makanan)
    {
        return view('admin.makanan.edit', compact('makanan'));
    }

    public function update(Request $request, Makanan $makanan)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:100',
            'harga' => 'required|numeric|min:0',
            'gambar' => 'nullable|image|max:2048',
            'kategori' => 'required|string|max:50',

        ]);

        // Jika ada gambar baru
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama kalau ada
            if ($makanan->gambar && Storage::disk('public')->exists($makanan->gambar)) {
                Storage::disk('public')->delete($makanan->gambar);
            }

            $data['gambar'] = $request->file('gambar')->store('makanan', 'public');
        }

        $makanan->update($data);

        return redirect()->route('admin.makanan.index')->with('status', 'Menu berhasil diperbarui.');
    }

    public function destroy(Makanan $makanan)
    {
        // Hapus gambar juga
        if ($makanan->gambar && Storage::disk('public')->exists($makanan->gambar)) {
            Storage::disk('public')->delete($makanan->gambar);
        }

        $makanan->delete();
        return redirect()->route('admin.makanan.index')->with('status', 'Menu berhasil dihapus.');
    }
}
