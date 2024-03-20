<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DasarSppd extends Model
{
    use HasFactory;
    protected $fillable = ['sppd_id', 'dasar'];

    public function sppd()
    {
        return $this->belongsTo(Sppd::class, 'sppd_id');
    }
}
