<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SppdPegawai extends Model
{
    use HasFactory;
    protected $fillable = ['sppd_id', 'nip', 'idskpd'];

    public function sppd()
    {
        return $this->belongsTo(Sppd::class, 'sppd_id');
    }
}
