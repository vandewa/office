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
        Schema::create('disposisis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tindak_lanjut_id');
            $table->foreign('tindak_lanjut_id')->references('id')->on('tindak_lanjuts')->onDelete('cascade'); // Atur aksi kaskade;
            $table->date('tanggal_disposisi')->nullable();
            $table->string('catatan')->nullable();
            $table->enum('status_disposisi', ['Selesai', 'Belum Selesai'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disposisis');
    }
};
