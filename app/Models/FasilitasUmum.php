<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
        'deskripsi'
    ];

    protected $casts = [
        'fasilitas_id' => 'integer',
        'kapasitas' => 'integer',
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

    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', "%{$search}%")
                    ->orWhere('jenis', 'like', "%{$search}%")
                    ->orWhere('alamat', 'like', "%{$search}%");
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
}
