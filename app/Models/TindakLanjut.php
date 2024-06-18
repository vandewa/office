<?php

namespace App\Models;

use App\Models\Simpeg\Tb01;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TindakLanjut extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'tindak_lanjuts';

    public function suratMasuk()
    {
        return $this->belongsTo(SuratMasuk::class, 'surat_masuk_id');
    }

    public function suratKeluar()
    {
        return $this->belongsTo(SuratKeluar::class, 'surat_keluar_id');
    }

    public function Disposisi()
    {
        return $this->hasMany(Disposisi::class, 'tindak_lanjut_id');
    }

    public function tb01()
    {
        return $this->belongsTo(Tb01::class, 'nip');
    }

    public static function createOrUpdate($attributes)
    {
        $instance = self::firstOrNew([
            'surat_masuk_id' => $attributes['surat_masuk_id'],
            'diteruskan_kepada' => $attributes['diteruskan_kepada'],
            'disposisi' => $attributes['disposisi']
        ]);

        $instance->fill($attributes);
        $instance->save();

        return $instance;
    }

}
