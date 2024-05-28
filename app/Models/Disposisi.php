<?php

namespace App\Models;

use App\Models\Simpeg\Tb01;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disposisi extends Model
{
    use HasFactory;
    protected $table = 'disposisis';
    protected $guarded = [];

    public function tindakLanjut()
    {
        return $this->belongsTo(TindakLanjut::class, 'tindak_lanjut_id');
    }

    public function pegawaiDisposisi()
    {
        return $this->hasMany(Tb01::class, 'nip');
    }
}
