<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusLaporan extends Model
{
    use HasFactory;
    protected $table = 'status_laporans';
    protected $fillable = ['sppd_id', 'status_laporan'];

    public function sppd()
    {
        return $this->belongsTo(Sppd::class, 'sppd_id');
    }
}
