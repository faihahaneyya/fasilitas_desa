<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class FasilitasUmum extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'fasilitas_umum';
    protected $primaryKey = 'fasilitas_id';

    protected $fillable = [
        'name',
        'jenis',
        'alamat',
        'rt',
        'rw',
        'kapasitas',
        'deskripsi',
        // HAPUS 'fotos' dari sini karena sekarang pakai tabel media
    ];

    protected $casts = [
        'fasilitas_id' => 'integer',
        'kapasitas' => 'integer',
        // 'fotos' => 'array', // HAPUS casting ini juga
    ];

    public function getLokasiAttribute()
    {
        $lokasi = $this->alamat;
        if ($this->rt) {
            $lokasi .= ', RT ' . $this->rt;
        }
        if ($this->rw) {
            $lokasi .= ', RW ' . $this->rw;
        }
        return $lokasi;
    }
    public function getJenisColorAttribute()
    {
        $colors = [
            'aula' => 'primary',
            'lapangan' => 'success',
            'kantor' => 'info',
            'puskesmas' => 'danger',
            'sekolah' => 'warning',
            'poskamling' => 'secondary',
            'masjid' => 'success',
            'gereja' => 'info',
            'pura' => 'warning',
            'vihara' => 'secondary',
        ];

        return $colors[strtolower($this->jenis)] ?? 'dark';
    }

    public function peminjaman()
    {
        return $this->hasMany(PeminjamanFasilitas::class, 'fasilitas_id');
    }

    // Relasi ke tabel media (SUDAH ADA, TINGGAL DIKOMENTARI)
    public function media()
    {
        return $this->hasMany(Media::class, 'ref_id', 'fasilitas_id')
            ->where('ref_table', 'fasilitas_umum')
            ->orderBy('sort_order', 'asc');
    }

    public function fotos()
    {
        return $this->media()->where('mime_type', 'like', 'image/%');
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

    // Scope Search yang kita simpan sebelumnya
    public function scopeSearch($query, $request, array $columns)
    {
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request, $columns) {
                foreach ($columns as $column) {
                    $q->orWhere($column, 'LIKE', '%' . $request->search . '%');
                }
            });
        }
        return $query;
    }
}
