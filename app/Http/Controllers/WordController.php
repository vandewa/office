<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpWord\IOFactory;
use Dompdf\Dompdf;

class WordController extends Controller
{
    public function index(Request $request)
    {
        $nama = $request->nama;
        $kelas = $request->kelas;

        // Creating the new document...
        $phpWord = new \PhpOffice\PhpWord\TemplateProcessor('template1.docx');

        $phpWord->setValues([
            'nama' => $nama,
            'kelas' => $kelas
        ]);
        $phpWord->saveAs('document1.docx');
    }

    public function convertToPdf()
    {
        // Load the PHPWord document
        $phpWord = IOFactory::load(public_path('document1.docx'));

        // Create an HTML writer
        $htmlWriter = IOFactory::createWriter($phpWord, 'HTML');

        // Save the PHPWord document as HTML string
        $htmlString = $htmlWriter->save('php://output', true);

        // Load the HTML string into Dompdf
        $domPdf = new Dompdf();
        $domPdf->loadHtml($htmlString);

        // Render the PDF
        $domPdf->setPaper('A4', 'portrait');
        $domPdf->render();

        // Output the PDF
        $pdfOutput = $domPdf->output();

        $pdfUrl = 'public/document1.pdf'; // Tentukan URL PDF yang akan ditampilkan di iframe

        return view('word', compact('pdfUrl')); // Kirim variabel $pdfUrl ke blade template
    }






}
