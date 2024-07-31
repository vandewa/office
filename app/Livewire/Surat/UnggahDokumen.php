<?php

namespace App\Livewire\Surat;

use App\Jobs\KirimWA;
use Livewire\Component;
use App\Models\Document;
use App\Models\Simpeg\Tb01;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

class UnggahDokumen extends Component
{
    use WithFileUploads;
    public $dok_surat;

    public function sendWhatsapp()
    {
        $user = Auth::user();
        $nip = $user->nip;
        $kdunit = Tb01::where('nip', $nip)->value('kdunit');

        $kepalaDinas = Tb01::where('idskpd', $user->kdunit)
            ->where('idjabjbt', $user->kdunit)
            ->where('idjenjab', 20)
            ->where('idjenkedudupeg', 1)
            ->select('tb_01.hp') // Memilih kolom yang relevan
            ->get();

            dd($kepalaDinas);

        $kepalaBidang = Tb01::join('a_skpd', 'tb_01.kdunit', '=', 'a_skpd.kdunit')
            ->where('a_skpd.kdunit', $kdunit)
            ->where('idjenkedudupeg', 1)
            ->where('idjabjbt', '=', $user->idskpd)
            ->select('tb_01.hp', 'tb_01.kdunit', 'tb_01.idskpd', 'tb_01.idjenjab') // Memilih kolom yang relevan
            ->get();
            dd($kepalaBidang);

        $staff = Tb01::where('kdunit', $user->kdunit)
            ->where('idjenkedudupeg', 1)
            ->select('tb_01.hp', 'tb_01.kdunit', 'tb_01.idskpd') // Memilih kolom yang relevan
            ->get();

            dd($staff);

        // Query to get sekretariat with proper column selection
        $sekretariat = Tb01::from('tb_01 as tb')
            ->join('a_skpd as skpd', 'tb.kdunit', '=', 'skpd.kdunit')
            ->where('idjenkedudupeg', 1)
            ->where(function ($query) use ($user) {
                $query->where('tb.idskpd', $user->kdunit . '.01')
                    ->orWhere(function ($query) use ($user) {
                        $query->where('tb.idskpd', 'like', $user->kdunit . '.01.%')
                            ->whereRaw('LENGTH(tb.idskpd) = ?', [strlen($user->kdunit . '.01') + 3]); // Exact length match
                    });
            })
            ->distinct() // Ensure distinct rows
            ->select('tb.hp', 'tb.kdunit', 'tb.idskpd', 'tb.idjenjab')
            ->get();

        // Output the results for debugging
        // dd($sekretariat->map(function ($item) {
        //     return [
        //         'hp' => $item->hp,
        //         'kdunit' => $item->kdunit,
        //         'idskpd' => $item->idskpd,
        //         'idjenjab' => $item->idjenjab
        //     ];
        // }));

        $pesan_sekre = 'Surat masuk perlu ditindaklanjuti Kepala Dinas';
        $pesan_kadin = 'Surat masuk perlu ditindaklanjuti Kepala Bidang';
        $pesan_kabid = 'Surat masuk sudah ditindaklanjuti Kepala Dinas dan Kepala Bidang';
        $pesan_revisi = 'Ada revisi surat masuk';
        $pesan_distribusikan = 'Silakan cek surat masuk terbaru';

        $whatsApp= KirimWA::dispatch($this->kepalaDinas, $this->pesan_sekre);
    }

}
