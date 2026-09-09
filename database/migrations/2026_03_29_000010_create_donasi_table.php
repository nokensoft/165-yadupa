<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
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

    public function down(): void
    {
        Schema::dropIfExists('donasi');
    }
};
