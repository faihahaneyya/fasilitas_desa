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
        Schema::create('peminjaman_fasilitas', function (Blueprint $table) {
            $table->id('pinjam_id');
            $table->unsignedBigInteger('fasilitas_id');
            $table->unsignedBigInteger('warga_id');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->text('tujuan');
            $table->enum('status', ['pending', 'approved', 'rejected', 'completed', 'cancelled'])
                  ->default('pending');
            $table->decimal('total_biaya', 15, 2)->default(0);
            $table->text('catatan')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Foreign key constraints
            $table->foreign('fasilitas_id')
                  ->references('fasilitas_id')
                  ->on('fasilitas_umum')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');

            $table->foreign('warga_id')
                  ->references('warga_id')
                  ->on('warga')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');

            // Indexes untuk performa
            $table->index('fasilitas_id');
            $table->index('warga_id');
            $table->index('status');
            $table->index(['tanggal_mulai', 'tanggal_selesai']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman_fasilitas');
    }
};
