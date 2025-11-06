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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();

            // Relasi ke tabel toko
            $table->foreignId('toko_id')
                ->constrained('tokos')
                ->onDelete('cascade');

            // Nomor unik pembayaran
            $table->string('kode_pembayaran', 50)->unique();

            // Jumlah total pembayaran
            $table->decimal('jumlah', 15, 2);

            // Metode pembayaran (misalnya: transfer, e-wallet, cash)
            $table->string('metode', 50);

            // Status pembayaran tunggal (misalnya: "selesai")
            $table->string('status', 20)->default('selesai');

            // Tanggal pembayaran (jika sudah dibayar)
            $table->dateTime('tanggal_pembayaran')->nullable();

            // Catatan tambahan
            $table->text('keterangan')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
