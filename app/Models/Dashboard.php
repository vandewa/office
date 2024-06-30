<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dashboard extends Model
{
    use HasFactory;
    protected $guarded = [];
    // protected $table = 'surat_masuks';

    public function tindakLanjuts()
    {
        return $this->hasMany(TindakLanjut::class, 'surat_masuk_id', 'surat_keluar_id');
    }

    public function statusSurats()
    {
        return $this->hasMany(StatusSurat::class, 'surat_masuk_id', 'surat_keluar_id');
    }
}
