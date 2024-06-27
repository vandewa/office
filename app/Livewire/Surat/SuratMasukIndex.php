<?php

namespace App\Livewire\Surat;

use App\Models\Simpeg\Tb01;
use App\Models\StatusSurat;
use App\Models\SuratMasuk;
use App\Models\SuratMasukIndex as ModelsSuratMasukIndex;
use App\Models\TindakLanjut;
use Livewire\Component;
use Livewire\WithPagination;

class SuratMasukIndex extends Component
{
    use WithPagination;
    public $idHapus, $suratmasuks, $cari, $tindak_lanjuts, $status_surats, $data1;

    public $form = [
        'jenis_agenda_tp' => null,
        'kode_lama' => null,
        'kode_baru' => null,
        'nomor_surat' => null,
        'opd_id' => null,
        'tgl_surat' => null,
        'tgl_terima' => null,
        'acara' => null,
        'tanggalBerangkat' => null,
        'tanggalPulang' => null,
        'jamMulai' => null,
        'tempat' => null,
        'perihal' => null,
        // 'no_surat' => null,
        'dok_surat' => null,
    ];

    public $formTindakLanjut  = [
        'deskripsi' => null,
        'nama' => null,
        'nip' => null,
        'diteruskan_kepada' => [],
        'disposisi' => []
    ];

    public $formStatus = [
        'status_surat' => null
    ];


    public function mount()
    {
        $this->suratmasuks = SuratMasuk::all();
        $this->tindak_lanjuts = TindakLanjut::all();
        $this->status_surats = StatusSurat::all();
        $this->data1 = SuratMasuk::with(['tindakLanjuts', 'statusSurats'])->get();
    }

    public function getFilteredDataProperty()
    {
        return $this->data1->filter(function($item) {
            return $item->statusSurats->contains('status_surat', 'Sudah Distribusikan');
        });
    }


    public function delete($id)
    {
        $this->idHapus = $id;
        $this->hapus();
        $this->suratmasuks = $this->suratmasuks->except($id);
    }

    public function hapus()
    {
        SuratMasuk::destroy($this->idHapus);
        return redirect()->to('/suratmasuk-index');
    }

    public function storeUpdate()
    {
        SuratMasuk::find($this->idHapus)->update($this->form);
        $this->reset();
    }

    // public function render()
    // {
    //     return view('livewire.surat.surat-masuk-index', [
    //         'suratmasuks' => $this->suratmasuks
    //     ]);
    // }

    public function render()
    {
        $data = ModelsSuratMasukIndex::query()
            ->with('tindakLanjuts', 'statusSurats')
            ->where('nomor_surat', 'like', '%' . $this->cari . '%')
            ->orWhere('acara', 'like', '%' . $this->cari . '%')
            ->paginate(10);

        $tindak_lanjuts = TindakLanjut::all();
        $status_surats = StatusSurat::all();

        return view('livewire.surat.surat-masuk-index', [
            'data' => $data,
            'tindakLanjut' => $tindak_lanjuts,
            'statusSurat' => $status_surats,
            'filteredData' => $this->filteredData
        ]);
    }
}
