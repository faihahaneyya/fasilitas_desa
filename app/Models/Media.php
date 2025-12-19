<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Media extends Model
{
    use SoftDeletes;

    protected $table      = 'media';
    protected $primaryKey = 'media_id';

    protected $fillable = [
        'ref_table',
        'ref_id',
        'file_name',
        'caption',
        'mime_type',
        'sort_order',
    ];

    /**
     * Scope untuk mendapatkan media berdasarkan tabel dan ID
     */
    public function scopeForReference($query, $refTable, $refId)
    {
        return $query->where('ref_table', $refTable)
            ->where('ref_id', $refId)
            ->orderBy('sort_order', 'asc');
    }

    /**
     * Scope untuk fasilitas umum
     */
    public function scopeForFasilitas($query, $fasilitasId)
    {
        return $this->forReference('fasilitas_umum', $fasilitasId);
    }

    /**
     * Scope untuk peminjaman (perminjaman)
     */
    public function scopeForPeminjaman($query, $peminjamanId)
    {
        return $query->where('ref_table', 'peminjaman')
            ->where('ref_id', $peminjamanId)
            ->orderBy('sort_order', 'asc');
    }

    /**
     * Scope untuk detail peminjaman (jika ada tabel detail)
     */
    public function scopeForDetailPeminjaman($query, $detailPeminjamanId)
    {
        return $this->forReference('detail_perminjaman', $detailPeminjamanId);
    }

    /**
     * Scope untuk pengembalian (jika ada tabel pengembalian)
     */
    public function scopeForPengembalian($query, $pengembalianId)
    {
        return $this->forReference('pengembalian', $pengembalianId);
    }

    /**
     * Mendapatkan URL lengkap untuk file
     */
    public function getFileUrlAttribute()
    {
        return asset('storage/' . $this->file_name);
    }

    /**
     * Mendapatkan path lengkap untuk file
     */
    /**
     * Mendapatkan ekstensi file
     */
    public function getFileExtensionAttribute()
    {
        return pathinfo($this->file_name, PATHINFO_EXTENSION);
    }

/**
 * Mengecek apakah file adalah gambar
 */
    public function getIsImageAttribute()
    {
        $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg', 'webp'];
        return in_array(strtolower($this->file_extension), $imageExtensions);
    }
}
