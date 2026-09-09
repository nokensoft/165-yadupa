<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Kategori lama diwarisi dari template Dinas Pendidikan (Prestasi, Ujian, HUT RI, dll.)
     * dan tidak relevan dengan kegiatan YADUPA. Diganti dengan kategori yang mencerminkan
     * jenis kegiatan nyata YADUPA (lihat __TEMPLATE/media.json).
     */
    private const OLD_CATEGORIES = ['Prestasi', 'Sarana & Prasarana', 'Ujian', 'Pertemuan', 'HUT RI', 'Kegiatan Dinas'];
    private const NEW_CATEGORIES = ['Pelatihan', 'Lokakarya & Pemetaan', 'Rapat & Pertemuan', 'Lomba & Kompetisi', 'Perencanaan Strategis'];

    public function up(): void
    {
        // Baris lama memakai kategori Disdikpora yang tidak lagi valid pada CHECK
        // constraint baru; data ini akan digantikan oleh PhotoSeeder versi YADUPA.
        DB::table('photos')->delete();

        Schema::table('photos', function (Blueprint $table) {
            $table->enum('category', self::NEW_CATEGORIES)->default('Pelatihan')->change();
        });
    }

    public function down(): void
    {
        Schema::table('photos', function (Blueprint $table) {
            $table->enum('category', self::OLD_CATEGORIES)->default('Kegiatan Dinas')->change();
        });
    }
};
