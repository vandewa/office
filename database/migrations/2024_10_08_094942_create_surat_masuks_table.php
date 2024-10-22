<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('surat_masuks', function (Blueprint $table) {
            $table->id();
            $table->string('kode_lama')->nullable();
            $table->string('kode_baru')->nullable();
            $table->unsignedBigInteger('nomor_agenda')->nullable();
            $table->string('nomor_surat')->nullable();
            $table->date('tanggal_surat')->nullable();
            $table->date('tanggal_terima')->nullable();
            $table->string('opd_id')->nullable();
            $table->string('nama_instansi')->nullable();
            $table->text('perihal')->nullable();
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->time('jam_mulai')->nullable();
            $table->string('tempat')->nullable();
            $table->string('path_surat')->nullable();
            $table->string('surat_tp')->nullable();
            $table->string('kdunit')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_masuks');
    }
};
