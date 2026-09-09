<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Atribut yang dapat diisi secara massal (mass assignable).
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'slug',
        'cover',
        'content',
        'status',
    ];

    /**
     * Atribut yang harus di-cast ke tipe data tertentu.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'status' => 'boolean',
    ];

    /**
     * URL gambar cover. Mendukung gambar lama (seeder, langsung di public/img/...)
     * maupun gambar baru hasil upload operator (storage/app/public/pages/...).
     */
    public function getGambarAttribute(): ?string
    {
        if (!$this->cover) {
            return null;
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
