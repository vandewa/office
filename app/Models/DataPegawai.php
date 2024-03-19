<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPegawai extends Model
{
    protected $table = 'tb_01';
    protected $primaryKey = 'id'; // Jika nama kolom primary key bukan 'id', sesuaikan di sini
}
