<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SyaratFasilitas extends Model
{
    protected $table = 'syarat_fasilitas';
    protected $primaryKey = 'syarat_id'; // Beritahu Laravel PK-nya bukan 'id'

    protected $fillable = [
        'fasilitas_id',
        'nama_syarat',
        'deskripsi',
    ];

    public function fasilitas()
    {
        return $this->belongsTo(FasilitasUmum::class, 'fasilitas_id');
    }
    public function media()
    {
        return $this->hasOne(Media::class, 'ref_id', 'syarat_id')->where('ref_table', 'syarat_fasilitas');
    }
}