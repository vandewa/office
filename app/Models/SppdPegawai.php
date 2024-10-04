<?php

namespace App\Models;

use App\Models\Simpeg\Tb01;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SppdPegawai extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function sppd()
    {
        return $this->belongsTo(Sppd::class, 'sppd_id');
    }

    public function user()
    {
        return $this->belongsTo(Tb01::class, 'nip');
    }


}
