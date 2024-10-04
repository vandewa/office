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
        Schema::table('sppd_pegawais', function (Blueprint $table) {
            $table->renameColumn('idskpd', 'kdunit');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sppd_pegawais', function (Blueprint $table) {
            $table->renameColumn('idskpd', 'kdunit');
        });
    }
};
