<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Galeri extends Model
{
    use SoftDeletes;

    protected $table = 'galeri';

    protected $fillable = [
        'judul',
        'slug',
        'deskripsi',
        'jumlah_dibaca',
        'cover_media_id',
        'is_publik',
        'user_id',
    ];

    protected function casts(): array
    {
        return [
            'is_publik' => 'boolean',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->judul);
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function media()
    {
        return $this->belongsToMany(Media::class, 'galeri_media')
            ->withPivot(['judul_item', 'keterangan_singkat', 'urutan'])
            ->withTimestamps()
            ->orderBy('galeri_media.urutan');
    }

    public function coverMedia()
    {
        return $this->belongsTo(Media::class, 'cover_media_id');
    }
}
