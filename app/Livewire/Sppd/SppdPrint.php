<?php

namespace App\Livewire\Sppd;

use Livewire\Component;
use App\Models\Sppd;
use App\Models\DasarSppd;
use PhpOffice\PhpWord\TemplateProcessor;
use Dompdf\Dompdf;
use Dompdf\Options;

// class SppdPrint extends Component
// {
//     public $sppdId;
//     public $sppd;
//     public $dasar_sppd;

//     public function mount($id)
//     {
//         $this->sppdId = $id;
//         $this->sppd = Sppd::with(['sppdPegawais.tb01', 'statusLaporans'])->findOrFail($id);
//         $this->dasar_sppd = $this->sppd->dasarSppd;
//     }

//     public function render()
//     {
//         $options = new Options();
//         $options->set('isHtml5ParserEnabled', true);
//         $options->set('isPhpEnabled', true);

//         $dompdf = new Dompdf($options);
//         $html = view('livewire.sppd.sppd-print', [
//             'sppd' => $this->sppd,
//             'dasar_sppd' => $this->dasar_sppd,
//         ])->render();

//         $dompdf->loadHtml($html);

//         // Render the PDF (choose to save or output to browser)
//         $dompdf->render();
//         $dompdf->stream('laporan_sppd.pdf', ['Attachment' => false]);

//         return view('livewire.sppd.sppd-print', [
//             'sppd' => $this->sppd,
//             'dasar_sppd' => $this->dasar_sppd,
//         ]);
//     }

//     public function createPdf()
//     {
//         $options = new Options();
//         $options->set('isHtml5ParserEnabled', true);
//         $options->set('isPhpEnabled', true);

//         $dompdf = new Dompdf($options);
//         $html = view('livewire.sppd.sppd-print', [
//             'sppd' => $this->sppd,
//             'dasar_sppd' => $this->dasar_sppd,
//         ])->render();

//         $dompdf->loadHtml($html);

//         // Render the PDF (choose to save or output to browser)
//         $dompdf->render();
//         $dompdf->stream('laporan_sppd.pdf', ['Attachment' => false]);
//     }
// }
