<?php
// app/Models/PembayaranFasilitas.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembayaranFasilitas extends Model
{
    use HasFactory;

    protected $table = 'pembayaran_fasilitas';
    protected $primaryKey = 'bayar_id';
    public $timestamps = true;

    protected $fillable = [
        'pinjam_id',
        'tanggal',
        'jumlah',
        'metode',
        'keterangan'
    ];

    protected $casts = [
        'tanggal' => 'date',
        'jumlah' => 'decimal:2',
    ];

    // Relasi ke peminjaman_fasilitas
    public function peminjaman()
    {
        return $this->belongsTo(PeminjamanFasilitas::class, 'pinjam_id', 'pinjam_id');
    }
}
