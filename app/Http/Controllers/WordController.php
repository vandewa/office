<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\IOFactory;

class WordController extends Controller
{
    // public function index(Request $request)
    // {
    //     $nama = $request->nama;
    //     $kelas = $request->kelas;

    //     // Creating the new document...
    //     $phpWord = new \PhpOffice\PhpWord\TemplateProcessor('template1.docx');

    //     $phpWord->setValues([
    //         'nama' => $nama,
    //         'kelas' => $kelas
    //     ]);
    //     $phpWord->saveAs('document1.docx');
    // }

    public function index()
    {
        return view('word.index');
    }

    public function generatePdf(Request $request)
    {
        // Mendapatkan path dokumen HTML dari form input
        $htmlFilePath = storage_path('app/public/' . $request->input('html_filename'));

        if (!file_exists($htmlFilePath)) {
            abort(404, "Dokumen HTML tidak ditemukan");
        }

        try {
            // Mengatur opsi Dompdf (optional)
            $options = new Options();
            $options->set('isHtml5ParserEnabled', true); // Mengaktifkan parser HTML5

            // Instantiate Dompdf class
            $dompdf = new Dompdf($options);

            // Load HTML content
            $htmlContent = file_get_contents($htmlFilePath);
            $dompdf->loadHtml($htmlContent);

            // (Optional) Setup the paper size and orientation
            $dompdf->setPaper('A4', 'portrait');

            // Render the HTML as PDF
            $dompdf->render();

            // Output the generated PDF to Browser
            return $dompdf->stream('dokumen.pdf');
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
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
