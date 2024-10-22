<?php

namespace App\Livewire\Surat;

use App\Models\Sppd;
use App\Jobs\KirimWA;
use App\Models\SuratMasuk;
use Livewire\Component;
use App\Models\DasarSppd;
use App\Models\Simpeg\Tb01;
use App\Models\SppdPegawai;
use Illuminate\Support\Facades\DB;

class SuratMasukIndex extends Component
{
    public $idHapus, $kepalaDinas;

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
        // Sppd::destroy($this->idHapus);
        // DasarSppd::where('sppd_id', $this->idHapus)->delete();
        // SppdPegawai::where('sppd_id', $this->idHapus)->delete();

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
        $data = SuratMasuk::with(['tipe'])
            ->where('kdunit', auth()->user()->kdunit)
            ->orderBy('nomor_agenda', 'desc')
            ->paginate(10);

        return view('livewire.surat.surat-masuk-index', [
            'data' => $data,
        ]);
    }
}
