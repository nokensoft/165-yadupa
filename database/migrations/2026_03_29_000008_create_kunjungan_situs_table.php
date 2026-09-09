<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kunjungan_situs', function (Blueprint $table) {
            $table->id();
            $table->string('ip_address', 45);
            $table->date('tanggal');
            $table->string('url')->nullable();
            $table->string('user_agent')->nullable();
            $table->timestamp('created_at')->useCurrent();

            // Memastikan 1 IP hanya dicatat 1 kali per hari
            $table->unique(['ip_address', 'tanggal']);
            $table->index('tanggal');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kunjungan_situs');
    }
};