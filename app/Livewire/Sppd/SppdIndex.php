<?php

namespace App\Livewire\Sppd;

use App\Models\Sppd;
use App\Jobs\KirimWA;
use Livewire\Component;
use App\Models\DasarSppd;
use App\Models\SppdPegawai;

class SppdIndex extends Component
{
    public $idHapus;

    public function mount()
    {
        //
    }

    public function delete($id)
    {
        $this->idHapus = $id;
        $this->js(<<<'JS'
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Apakah kamu ingin menghapus data ini? proses ini tidak dapat dikembalikan.",
                // icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $wire.hapus()
                }
            })
        JS);
    }

    public function hapus()
    {
        Sppd::destroy($this->idHapus);
        DasarSppd::where('sppd_id', $this->idHapus)->delete();
        SppdPegawai::where('sppd_id', $this->idHapus)->delete();

        $this->showSuccessMessage('Data has been deleted successfully!');

    }

    private function showSuccessMessage($message)
    {
        $this->js(<<<JS
        Swal.fire({
            title: 'Good job!',
            text: '$message',
            icon: 'success',
        })
        JS);
    }

    public function render()
    {
        $sppds = Sppd::with(['pegawai', 'laporannya'])->where('kdunit', auth()->user()->kdunit)->orderBy('tgl_berangkat', 'desc')->paginate(10);

        return view('livewire.sppd.sppd-index', [
            'sppds' => $sppds
        ]);
    }
}
