<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('galeri_media', function (Blueprint $table) {
            $table->string('judul_item')->nullable()->after('media_id');
            $table->text('keterangan_singkat')->nullable()->after('judul_item');
            $table->unsignedInteger('urutan')->default(0)->after('keterangan_singkat');
        });
    }

    public function down(): void
    {
        Schema::table('galeri_media', function (Blueprint $table) {
            $table->dropColumn(['judul_item', 'keterangan_singkat', 'urutan']);
        });
    }
};
