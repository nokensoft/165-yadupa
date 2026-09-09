<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Buat Tabel Kategori Blogs
        Schema::create('kategori_blogs', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('slug')->unique();
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });

        // 2. Buat Tabel Blogs
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('slug')->nullable()->unique();
            $table->text('ringkasan')->nullable();
            $table->longText('konten');
            $table->string('sumber_nama')->nullable();
            $table->string('sumber_link')->nullable();
            $table->foreignId('kategori_blog_id')->nullable()->constrained('kategori_blogs')->nullOnDelete();
            $table->string('gambar_url')->nullable();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->enum('status', ['draft', 'terbit'])->default('draft');
            $table->date('tanggal_terbit')->nullable();
            $table->unsignedInteger('jumlah_dibaca')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        // 3. Insert Default Kategori Blogs
        $categories = ['Berita', 'Pengumuman', 'Agenda', 'Infografis'];
        
        foreach ($categories as $category) {
            DB::table('kategori_blogs')->insert([
                'nama'       => $category,
                'slug'       => Str::slug($category),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('blogs');
        Schema::dropIfExists('kategori_blogs');
    }
};