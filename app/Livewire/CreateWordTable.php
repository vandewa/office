<?php

namespace App\Livewire;

use Dompdf\Dompdf;
use Livewire\Component;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;

class CreateWordTable extends Component
{
    public $filename = 'tabel-dokumen.docx';
    public $pdfFilename = 'tabel-dokumen.pdf';

    public function createDocument()
    {
        // Inisialisasi PHPWord
        $phpWord = new PhpWord();

        // Tambahkan section
        $section = $phpWord->addSection();

        // Tambahkan tabel
        $table = $section->addTable();

        // Tambahkan baris header dengan tinggi 400 twip
        $table->addRow(400);
        $table->addCell(3000)->addText('Header Kolom 1'); // Kolom lebar 3000 twip
        $table->addCell(3000)->addText('Header Kolom 2'); // Kolom lebar 3000 twip

        // Tambahkan beberapa baris data
        $data = [
            ['Data 1A', 'Data 1B'],
            ['Data 2A', 'Data 2B'],
            ['Data 3A', 'Data 3B']
        ];

        foreach ($data as $row) {
            $table->addRow(400); // Set tinggi baris ke 400 twip
            $table->addCell(3000)->addText($row[0]); // Kolom lebar 3000 twip
            $table->addCell(3000)->addText($row[1]); // Kolom lebar 3000 twip
        }

        // Simpan dokumen ke storage
        $path = storage_path('app/public/' . $this->filename);
        $phpWord->save($path);

        // Konversi dokumen Word menjadi PDF
        $this->convertToPdf($path);

        // Set pesan sukses
        session()->flash('message', 'Dokumen berhasil dibuat dan disimpan.');
    }

    private function convertToPdf($path)
    {
        // Load file Word
        $phpWord = IOFactory::load($path);

        // Temporary HTML file
        $htmlFile = storage_path('app/public/temp.html');

        // Save as HTML
        $xmlWriter = IOFactory::createWriter($phpWord, 'HTML');
        $xmlWriter->save($htmlFile);

        // Convert HTML to PDF using Dompdf
        $dompdf = new Dompdf();
        $dompdf->loadHtml(file_get_contents($htmlFile));
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Save PDF to storage
        $pdfOutput = $dompdf->output();
        $pdfPath = storage_path('app/public/' . $this->pdfFilename);
        file_put_contents($pdfPath, $pdfOutput);

        // Hapus file sementara
        unlink($htmlFile);
    }

    public function render()
    {
        return view('livewire.create-word-table');
    }
}
