<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\Sppd;
use App\Models\Simpeg\Tb01;
use App\Models\Simpeg\ASkpd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SppdController extends Controller
{
    public function printSpt($id)
    {
        $user = Auth::user();
        $nip = $user->nip;
        $kepalaDinas = Tb01::where('idskpd', $user->kdunit)
            ->where('idjabjbt', $user->kdunit)
            ->where('idjenjab', 20)
            ->where('idjenkedudupeg', 1)
            ->first();

        $kdunit = Tb01::where('nip', $nip)->value('kdunit');

        $jab = '';
        if ($kepalaDinas) {
            $jab = ASkpd::where('kdunit', $kepalaDinas->kdunit)
                ->pluck('jab')
                ->first();
        }

        $sppd = Sppd::findOrFail($id);
        $dasar_sppd = $sppd->dasarSppd;
        $sppdPegawais = $sppd->sppdPegawais;

        // Array untuk menyimpan data pegawai dari tabel tb01, a_golruang, a_jabfung, a_jabfungum, dan a_skpd
        $pegawaiData = [];

        // Iterasi setiap SPPD pegawai untuk mengambil data dari tb01 dan tabel terkait menggunakan join
        foreach ($sppdPegawais as $sppdPegawai) {
            // Ambil nip dari sppdPegawai
            $nip = $sppdPegawai->nip;

            // Ambil data dari tb01 dan tabel terkait berdasarkan nip menggunakan join
            $tb01Data = Tb01::join('a_golruang', 'tb_01.idgolrupkt', '=', 'a_golruang.idgolru')
                ->leftJoin('a_jabfung', 'tb_01.idjabfung', '=', 'a_jabfung.idjabfung')
                ->leftJoin('a_jabfungum', 'tb_01.idjabfungum', '=', 'a_jabfungum.idjabfungum')
                ->leftJoin('a_skpd', 'tb_01.idjabjbt', '=', 'a_skpd.idskpd')
                ->where('tb_01.nip', $nip)
                ->select(
                    'tb_01.*',
                    'a_golruang.golru',
                    'a_golruang.pangkat',
                    'a_jabfung.jabfung',
                    'a_jabfungum.jabfungum',
                    'a_skpd.jab'
                )
                ->first();

            // Tambahkan data tb01 dan tabel terkait ke array pegawaiData
            if ($tb01Data) {
                $pegawaiData[] = [
                    'nama' => $tb01Data->nama,
                    'nip' => $tb01Data->nip,
                    'gdp' => $tb01Data->gdp,
                    'gdb' => $tb01Data->gdb,
                    'jabatan' => $tb01Data->jabatan,
                    'golru' => $tb01Data->golru, // Kolom golru dari a_golruang
                    'pangkat' => $tb01Data->pangkat, // Kolom pangkat dari a_golruang
                    'jabfung' => $tb01Data->jabfung, // Kolom jabfung dari a_jabfung
                    'jabfungum' => $tb01Data->jabfungum, // Kolom jabfungum dari a_jabfungum
                    'jab' => $tb01Data->jab, // Kolom skpd dari a_skpd
                ];
            }
        }

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);

        $dompdf = new Dompdf($options);
        $html = view('livewire.sppd.print-spt', [
            'sppd' => $sppd,
            'dasar_sppd' => $dasar_sppd,
            'kepalaDinas' => $kepalaDinas,
            'jab' => $jab,
            'sppdPegawais' => $sppdPegawais,
            'pegawaiData' => $pegawaiData // Pass data pegawai ke view
        ])->render();

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // return $dompdf->stream('sppd.pdf');
        return view('livewire.sppd.print-spt', [
            'kepalaDinas' => $kepalaDinas,
            'jab' => $jab,
            'sppd' => $sppd,
            'dasar_sppd' => $dasar_sppd,
            'sppdPegawais' => $sppdPegawais,
            'pegawaiData' => $pegawaiData // Pass data pegawai ke view
        ]);
    }

    public function printspd($id)
    {
        $user = Auth::user();
        $nip = $user->nip;
        $kepalaDinas = Tb01::where('idskpd', $user->kdunit)
            ->where('idjabjbt', $user->kdunit)
            ->where('idjenjab', 20)
            ->where('idjenkedudupeg', 1)
            ->first();

        $kdunit = Tb01::where('nip', $nip)->value('kdunit');

        $jab = '';
        if ($kepalaDinas) {
            $jab = ASkpd::where('kdunit', $kepalaDinas->kdunit)
                ->pluck('jab')
                ->first();
        }
        $sppd = Sppd::with('sppdPegawais')->findOrFail($id);
        // $dasar_sppd = $sppd->dasarSppd;
        $sppdPegawais = $sppd->sppdPegawais;

        // Array untuk menyimpan data pegawai dari tabel tb01, a_golruang, a_jabfung, a_jabfungum, dan a_skpd
        $pegawaiData = [];

        // Iterasi setiap SPPD pegawai untuk mengambil data dari tb01 dan tabel terkait menggunakan join
        foreach ($sppdPegawais as $sppdPegawai) {
            // Ambil nip dari sppdPegawai
            $nip = $sppdPegawai->nip;

            // Ambil data dari tb01 dan tabel terkait berdasarkan nip menggunakan join
            $tb01Data = Tb01::join('a_golruang', 'tb_01.idgolrupkt', '=', 'a_golruang.idgolru')
                ->leftJoin('a_jabfung', 'tb_01.idjabfung', '=', 'a_jabfung.idjabfung')
                ->leftJoin('a_jabfungum', 'tb_01.idjabfungum', '=', 'a_jabfungum.idjabfungum')
                ->leftJoin('a_skpd', 'tb_01.idjabjbt', '=', 'a_skpd.idskpd')
                ->where('tb_01.nip', $nip)
                ->select(
                    'tb_01.*',
                    'a_golruang.golru',
                    'a_golruang.pangkat',
                    'a_jabfung.jabfung',
                    'a_jabfungum.jabfungum',
                    'a_skpd.jab'
                )
                ->first();

            // Tambahkan data tb01 dan tabel terkait ke array pegawaiData
            if ($tb01Data) {
                $pegawaiData[] = [
                    'nama' => $tb01Data->nama,
                    'nip' => $tb01Data->nip,
                    'gdp' => $tb01Data->gdp,
                    'gdb' => $tb01Data->gdb,
                    'jabatan' => $tb01Data->jabatan,
                    'golru' => $tb01Data->golru, // Kolom golru dari a_golruang
                    'pangkat' => $tb01Data->pangkat, // Kolom pangkat dari a_golruang
                    'jabfung' => $tb01Data->jabfung, // Kolom jabfung dari a_jabfung
                    'jabfungum' => $tb01Data->jabfungum, // Kolom jabfungum dari a_jabfungum
                    'jab' => $tb01Data->jab, // Kolom skpd dari a_skpd
                ];
            }
        }

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);

        $dompdf = new Dompdf($options);
        $html = view('livewire.sppd.print-spd', [
            'kepalaDinas' => $kepalaDinas,
            'jab' => $jab,
            'sppd' => $sppd,
            'pegawaiData' => $pegawaiData, // Pass data pegawai ke view,
            'sppdPegawais' => $sppdPegawais,
        ])->render();

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return view('livewire.sppd.print-spd', [
            'kepalaDinas' => $kepalaDinas,
            'jab' => $jab,
            'sppd' => $sppd,
            // 'dasar_sppd' => $dasar_sppd,
            'sppdPegawais' => $sppdPegawais,
            'pegawaiData' => $pegawaiData // Pass data pegawai ke view
        ]);
    }
}
