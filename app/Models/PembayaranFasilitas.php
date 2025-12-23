<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembayaranFasilitas extends Model
{
    use HasFactory;

    protected $table = 'pembayaran_fasilitas';
    protected $primaryKey = 'bayar_id';

    protected $fillable = [
        'pinjam_id',
        'tanggal',
        'jumlah',
        'metode',
        'keterangan',
    ];

    // TAMBAHKAN CASTING untuk tanggal
    protected $casts = [
        'tanggal' => 'date',
        'jumlah' => 'decimal:2',
    ];

    // Relasi ke peminjaman
    public function peminjaman()
    {
        return $this->belongsTo(PeminjamanFasilitas::class, 'pinjam_id', 'pinjam_id');
    }

    // Relasi ke tabel media untuk bukti pembayaran
    public function buktiPembayaran()
    {
        // Pastikan ref_table sesuai dengan string yang Anda simpan saat upload
        return $this->hasMany(Media::class, 'ref_id', 'bayar_id')
            ->where('ref_table', 'pembayaran_fasilitas');
    }
}
