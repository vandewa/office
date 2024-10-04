<?php

namespace App\Livewire\Sppd;

use App\Models\LaporanSppd as ModelsLaporanSppd;
use Livewire\Component;
use App\Models\Simpeg\Tb01;
use Illuminate\Support\Facades\DB;

class LaporanSppd extends Component
{
    public $nama, $idnya, $edit = false;
    public $form = [
        'sppd_id' => null,
        'laporan' => null,
        'tanggal' => null,
        'nip' => null,
    ];

    public function mount($id = "")
    {
        $this->nama = Tb01::join('a_skpd', 'tb_01.kdunit', '=', 'a_skpd.kdunit')
            ->where('a_skpd.kdunit', auth()->user()->kdunit)
            ->where('idjenkedudupeg', 1)
            ->groupBy('tb_01.nip', 'tb_01.nama', 'tb_01.gdb', 'tb_01.gdp')
            ->orderBy('tb_01.nama', 'asc')
            ->pluck(DB::raw("CONCAT(
                IF(tb_01.gdp IS NOT NULL AND tb_01.gdp != '', CONCAT(tb_01.gdp, ' '), ''),
                tb_01.nama,
                IF(tb_01.gdb IS NOT NULL AND tb_01.gdb != '', CONCAT(', ', tb_01.gdb), '')
            ) as nama_gdb"), 'tb_01.nip');

        $this->idnya = $id;
        $this->form['tanggal'] = date('Y-m-d');

        $laporan = ModelsLaporanSppd::where('sppd_id', $id)->first();
        if ($laporan) {
            $this->form = $laporan->toArray();
            $this->edit = true;
        }

    }

    public function save()
    {
        $this->validate(
            [
                'form.laporan' => 'required',
                'form.tanggal' => 'required',
                'form.nip' => 'required',
            ]
        );

        $attributes = [
            'sppd_id' => $this->idnya
        ];

        // Update the record if 'kdunit' exists, otherwise create a new one
        ModelsLaporanSppd::updateOrCreate($attributes, $this->form);

        $this->showSuccessMessage('Laporan perjalanan dinas telah dibuat!');

    }

    private function showSuccessMessage($message)
    {
        $this->js(<<<JS
            Swal.fire({
                title: 'Berhasil!',
                text: '$message',
                icon: 'success',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '/sppd-index'; // Ganti '/sppd-index' dengan route yang benar
                }
            });
        JS);
    }

    public function render()
    {
        return view('livewire.sppd.laporan-sppd');
    }
}
