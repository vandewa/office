<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sppd extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function pegawai()
    {
        return $this->hasMany(SppdPegawai::class, 'sppd_id');
    }

    public function laporannya()
    {
        return $this->hasOne(LaporanSppd::class, 'sppd_id');
    }

    public function kendaraan()
    {
        return $this->belongsTo(ComCode::class, 'alat_angkut_st');
    }

}