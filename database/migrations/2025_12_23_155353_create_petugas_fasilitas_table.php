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
        Schema::create('petugas_fasilitas', function (Blueprint $table) {
            $table->id('petugas_id'); // Primary Key
            $table->foreignId('fasilitas_id')->constrained('fasilitas_umum',"fasilitas_id")->onDelete('cascade');
            $table->foreignId('petugas_warga_id')->constrained('warga', 'warga_id')->onDelete('cascade');
            $table->string('peran'); // Contoh: Ketua, Sekretaris, Anggota
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('petugas_fasilitas');
    }
};
