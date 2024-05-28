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
        Schema::create('surat_masuks', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_agenda_tp')->nullable();
            $table->string('kode_lama')->nullable();
            $table->string('kode_baru')->nullable();
            $table->string('nomor_surat')->nullable();
            $table->string('opd_id')->nullable();
            $table->date('tgl_surat')->nullable();
            $table->date('tgl_terima')->nullable();
            $table->string('acara')->nullable();
            $table->date('tanggalBerangkat')->nullable();
            $table->date('tanggalPulang')->nullable();
            $table->time('jamMulai')->nullable();
            $table->string('tempat')->nullable();
            $table->string('perihal')->nullable();
            $table->string('dok_surat')->nullable();

            // $table->string('phone');
            // $table->string('message');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suratmasuks');
    }
};
