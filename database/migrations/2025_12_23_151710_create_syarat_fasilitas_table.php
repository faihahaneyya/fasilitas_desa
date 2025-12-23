<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('syarat_fasilitas', function (Blueprint $table) {
            $table->id('syarat_id'); // Primary Key sesuai gambar
            $table->foreignId('fasilitas_id')->constrained('fasilitas_umum','fasilitas_id')->onDelete('cascade');
            $table->string('nama_syarat');
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('syarat_fasilitas');
    }
};
