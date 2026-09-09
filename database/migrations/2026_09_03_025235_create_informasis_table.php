<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('informasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // Ditambahkan agar sesuai dengan model
            $table->string('title');
            $table->string('slug')->unique();
            $table->enum('category', ['Berita', 'Pengumuman', 'Agenda', 'Infografis']);
            $table->string('image')->nullable(); 
            $table->longText('content')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('informasis');
    }
};