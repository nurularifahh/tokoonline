<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_produk', 100);
            $table->string('nama_toko', 100);
            $table->date('tgl_pesanan');
            $table->decimal('total_harga', 15,2);
            $table->enum('status_pesanan', ['Menunggu','Diproses','Dikirim','Selesai','Dibatalkan',
                ])->default('Menunggu');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};
