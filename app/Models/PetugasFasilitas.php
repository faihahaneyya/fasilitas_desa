<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
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

    public function scopeFilter(Builder $query, $request, array $filterableColumns): Builder
    {
        foreach ($filterableColumns as $column) {
            if ($request->filled($column)) {
                $query->where($column, $request->input($column));
            }
        }
        return $query;
    }

    // Scope Search (Pencarian Lintas Tabel)
    public function scopeSearch($query, $request, array $columns)
    {
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request, $columns) {
                foreach ($columns as $column) {
                    $q->orWhere($column, 'LIKE', '%' . $request->search . '%');
                }
                // Cari berdasarkan NAMA WARGA yang jadi petugas
                $q->orWhereHas('warga', function ($qw) use ($request) {
                    $qw->where('nama', 'LIKE', '%' . $request->search . '%');
                });
            });
        }
        return $query;
    }
}
