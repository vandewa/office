<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WordController extends Controller
{
    public function index ( Request $request){
        $nama=$request->nama;
        $kelas=$request->kelas;

// Creating the new document...
$phpWord = new \PhpOffice\PhpWord\TemplateProcessor('template1.docx');

$phpWord->setValues([
    'nama' => $nama,
    'kelas' => $kelas
]);
$phpWord->saveAs('document1.docx');
    }
}
