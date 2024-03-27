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
        Schema::create('dasar_sppds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sppd_id');
            $table->foreign('sppd_id')->references('id')->on('sppds');
            $table->string('dasar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dasar_sppds');
    }
};
