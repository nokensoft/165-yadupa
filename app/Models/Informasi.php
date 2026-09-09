<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Informasi extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'category',
        'slug',
        'image',
        'content',
        'status',
        'published_at',
    ];

    protected $casts = [
        'status'       => 'boolean',
        'published_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopePublished($query)
    {
        return $query->where('status', true);
    }

    /**
     * URL gambar. Mendukung gambar lama (seeder, langsung di public/img/...)
     * maupun gambar baru hasil upload operator (storage/app/public/informasi/...).
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