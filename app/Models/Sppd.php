<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sppd extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'sppds';

    public static function findOrFail($id)
    {
        return static::find($id) ?: abort(404);
    }

    public function sppdPegawais()
    {
        return $this->hasMany(SppdPegawai::class, 'sppd_id');
    }

    public function statusLaporans()
    {
        return $this->hasMany(statusLaporan::class, 'sppd_id');
    }

    public function laporanSppd()
    {
        return $this->hasMany(laporanSppd::class, 'sppd_id');
    }

    public function dasarSppd()
    {
        return $this->hasMany(DasarSppd::class, 'sppd_id');
    }
}
