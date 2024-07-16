<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratMasuk extends Model
{
    use HasFactory;
    // protected $fillable = ['phone', 'message'];
    protected $guarded = [];
    protected $table = 'surat_masuks';

    public function statusSurats()
    {
        return $this->hasMany(StatusSurat::class, 'surat_masuk_id');
    }

    public function tindakLanjuts()
    {
        return $this->hasMany(TindakLanjut::class, 'surat_masuk_id');
    }

    public function document()
    {
        return $this->belongsTo(Document::class);
    }

}
