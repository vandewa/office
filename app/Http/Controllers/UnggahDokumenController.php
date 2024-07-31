<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\SuratMasuk;
use App\Models\SuratKeluar;
use Illuminate\Http\Request;

class UnggahDokumenController extends Controller
{
    public function create()
    {
        return view('livewire.surat.unggah-dokumen');
    }

    public function store(Request $request)
    {
        // Validasi file
        $request->validate([
            'dok_surat' => 'required|mimes:pdf,doc,docx,txt|max:2048',
        ]);

        // Menyimpan file
        if ($request->file('dok_surat')) {
            $file = $request->file('dok_surat');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads', $filename, 'public');

            // Simpan informasi file ke database
            $document = Document::create([
                'name' => $filename,
                'dok_surat' => '/storage/' . $filePath,
            ]);

            // Simpan document_id ke dalam sesi
            session(['document_id' => $document->id]);

            // return redirect()->route('tampilkan-dokumen.show', ['id' => $document->id]);
            return redirect()->route('suratmasuk')->with('document_id', $document->id);
        }

        return redirect()->back();
    }

    public function storeKeluar(Request $request, $surat_keluar_id)
    {
        // Validasi file
        $request->validate([
            'dok_surat' => 'required|mimes:pdf,doc,docx,txt|max:2048',
        ]);

        // Menyimpan file
        if ($request->file('dok_surat')) {
            $file = $request->file('dok_surat');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads', $filename, 'public');

            // Simpan informasi file ke database
            $document = Document::create([
                'name' => $filename,
                'dok_surat' => '/storage/' . $filePath,
                'surat_keluar_id' => $surat_keluar_id, // Simpan id surat keluar
            ]);

            // Simpan document_id ke dalam sesi
            session(['document_id' => $document->id]);

            // Jika Anda ingin mengupdate kolom document_id pada tabel surat_keluars untuk dokumen terbaru
            $suratkeluar = SuratKeluar::findOrFail($surat_keluar_id);
            $suratkeluar->document_id = $document->id;
            $suratkeluar->save();
        }

        return redirect()->back();
    }


    public function preview($id)
    {
        $document = Document::findOrFail($id);
        return view('dokumen.preview', compact('document'));
    }


    public function show($id)
    {
        $document = Document::findOrFail($id);
        return view('livewire.surat.show-dokumen', ['documentUrl' => $document->dok_surat]);
    }

    public function showKeluar($id)
    {
        $document = Document::findOrFail($id);
        return view('livewire.surat.show-dokumen', ['documentUrl' => $document->dok_surat]);
    }
}
