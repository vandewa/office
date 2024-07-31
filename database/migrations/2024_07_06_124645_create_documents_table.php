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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('dok_surat')->nullable();
            $table->string('name')->nullable();
            $table->unsignedBigInteger('surat_masuk_id')->nullable();
            $table->unsignedBigInteger('surat_keluar_id')->nullable();
            $table->foreign('surat_masuk_id')->references('id')->on('surat_masuks')->onDelete('set null');
            $table->foreign('surat_keluar_id')->references('id')->on('surat_keluars')->onDelete('set null');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('documents', function (Blueprint $table) {
            // Menghapus foreign key dan kolom
            $table->dropForeign(['surat_masuk_id']);
            $table->dropForeign(['surat_keluar_id']);
            $table->dropColumn(['surat_masuk_id', 'surat_keluar_id']);
        });
    }
};
