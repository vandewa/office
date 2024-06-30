<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use Dompdf\Dompdf;
use Dompdf\Options;

class SuratController extends Controller
{
    public function printsuratkeluar($id)
    {
        return view('livewire.surat.print-suratkeluar');
    }
}
