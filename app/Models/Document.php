<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $table = 'documents';
    protected $guarded = [];

    public function suratMasuk()
    {
        return $this->hasOne(SuratMasuk::class);
    }

    public function suratKeluar()
    {
        return $this->hasOne(SuratKeluar::class);
    }
}

