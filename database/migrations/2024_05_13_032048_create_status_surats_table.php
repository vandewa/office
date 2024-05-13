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
            $table->timestamps();
            $table->string('verifikasi_kadin');
            $table->string('verifikasi_kabid');
            $table->string('verifikasi_sekretariat');
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
