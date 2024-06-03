<?php

namespace App\Models;

use App\Models\Simpeg\Tb01;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SppdPegawai extends Model
{
    use HasFactory;
    protected $table = 'sppd_pegawais';
    protected $fillable = ['sppd_id', 'nip'];

    public function sppd()
    {
        return $this->belongsTo(Sppd::class, 'sppd_id');
    }

    public function tb01()
    {
        return $this->belongsTo(Tb01::class, 'nip');
    }
}
