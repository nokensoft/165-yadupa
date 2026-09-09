<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Blog extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'blogs';

    protected $fillable = [
        'judul',
        'slug',
        'ringkasan',
        'konten',
        'sumber_nama',
        'sumber_link',
        'kategori_blog_id',
        'media_id',
        'gambar_url',
        'user_id',
        'status',
        'jumlah_dibaca',
        'tanggal_terbit',
    ];

    protected $casts = [
        'tanggal_terbit' => 'date',
        'jumlah_dibaca'  => 'integer',
    ];

    protected static function booted(): void
    {
        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->judul);
            }
        });

        static::updating(function ($model) {
            if ($model->isDirty('judul') && empty($model->slug)) {
                $model->slug = Str::slug($model->judul);
            }
        });
    }

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function kategoriBlog(): BelongsTo
    {
        return $this->belongsTo(KategoriBlog::class, 'kategori_blog_id');
    }

    // Alias untuk relasi kategori
    public function kategori(): BelongsTo
    {
        return $this->kategoriBlog();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    public function getGambarAttribute(): string
    {

        if ($this->gambar_url) {
            if (str_starts_with($this->gambar_url, 'http://') || str_starts_with($this->gambar_url, 'https://')) {
                return $this->gambar_url;
            }
            return asset('storage/' . $this->gambar_url);
        }

        return 'https://placehold.co/600x400';
    }
}