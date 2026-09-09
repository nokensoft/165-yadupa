<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('galeri', function (Blueprint $table) {
            $table->unsignedInteger('jumlah_dibaca')->default(0)->after('deskripsi');
        });
    }

    public function down(): void
    {
        Schema::table('galeri', function (Blueprint $table) {
            $table->dropColumn('jumlah_dibaca');
        });
    }
};
