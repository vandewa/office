<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKeluar extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'surat_keluars';

    public function statusSurats()
    {
        return $this->hasMany(statusSurat::class, 'surat_keluar_id');
    }

        public function tindakLanjuts()
    {
        return $this->hasMany(tindakLanjut::class, 'surat_keluar_id');
    }
    
    public function document()
    {
        return $this->belongsTo(Document::class);
    }
}
