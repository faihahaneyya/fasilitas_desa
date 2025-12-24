<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_pembayaran_fasilitas_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

 public function up(): void
    {
        Schema::create('pembayaran_fasilitas', function (Blueprint $table) {
            $table->id('bayar_id');

            // TAMBAHKAN PARAMETER KEDUA: 'pinjam_id'
            $table->foreignId('pinjam_id')->constrained('peminjaman_fasilitas', 'pinjam_id')->onDelete('cascade');

            $table->date('tanggal');
            $table->decimal('jumlah', 12, 2);
            $table->string('metode', 50);
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->index('pinjam_id');  // Ini sudah benar, biarkan
            $table->index('tanggal');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayaran_fasilitas');
    }
};
