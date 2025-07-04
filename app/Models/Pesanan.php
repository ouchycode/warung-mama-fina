<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pesanan extends Model
{
    use HasFactory;

    // Kolom yang bisa diisi secara massal
    protected $fillable = [
        'pelanggan_id',
        'status_pesanan',
        'waktu_pesan',
        'alamat_pengantaran',
    ];

    // Cast agar waktu_pesan otomatis dikenali sebagai instance Carbon
    protected $casts = [
        'waktu_pesan' => 'datetime',
    ];

    /**
     * Relasi Many-to-Many ke tabel makanan (melalui tabel pivot)
     */
    public function makanan()
    {
        return $this->belongsToMany(Makanan::class)->withPivot('jumlah');
    }

    /**
     * Relasi ke model User sebagai pelanggan
     * diasumsikan bahwa pelanggan_id = users.id
     */
    public function pelanggan()
    {
        return $this->belongsTo(User::class, 'pelanggan_id');
    }

    public function ulasan()
{
    return $this->hasOne(Ulasan::class);
}

}
