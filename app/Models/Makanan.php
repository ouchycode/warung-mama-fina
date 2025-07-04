<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Makanan extends Model
{
    use HasFactory;

    // Kolom yang boleh diisi mass-assignment
    protected $fillable = [
        'nama',
        'harga',
        'gambar',
        'kategori',
    ];

    // Relasi many-to-many ke pesanan
    public function pesanan()
    {
        return $this->belongsToMany(Pesanan::class)->withPivot('jumlah');
    }
}
