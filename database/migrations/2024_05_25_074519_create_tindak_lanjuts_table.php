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
        Schema::create('tindak_lanjuts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('surat_masuk_id')->nullable(); // Misalkan boleh kosong
            $table->string('nip')->nullable();
            $table->string('nama')->nullable();
            $table->unsignedBigInteger('surat_keluar_id')->nullable(); // Kolom baru untuk relasi ke SuratKeluar
            $table->foreign('surat_masuk_id')->references('id')->on('surat_masuks')->onDelete('cascade'); // Atur aksi kaskade;
            $table->foreign('surat_keluar_id')->references('id')->on('surat_keluars')->onDelete('cascade'); // Atur aksi kaskade;
            $table->string('deskripsi')->nullable();
            $table->string('diteruskan_kepada')->nullable();
            $table->string('disposisi')->nullable();
            $table->string('revisi')->nullable(); // Kolom untuk checkbox
            // $table->enum('metode_ttd', ['Tanda_Tangan_Offline', 'Tanda_Tangan_Online'])->nullable();
            $table->string('metode_ttd')->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tindak_lanjuts');
    }
};
