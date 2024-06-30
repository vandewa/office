<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sppd;
use PhpOffice\PhpWord\TemplateProcessor;
use Dompdf\Dompdf;
use Dompdf\Options;

class SppdController extends Controller
{
    public function printspt($id)
    {
        $sppd = Sppd::with(['sppdPegawais.tb01', 'statusLaporans'])->findOrFail($id);
        $dasar_sppd = $sppd->dasarSppd;

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);

        $dompdf = new Dompdf($options);
        $html = view('livewire.sppd.print-spt', [
            'sppd' => $sppd,
            'dasar_sppd' => $dasar_sppd,
        ])->render();

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return view('livewire.sppd.print-spt', [
            'sppd' => $sppd,
            'dasar_sppd' => $dasar_sppd,
        ]);
    }

    public function printsptkadin($id)
    {
        $sppd = Sppd::with(['sppdPegawais.tb01', 'statusLaporans'])->findOrFail($id);
        $dasar_sppd = $sppd->dasarSppd;

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);

        $dompdf = new Dompdf($options);
        $html = view('livewire.sppd.print-spt-kadin', [
            'sppd' => $sppd,
            'dasar_sppd' => $dasar_sppd,
        ])->render();

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return view('livewire.sppd.print-spt-kadin', [
            'sppd' => $sppd,
            'dasar_sppd' => $dasar_sppd,
        ]);
    }

    public function printspd($id)
    {
        $sppd = Sppd::with(['sppdPegawais.tb01', 'statusLaporans'])->findOrFail($id);
        $dasar_sppd = $sppd->dasarSppd;

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);

        $dompdf = new Dompdf($options);
        $html = view('livewire.sppd.print-spd', [
            'sppd' => $sppd,
            'dasar_sppd' => $dasar_sppd,
        ])->render();

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return view('livewire.sppd.print-spd', [
            'sppd' => $sppd,
            'dasar_sppd' => $dasar_sppd,
        ]);
    }

    public function printspdkadin($id)
    {
        $sppd = Sppd::with(['sppdPegawais.tb01', 'statusLaporans'])->findOrFail($id);
        $dasar_sppd = $sppd->dasarSppd;

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);

        $dompdf = new Dompdf($options);
        $html = view('livewire.sppd.print-spd-kadin', [
            'sppd' => $sppd,
            'dasar_sppd' => $dasar_sppd,
        ])->render();

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return view('livewire.sppd.print-spd-kadin', [
            'sppd' => $sppd,
            'dasar_sppd' => $dasar_sppd,
        ]);
    }
}
