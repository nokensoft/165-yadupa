<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Photo extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'photos';

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'image',
        'category',
        'keterangan',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    /**
     * Scope query untuk hanya mengambil foto yang berstatus aktif/terpublikasi.
     */
    public function scopePublished($query)
    {
        return $query->where('status', true);
    }

    /**
     * Relasi ke model User (Uploader foto)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * URL gambar. Mendukung gambar lama (seeder, langsung di public/img/...)
     * maupun gambar baru hasil upload operator (storage/app/public/foto/...).
     */
    public function getGambarAttribute(): string
    {
        if (!$this->image) {
            return 'https://placehold.co/1200x675';
        }
        if (str_starts_with($this->image, 'http://') || str_starts_with($this->image, 'https://')) {
            return $this->image;
        }
        if (str_starts_with($this->image, 'img/')) {
            return asset($this->image);
        }
        return asset('storage/' . $this->image);
    }
}