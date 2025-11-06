<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table = 'pesanans';

    protected $fillable = [
        'nama_produk',
        'nama_toko',
        'tgl_pesanan', 
        'total_harga',
        'metode_pembayaran',
        'status_pesanan',
    ];
}
