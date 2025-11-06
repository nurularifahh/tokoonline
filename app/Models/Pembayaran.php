<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    // Nama tabel (opsional, Laravel otomatis menebak dari nama model)
    protected $table = 'pembayarans';

    // Kolom yang boleh diisi (mass assignable)
    protected $fillable = [
        'toko_id',
        'kode_pembayaran',
        'jumlah',
        'metode',
        'status',
        'tanggal_pembayaran',
        'keterangan',
    ];

    /**
     * Relasi ke model Toko (setiap pembayaran milik satu toko)
     */
    public function toko()
    {
        return $this->belongsTo(Toko::class);
    }
}
