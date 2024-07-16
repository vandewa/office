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
        Schema::table('surat_masuks', function (Blueprint $table) {
            $table->foreign('document_id')->references('id')->on('documents')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('surat_masuks', function (Blueprint $table) {
            $table->dropForeign(['document_id']);
        });
    }
};
