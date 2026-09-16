<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * The "category" column was dropped in favor of a blog_categories/blog_post_category
     * pivot that was never actually implemented (no model/relation, never seeded).
     * Meanwhile InformasiController, InformasiCategoryController and the informasi.*
     * views still read/write the "category" column directly, causing "no such column"
     * SQL errors on the visitor informasi pages and on every operator berita/pengumuman/
     * agenda/infografis page. Restore the column and drop the unused pivot tables.
     */
    public function up(): void
    {
        Schema::table('blog_posts', function (Blueprint $table) {
            $table->enum('category', ['Berita', 'Pengumuman', 'Agenda', 'Infografis'])->default('Berita')->after('slug');
        });

        Schema::dropIfExists('blog_post_category');
        Schema::dropIfExists('blog_categories');
    }

    public function down(): void
    {
        Schema::create('blog_categories', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('slug')->unique();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('blog_post_category', function (Blueprint $table) {
            $table->id();
            $table->foreignId('blog_post_id')->constrained()->cascadeOnDelete();
            $table->foreignId('blog_category_id')->constrained()->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['blog_post_id', 'blog_category_id'], 'blog_post_category_unique');
        });

        Schema::table('blog_posts', function (Blueprint $table) {
            $table->dropColumn('category');
        });
    }
};
