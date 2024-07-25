<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanSppd extends Model
{
    use HasFactory;
    protected $table = 'laporan_sppds';
    // protected $fillable = ['sppd_id', 'laporan_sppd'];
    protected $guarded = [];

    public function sppd()
    {
        return $this->belongsTo(Sppd::class, 'sppd_id');
    }
}
