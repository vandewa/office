<?php

namespace App\Models;

use App\Models\SuratMasuk;
use App\Models\SuratKeluar;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StatusSurat extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'status_surats';

    public function suratMasuk()
    {
        return $this->belongsTo(SuratMasuk::class, 'surat_masuk_id');
    }

    public function suratKeluar()
    {
        return $this->belongsTo(SuratKeluar::class, 'surat_keluar_id');
    }

}
