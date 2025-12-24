<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

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

    public function scopeFilter(Builder $query, $request, array $filterableColumns): Builder
    {
        foreach ($filterableColumns as $column) {
            if ($request->filled($column)) {
                $query->where($column, $request->input($column));
            }
        }
        return $query;
    }

    // Scope Search (Snippet Simpanan dengan Pencarian Relasi)
    public function scopeSearch($query, $request, array $columns)
    {
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request, $columns) {
                foreach ($columns as $column) {
                    $q->orWhere($column, 'LIKE', '%' . $request->search . '%');
                }

                // Cari berdasarkan nama Warga (melalui Peminjaman)
                $q->orWhereHas('peminjaman.warga', function ($qw) use ($request) {
                    $qw->where('nama', 'LIKE', '%' . $request->search . '%');
                });
            });
        }
        return $query;
    }
}
