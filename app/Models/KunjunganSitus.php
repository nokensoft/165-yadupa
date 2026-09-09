<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KunjunganSitus extends Model
{
    use HasFactory;

    protected $table = 'kunjungan_situs';

    // Matikan kolom updated_at karena di migrasi hanya menggunakan created_at
    public const UPDATED_AT = null;

    protected $fillable = [
        'ip_address',
        'tanggal',
        'url',
        'user_agent',
    ];

    /**
     * Memastikan format 'tanggal' selalu berupa string 'Y-m-d' murni
     * tanpa nilai jam (00:00:00) yang memicu kegagalan constraint di SQLite.
     */
    protected $casts = [
        'tanggal' => 'date:Y-m-d',
    ];
}