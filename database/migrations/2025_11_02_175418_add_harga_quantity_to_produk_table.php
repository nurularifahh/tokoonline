<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        Schema::table('produk', function (Blueprint $table) {
            // Tambahkan kolom harga dan quantity
            $table->decimal('harga', 15, 2)->after('tgl_masuk');
            $table->integer('quantity')->after('harga');
        });
    }

    /**
     * Batalkan migrasi.
     */
    public function down(): void
    {
        Schema::table('produk', function (Blueprint $table) {
            // Hapus kolom jika migrasi dibatalkan
            $table->dropColumn(['harga', 'quantity']);
        });
    }
};
