<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sppd extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'sppds';

    public function sppdPegawais()
    {
        return $this->hasMany(SppdPegawai::class, 'sppd_id');
    }

}
