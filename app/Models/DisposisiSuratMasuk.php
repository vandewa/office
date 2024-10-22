<?php

namespace App\Models;

use App\Models\Simpeg\Tb01;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DisposisiSuratMasuk extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function dari()
    {
        return $this->belongsTo(Tb01::class, 'created_by');
    }

    public function untuk()
    {
        return $this->belongsTo(Tb01::class, 'tujuan_user_id');
    }
}
