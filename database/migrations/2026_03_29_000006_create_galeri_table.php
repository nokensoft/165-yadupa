<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('galeri', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('slug')->nullable()->unique();
            $table->text('deskripsi')->nullable();
            $table->enum('kategori', ['Kegiatan', 'Budaya', 'Komunitas', 'Program', 'Lainnya'])->default('Lainnya');
            $table->boolean('is_publik')->default(true);
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('galeri');
    }
};
