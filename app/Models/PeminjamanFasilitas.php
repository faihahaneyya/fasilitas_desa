<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;


class PeminjamanFasilitas extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'peminjaman_fasilitas';
    protected $primaryKey = 'pinjam_id';

    protected $fillable = [
        'fasilitas_id',
        'warga_id',
        'tanggal_mulai',
        'tanggal_selesai',
        'tujuan',
        'status',
        'total_biaya',
        'catatan'
    ];

    protected $casts = [
        'pinjam_id' => 'integer',
        'fasilitas_id' => 'integer',
        'warga_id' => 'integer',
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
        'total_biaya' => 'decimal:2',
    ];

    // Relationship dengan FasilitasUmum
    public function fasilitas()
    {
        return $this->belongsTo(FasilitasUmum::class, 'fasilitas_id', 'fasilitas_id');
    }

    // Relationship dengan Warga
    public function warga()
    {
        return $this->belongsTo(Warga::class, 'warga_id', 'warga_id');
    }

    public function media()
    {
        return $this->hasMany(Media::class, 'ref_id', 'pinjam_id')
            ->where('ref_table', 'peminjaman');
    }

    // Accessor untuk durasi peminjaman
    public function getDurasiAttribute()
    {
        $start = \Carbon\Carbon::parse($this->tanggal_mulai);
        $end = \Carbon\Carbon::parse($this->tanggal_selesai);
        return $start->diffInDays($end) + 1;
    }

    // Accessor untuk format status
    public function getStatusColorAttribute()
    {
        $colors = [
            'pending' => 'warning',
            'approved' => 'success',
            'rejected' => 'danger',
            'completed' => 'info',
            'cancelled' => 'secondary',
        ];

        return $colors[$this->status] ?? 'dark';
    }

    // Accessor untuk status label
    public function getStatusLabelAttribute()
    {
        $labels = [
            'pending' => 'Menunggu',
            'approved' => 'Disetujui',
            'rejected' => 'Ditolak',
            'completed' => 'Selesai',
            'cancelled' => 'Dibatalkan',
        ];

        return $labels[$this->status] ?? $this->status;
    }

    // Scope untuk pencarian
    public function scopeFilter(Builder $query, $request, array $filterableColumns): Builder
    {
        foreach ($filterableColumns as $column) {
            if ($request->filled($column)) {
                $query->where($column, $request->input($column));
            }
        }
        return $query;
    }

    // Scope Search (Modifikasi sedikit untuk mencari di tabel relasi)
    public function scopeSearch($query, $request, array $columns)
    {
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request, $columns) {
                foreach ($columns as $column) {
                    $q->orWhere($column, 'LIKE', '%' . $request->search . '%');
                }
                // Tambahan: Cari berdasarkan nama warga
                $q->orWhereHas('warga', function ($queryWarga) use ($request) {
                    $queryWarga->where('nama', 'LIKE', '%' . $request->search . '%');
                });
                // Tambahan: Cari berdasarkan nama fasilitas
                $q->orWhereHas('fasilitas', function ($queryFas) use ($request) {
                    $queryFas->where('name', 'LIKE', '%' . $request->search . '%');
                });
            });
        }
        return $query;
    }

    // Validasi tanggal tidak boleh double booking
    public static function isAvailable($fasilitas_id, $tanggal_mulai, $tanggal_selesai, $excludeId = null)
    {
        $query = self::where('fasilitas_id', $fasilitas_id)
            ->where('status', 'approved')
            ->where(function ($q) use ($tanggal_mulai, $tanggal_selesai) {
                $q->whereBetween('tanggal_mulai', [$tanggal_mulai, $tanggal_selesai])
                    ->orWhereBetween('tanggal_selesai', [$tanggal_mulai, $tanggal_selesai])
                    ->orWhere(function ($q2) use ($tanggal_mulai, $tanggal_selesai) {
                        $q2->where('tanggal_mulai', '<=', $tanggal_mulai)
                            ->where('tanggal_selesai', '>=', $tanggal_selesai);
                    });
            });

        if ($excludeId) {
            $query->where('pinjam_id', '!=', $excludeId);
        }

        return $query->count() == 0;
    }
}
