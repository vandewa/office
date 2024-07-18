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
        Schema::create('surat_keluars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('document_id')->nullable(); // Tambahkan kolom ini
            // $table->foreign('document_id')->references('id')->on('documents')->onDelete('cascade');
            $table->string('nomor_surat')->nullable();
            $table->string('jenis_surat')->nullable();
            $table->string('tanggal_surat')->nullable();
            $table->string('perihal')->nullable();
            $table->string('tujuan')->nullable();
            $table->string('tempat_tujuan')->nullable();
            $table->string('pembukaan')->nullable();
            $table->string('isi')->nullable();
            $table->string('hari')->nullable();
            $table->date('tanggal')->nullable();
            $table->time('pukul_mulai')->nullable();
            $table->time('pukul_selesai')->nullable();
            $table->string('tempat_acara')->nullable();
            $table->string('penutup')->nullable();
            // $table->string('lampiran')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_keluars');
    }
};
