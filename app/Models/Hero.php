<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hero extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Kolom yang dapat diisi secara massal (mass assignable).
     */
    protected $fillable = [
        'title',
        'image',
        'priority',
        'status',
        'published_at',
    ];

    /**
     * Konversi tipe data bawaan (type casting).
     */
    protected $casts = [
        'priority'     => 'integer',
        'status'       => 'boolean',
        'published_at' => 'datetime',
    ];

    /**
     * URL gambar hero. Mendukung dua bentuk:
     * - Gambar lama hasil seeder yang disimpan langsung di public/img/... (asset() langsung).
     * - Gambar baru hasil upload operator yang disimpan di storage/app/public/hero/... (via storage disk).
     */
    public function getGambarAttribute(): string
    {
        if (!$this->image) {
            return 'https://placehold.co/1080x350';
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