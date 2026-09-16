<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * blogs.kategori_blog_id was wrongly constrained to the orphaned
     * "kategori_blogs" table, while the app actually reads/writes
     * categories through the "kategori_berita" table (KategoriBlog model).
     * This caused foreign key violations when saving blogs.
     */
    public function up(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->dropForeign(['kategori_blog_id']);
        });

        Schema::table('blogs', function (Blueprint $table) {
            $table->foreign('kategori_blog_id')->references('id')->on('kategori_berita')->nullOnDelete();
        });

        Schema::dropIfExists('kategori_blogs');
    }

    public function down(): void
    {
        Schema::create('kategori_blogs', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('slug')->unique();
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });

        foreach (['Berita', 'Pengumuman', 'Agenda', 'Infografis'] as $category) {
            DB::table('kategori_blogs')->insert([
                'nama'       => $category,
                'slug'       => Str::slug($category),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        Schema::table('blogs', function (Blueprint $table) {
            $table->dropForeign(['kategori_blog_id']);
        });

        Schema::table('blogs', function (Blueprint $table) {
            $table->foreign('kategori_blog_id')->references('id')->on('kategori_blogs')->nullOnDelete();
        });
    }
};
