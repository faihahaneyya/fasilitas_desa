<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

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

    public function scopeFilter(Builder $query, $request, array $filterableColumns): Builder
    {
        foreach ($filterableColumns as $column) {
            if ($request->filled($column)) {
                $query->where($column, $request->input($column));
            }
        }
        return $query;
    }

    // Scope Search (Snippet Simpanan)
    public function scopeSearch($query, $request, array $columns)
    {
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request, $columns) {
                foreach ($columns as $column) {
                    $q->orWhere($column, 'LIKE', '%' . $request->search . '%');
                }
                // Tambahan: Bisa juga mencari berdasarkan nama fasilitasnya
                $q->orWhereHas('fasilitas', function ($f) use ($request) {
                    $f->where('name', 'LIKE', '%' . $request->search . '%');
                });
            });
        }
        return $query;
    }
}