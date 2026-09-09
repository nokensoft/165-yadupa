<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();

        if (Schema::hasTable('donasi')) {
            Schema::drop('donasi');
        }

        if (Schema::hasTable('program_donasi')) {
            Schema::drop('program_donasi');
        }

        Schema::enableForeignKeyConstraints();
    }

    public function down(): void
    {
        if (!Schema::hasTable('program_donasi')) {
            Schema::create('program_donasi', function (Blueprint $table) {
                $table->id();
                $table->string('judul');
                $table->string('slug')->unique();
                $table->longText('deskripsi')->nullable();
                $table->foreignId('media_id')->nullable()->constrained('media')->nullOnDelete();
                $table->unsignedBigInteger('target_nominal')->nullable();
                $table->boolean('is_active')->default(true);
                $table->foreignId('user_id')->constrained()->cascadeOnDelete();
                $table->timestamps();
                $table->softDeletes();
            });
        }

        if (!Schema::hasTable('donasi')) {
            Schema::create('donasi', function (Blueprint $table) {
                $table->id();
                $table->foreignId('program_donasi_id')->nullable()->constrained('program_donasi')->nullOnDelete();
                $table->string('nama_donatur');
                $table->boolean('is_anonim')->default(false);
                $table->string('email')->nullable();
                $table->string('telepon', 20)->nullable();
                $table->string('bank')->nullable();
                $table->bigInteger('jumlah')->unsigned()->nullable();
                $table->text('pesan')->nullable();
                $table->string('bukti_transfer')->nullable();
                $table->enum('status', ['pending', 'dikonfirmasi', 'ditolak'])->default('pending');
                $table->boolean('is_publik')->default(true);
                $table->text('catatan_admin')->nullable();
                $table->date('tanggal');
                $table->timestamps();
                $table->softDeletes();
            });
        }
    }
};
