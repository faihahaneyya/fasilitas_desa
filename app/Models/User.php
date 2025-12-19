<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'birthdate',
        'address',
        'city',
        'country',
        'role',
        'is_active',
        'email_verified_at',
        'profile_picture',
        'last_login_at',
        'last_login_ip',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'birthdate' => 'date',
            'is_active' => 'boolean',
            'last_login_at' => 'datetime',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    /**
     * Scope untuk user aktif
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope untuk user berdasarkan role
     */
    public function scopeByRole($query, $role)
    {
        return $query->where('role', $role);
    }

    /**
     * Scope untuk pencarian
     */
    public function scopeSearch($query, $search)
    {
        if (!$search) {
            return $query;
        }

        return $query->where(function($q) use ($search) {
            $q->where('name', 'like', '%' . $search . '%')
              ->orWhere('email', 'like', '%' . $search . '%')
              ->orWhere('phone', 'like', '%' . $search . '%');
        });
    }

    /**
     * Scope untuk filter by status
     */
    public function scopeFilterByStatus($query, $status)
    {
        if (!$status) {
            return $query;
        }

        if ($status === 'active') {
            return $query->where('is_active', true);
        } elseif ($status === 'inactive') {
            return $query->where('is_active', false);
        }

        return $query;
    }

    /**
     * Scope untuk user yang belum verifikasi email
     */
    public function scopeUnverified($query)
    {
        return $query->whereNull('email_verified_at');
    }

    /**
     * Scope untuk user baru bulan ini
     */
    public function scopeNewThisMonth($query)
    {
        return $query->whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year);
    }

    /**
     * Accessor untuk nama lengkap dengan huruf kapital di setiap kata
     */
    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => ucwords($value),
            set: fn (string $value) => strtolower($value),
        );
    }

    /**
     * Accessor untuk email lowercase
     */
    protected function email(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => strtolower($value),
        );
    }

    /**
     * Accessor untuk inisial nama
     */
    public function getInitialsAttribute(): string
    {
        $words = explode(' ', $this->name);
        $initials = '';

        foreach ($words as $word) {
            if (!empty($word)) {
                $initials .= strtoupper($word[0]);
            }
        }

        return substr($initials, 0, 2);
    }

    /**
     * Accessor untuk status aktif
     */
    public function getStatusAttribute(): string
    {
        return $this->is_active ? 'Active' : 'Inactive';
    }

    /**
     * Accessor untuk status verifikasi email
     */
    public function getEmailVerifiedStatusAttribute(): string
    {
        return $this->email_verified_at ? 'Verified' : 'Unverified';
    }

    /**
     * Accessor untuk usia (jika birthdate tersedia)
     */
    public function getAgeAttribute(): ?int
    {
        if (!$this->birthdate) {
            return null;
        }

        return now()->diffInYears($this->birthdate);
    }

    /**
     * Accessor untuk format tanggal lahir
     */
    public function getFormattedBirthdateAttribute(): ?string
    {
        if (!$this->birthdate) {
            return null;
        }

        return $this->birthdate->format('d F Y');
    }

    /**
     * Accessor untuk format tanggal dibuat
     */
    public function getFormattedCreatedAtAttribute(): string
    {
        return $this->created_at->format('d M Y, H:i');
    }

    /**
     * Accessor untuk format tanggal login terakhir
     */
    public function getFormattedLastLoginAtAttribute(): ?string
    {
        if (!$this->last_login_at) {
            return 'Never logged in';
        }

        return $this->last_login_at->diffForHumans();
    }

    /**
     * Method untuk mengecek apakah user adalah admin
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Method untuk mengecek apakah user adalah manager
     */
    public function isManager(): bool
    {
        return $this->role === 'manager';
    }

    /**
     * Method untuk mengecek apakah user memiliki role tertentu
     */
    public function hasRole($role): bool
    {
        if (is_array($role)) {
            return in_array($this->role, $role);
        }

        return $this->role === $role;
    }

    /**
     * Method untuk mengaktifkan user
     */
    public function activate(): bool
    {
        return $this->update(['is_active' => true]);
    }

    /**
     * Method untuk menonaktifkan user
     */
    public function deactivate(): bool
    {
        return $this->update(['is_active' => false]);
    }

    /**
     * Method untuk memverifikasi email
     */
    public function verifyEmail(): bool
    {
        return $this->update(['email_verified_at' => now()]);
    }

    /**
     * Method untuk update last login
     */
    public function updateLastLogin(?string $ip = null): bool
    {
        return $this->update([
            'last_login_at' => now(),
            'last_login_ip' => $ip,
        ]);
    }

    /**
     * Method untuk mendapatkan alamat lengkap
     */
    public function getFullAddressAttribute(): ?string
    {
        $parts = [];

        if ($this->address) {
            $parts[] = $this->address;
        }

        if ($this->city) {
            $parts[] = $this->city;
        }

        if ($this->country) {
            $parts[] = $this->country;
        }

        return empty($parts) ? null : implode(', ', $parts);
    }

    /**
     * Relationship dengan posts (jika ada)
     */
    public function posts()
    {
        return $this->hasMany(\App\Models\Post::class);
    }

    /**
     * Relationship dengan comments (jika ada)
     */
    public function comments()
    {
        return $this->hasMany(\App\Models\Comment::class);
    }

    /**
     * Boot method untuk event listeners
     */
    protected static function boot()
    {
        parent::boot();

        // Set default role saat membuat user baru
        static::creating(function ($user) {
            if (empty($user->role)) {
                $user->role = 'user';
            }

            if (is_null($user->is_active)) {
                $user->is_active = true;
            }
        });

        // Event setelah user dibuat
        static::created(function ($user) {
            // Kirim email verifikasi atau notifikasi di sini
        });

        // Event sebelum user diupdate
        static::updating(function ($user) {
            // Log perubahan di sini jika diperlukan
        });
    }
}
