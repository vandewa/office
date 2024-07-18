<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\Surat;
use App\Models\Simpeg\Tb01;
use App\Models\SuratKeluar;
use App\Models\Simpeg\ASkpd;
use App\Models\TindakLanjut;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SuratController extends Controller
{
    // public function printsuratkeluar($id)
    // {
    //     $suratkeluar = SuratKeluar::findOrFail($id);

    //     $options = new Options();
    //     $options->set('isHtml5ParserEnabled', true);
    //     $options->set('isPhpEnabled', true);

    //     $dompdf = new Dompdf($options);
    //     $html = view('livewire.surat.print-suratkeluar', [
    //         'suratkeluar' => $suratkeluar,
    //     ])->render();

    //     $dompdf->loadHtml($html);
    //     $dompdf->setPaper('A4', 'portrait');
    //     $dompdf->render();

    //     return $dompdf->stream('suratkeluar.pdf');
    // }

    // public function render()
    // {
    //     $user = Auth::user();

    //     $kepalaDinas = Tb01::where('idskpd', $user->kdunit)
    //         ->where('idjabjbt', $user->kdunit)
    //         ->where('idjenjab', 20)
    //         ->where('idjenkedudupeg', 1)
    //         ->first();

    //     $jab = '';
    //     if ($kepalaDinas) {
    //         $jab = ASkpd::where('kdunit', $kepalaDinas->kdunit)
    //             ->pluck('jab')
    //             ->first();
    //     }

    //     return view('livewire.surat.print-suratkeluar', [
    //         'kepalaDinas' => $kepalaDinas,
    //         'jab' => $jab
    //     ]);
    // }

    public function generateOrRenderSuratKeluar($id = null)
    {
        // Ambil data kepala dinas dan jabatan
        $user = Auth::user();
        $kepalaDinas = Tb01::where('idskpd', $user->kdunit)
            ->where('idjabjbt', $user->kdunit)
            ->where('idjenjab', 20)
            ->where('idjenkedudupeg', 1)
            ->first();

        $jab = '';
        if ($kepalaDinas) {
            $jab = ASkpd::where('kdunit', $kepalaDinas->kdunit)
                ->pluck('jab')
                ->first();
        }

        $suratkeluar = null;
        // $tindakLanjut = null;
        // $metodeTtd = '';

        // Jika ID diberikan, buat PDF
        if ($id) {
            $suratkeluar = SuratKeluar::findOrFail($id);
            // $tindakLanjut = TindakLanjut::findOrFail($id);

            // Dapatkan nilai metode_ttd
            // $metodeTtd = $tindakLanjut->metode_ttd;

            $options = new Options();
            $options->set('isHtml5ParserEnabled', true);
            $options->set('isPhpEnabled', true);

            $dompdf = new Dompdf($options);
            $html = view('livewire.surat.print-suratkeluar', [
                'suratkeluar' => $suratkeluar,
                'kepalaDinas' => $kepalaDinas,
                'jab' => $jab,
                // 'metodeTtd' => $metodeTtd,
            ])->render();

            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();

            return $dompdf->stream('suratkeluar.pdf');
        }

        // Jika ID tidak diberikan, tampilkan tampilan web
        return view('livewire.surat.print-suratkeluar', [
        //    'suratkeluar' => $suratkeluar,
            'kepalaDinas' => $kepalaDinas,
            'jab' => $jab
        ]);
    }



    public function printOrRenderSuratKeluar($id = null)
    {
        $user = Auth::user();

        // Memuat data kepala dinas dan jabatan dari Tb01 dan ASkpd
        $kepalaDinas = Tb01::where('idskpd', $user->kdunit)
            ->where('idjabjbt', $user->kdunit)
            ->where('idjenjab', 20)
            ->where('idjenkedudupeg', 1)
            ->first();

        $jab = '';
        if ($kepalaDinas) {
            $jab = ASkpd::where('kdunit', $kepalaDinas->kdunit)
                ->pluck('jab')
                ->first();
        }

        $suratkeluar = null;
        $tindakLanjut = null;
        $metodeTtd = '';

        // Jika $id disediakan, ambil data SuratKeluar berdasarkan $id
        if ($id) {
            $suratkeluar = SuratKeluar::findOrFail($id);
            $tindakLanjut = TindakLanjut::findOrFail($id);

            // Dapatkan nilai metode_ttd
            $metodeTtd = $tindakLanjut->metode_ttd;

            if (request()->has('view')) {
                return view('tindak_lanjut.show', compact('tindakLanjut', 'metodeTtd'));
            }
            // Membuat PDF menggunakan Dompdf
            $options = new Options();
            $options->set('isHtml5ParserEnabled', true);
            $options->set('isPhpEnabled', true);

            $dompdf = new Dompdf($options);
            $html = view('livewire.surat.print-suratkeluar', [
                'suratkeluar' => $suratkeluar,
                'kepalaDinas' => $kepalaDinas,
                'jab' => $jab,
                'metodeTtd' => $metodeTtd,
            ])->render();

            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();

            // Mengembalikan tampilan PDF jika diminta
            return $dompdf->stream('suratkeluar.pdf');
        }

        // Jika $id tidak disediakan, kembalikan tampilan web
        return view('livewire.surat.print-suratkeluar', [
            'suratkeluar' => $suratkeluar,
            'kepalaDinas' => $kepalaDinas,
            'jab' => $jab,
            'metodeTtd' => $metodeTtd,
        ]);
    }
    public function printsuratkeluar($id)
    {
        $suratkeluar = SuratKeluar::findOrFail($id);

        // Membuat PDF menggunakan Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);

        $dompdf = new Dompdf($options);
        $html = view('livewire.surat.print-suratkeluar', [
            'suratkeluar' => $suratkeluar,
            // 'kepalaDinas' => $kepalaDinas,
            // 'jab' => $jab,
        ])->render();

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // return view('livewire.surat.print-suratkeluar');
        return $dompdf->stream('suratkeluar.pdf');
    }
}
