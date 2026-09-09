<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'videos';

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'cover',
        'youtube_url',
        'category',
        'keterangan',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    /**
     * Scope query untuk hanya mengambil video yang berstatus aktif/terpublikasi.
     */
    public function scopePublished($query)
    {
        return $query->where('status', true);
    }

    /**
     * Accessor untuk mendapatkan Embed URL YouTube (cocok untuk iframe di Blade).
     */
    public function getYoutubeEmbedUrlAttribute()
    {
        preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $this->youtube_url, $matches);
        
        return isset($matches[1]) ? "https://www.youtube.com/embed/{$matches[1]}" : null;
    }

    /**
     * Relasi ke model User (Uploader video)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * URL gambar sampul. Mendukung gambar lama (seeder, langsung di public/img/...)
     * maupun gambar baru hasil upload operator (storage/app/public/video/...).
     */
    public function getGambarAttribute(): string
    {
        if (!$this->cover) {
            return 'https://placehold.co/1200x675';
        }
        if (str_starts_with($this->cover, 'http://') || str_starts_with($this->cover, 'https://')) {
            return $this->cover;
        }
        if (str_starts_with($this->cover, 'img/')) {
            return asset($this->cover);
        }
        return asset('storage/' . $this->cover);
    }
}