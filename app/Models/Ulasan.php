<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    use HasFactory;

    // Tabel yang digunakan oleh model ini
    protected $table = 'ulasan';  // Pastikan ini sesuai dengan nama tabel

    protected $fillable = ['pesanan_id', 'pelanggan_id', 'rating', 'komentar'];

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class);
    }

    public function pelanggan()
    {
        return $this->belongsTo(User::class, 'pelanggan_id');
    }
}
