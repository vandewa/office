<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratMasuk extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function tipe()
    {
        return $this->belongsTo(ComCode::class, 'surat_tp');
    }

    public function disposisi()
    {
        return $this->hasMany(DisposisiSuratMasuk::class, 'surat_masuks_id')->orderBy('created_at', 'desc');
    }


}
