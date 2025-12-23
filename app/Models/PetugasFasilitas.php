<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PetugasFasilitas extends Model
{
    protected $table = 'petugas_fasilitas';
    protected $primaryKey = 'petugas_id';

    protected $fillable = [
        'fasilitas_id',
        'petugas_warga_id',
        'peran',
    ];

    // Relasi ke tabel Fasilitas
    public function fasilitas()
    {
        return $this->belongsTo(FasilitasUmum::class, 'fasilitas_id');
    }

    // Relasi ke tabel Warga
    public function warga()
    {
        return $this->belongsTo(Warga::class, 'petugas_warga_id', 'warga_id');
    }
}
