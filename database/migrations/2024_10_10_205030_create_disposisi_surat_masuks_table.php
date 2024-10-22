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
        Schema::create('disposisi_surat_masuks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('surat_masuks_id')->nullable();
            $table->text('keterangan')->nullable();
            $table->string('disposisi_tp')->nullable();
            $table->string('created_by')->nullable();
            $table->string('tujuan_user_id')->nullable();
            $table->boolean('status_perjalanan_surat')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disposisi_surat_masuks');
    }
};
