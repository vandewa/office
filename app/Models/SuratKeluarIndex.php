<?php

namespace App\Models;

use App\Models\StatusSurat;
use App\Models\TindakLanjut;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SuratKeluarIndex extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'surat_keluars';


    public function tindakLanjuts()
    {
        return $this->hasMany(TindakLanjut::class, 'surat_keluar_id');
    }

    public function statusSurats()
    {
        return $this->hasMany(StatusSurat::class, 'surat_keluar_id');
    }
}
