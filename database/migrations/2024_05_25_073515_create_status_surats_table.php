<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('status_surats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('surat_masuk_id');
            // $table->unsignedBigInteger('surat_keluar_id');
            $table->foreign('surat_masuk_id')->references('id')->on('surat_masuks')->onDelete('cascade'); // Atur aksi kaskade;
            // $table->foreign('surat_keluar_id')->references('id')->on('surat_keluars')->onDelete('cascade'); // Atur aksi kaskade;
            $table->enum('status_surat', ['Verifikasi Kepala Dinas', 'Verifikasi Kepala Bidang', 'Sekretariat', 'Sudah Distribusikan'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status_surats');
    }
};
