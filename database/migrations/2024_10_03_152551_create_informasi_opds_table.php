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
        Schema::create('informasi_opds', function (Blueprint $table) {
            $table->id();
            $table->string('kdunit')->nullable();
            $table->text('alamat')->nullable();
            $table->string('website')->nullable();
            $table->string('telepon')->nullable();
            $table->string('fax')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('informasi_opds');
    }
};
