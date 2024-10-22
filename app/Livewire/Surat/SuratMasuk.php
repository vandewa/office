<?php

namespace App\Livewire\Surat;

use Carbon\Carbon;
use App\Models\Opd;
use App\Jobs\KirimWA;
use App\Models\ComCode;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Http\Request;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use App\Models\SuratMasuk as ModelsSuratMasuk;

class SuratMasuk extends Component
{
    use WithFileUploads;

    public $bukaInstansi = false, $opd, $files, $bukaForm = false, $bukaFormAgenda = false, $lokasiFile, $nama, $edit = false, $idnya;

    public $photo;
    public $tipeSurat;

    public $form = [
        'kode_lama' => null,
        'kode_baru' => null,
        'nomor_surat' => null,
        'nomor_agenda' => null,
        'tanggal_surat' => null,
        'tanggal_terima' => null,
        'opd_id' => null,
        'nama_instansi' => null,
        'perihal' => null,
        'tanggal_mulai' => null,
        'tanggal_selesai' => null,
        'jam_mulai' => null,
        'tempat' => null,
        'path_surat' => null,
        'surat_tp' => null,
        'kdunit' => null,
    ];

    public function mount($id = null)
    {
        if ($id) {
            $this->getEdit($id);
        } else {
            $this->edit = false;
            $this->form['tanggal_surat'] = date('Y-m-d');
            $this->form['tanggal_terima'] = date('Y-m-d');
            $this->form['tanggal_mulai'] = date('Y-m-d');
            $this->form['tanggal_selesai'] = date('Y-m-d');
            $this->form['jam_mulai'] = '07:00:00';
        }

        $this->tipeSurat = ComCode::where('code_group', 'SURAT_TP')->get();
    }

    #[On('pilih-opd')]
    public function pilihOpd($id = "")
    {
        $this->opd = Opd::find($id);
        $this->form['opd_id'] = $this->opd->id;
    }

    public function updated($property)
    {
        if ($property === 'form.surat_tp') {
            if ($this->form['surat_tp']) {
                $this->bukaForm = true;

                if ($this->form['surat_tp'] == 'SURAT_TP_01') {
                    $this->bukaFormAgenda = true;
                }

                if ($this->form['surat_tp'] == 'SURAT_TP_02') {
                    $this->bukaFormAgenda = false;
                    $this->form['tanggal_mulai'] = null;
                    $this->form['tanggal_selesai'] = null;
                    $this->form['jam_mulai'] = null;
                    $this->form['tempat'] = null;
                }
            } else {
                $this->bukaForm = false;
            }
        }

        if ($property === 'files') {
            $this->nama = date('YmdHis') . '.pdf'; // format tanggal dengan 'H' untuk jam
            $path = $this->files->storeAs('public/temporary', $this->nama, 'local'); // Menyimpan dengan path dan nama file

            // Mengubah path 'public' menjadi 'storage' untuk akses via URL
            $this->lokasiFile = asset(str_replace('public', 'storage', $path));
        }
    }


    public function save()
    {
        $validasi = [
            'form.surat_tp' => 'required',
            'form.nomor_surat' => 'required',
            'form.tanggal_surat' => 'required',
            'form.tanggal_terima' => 'required',
            'form.perihal' => 'required',
            'form.opd_id' => 'required',
            'form.tanggal_mulai' => 'required_if:form.surat_tp,SURAT_TP_01',
            'form.tanggal_selesai' => 'required_if:form.surat_tp,SURAT_TP_01|nullable|after_or_equal:form.tanggal_mulai',
            'form.tempat' => 'required_if:form.surat_tp,SURAT_TP_01',
            'form.jam_mulai' => 'required_if:form.surat_tp,SURAT_TP_01',
        ];

        //validasi required files ketika create
        if (!$this->edit) {
            $validasi = $validasi + ['files' => 'required',];
        }

        $this->validate(
            $validasi
            ,
            [
                'form.surat_tp.required' => 'Tipe surat harus diisi.',
                'form.nomor_surat.required' => 'Nomor harus diisi.',
                'form.tanggal_surat.required' => 'Tanggal surat harus diisi.',
                'form.tanggal_terima.required' => 'Tanggal terima harus diisi.',
                'form.perihal.required' => 'Perihal harus diisi.',
                'form.opd_id.required' => 'Pengirim harus diisi.',
                'files.required' => 'Surat harus diisi.',
                'form.tempat' => 'Tempat harus diisi.',
                'form.tanggal_mulai' => 'Tanggal mulai harus diisi.',
                'form.jam_mulai' => 'Jam mulai harus diisi.',
                'form.tanggal_selesai' => 'Tanggal selesai harus diisi.',
                'form.tanggal_selesai.after_or_equal' => 'Tanggal selesai harus lebih dari atau sama dengan tanggal mulai.',
            ]
        );

        if ($this->edit) {
            $this->storeUpdate();
        } else {
            $this->store();
        }


    }

    public function getEdit($id)
    {
        $this->edit = true;
        $this->idnya = $id;

        $data = ModelsSuratMasuk::findOrFail($id);
        $this->bukaForm = true;
        if ($data->surat_tp == 'SURAT_TP_01') {
            $this->bukaFormAgenda = true;
        }

        $this->form = array_intersect_key($data->toArray(), $this->form);

        $this->pilihOpd($data->opd_id);
    }

    public function store()
    {
        //hapus temporary file
        Storage::disk('public')->delete('temporary/' . $this->nama);

        //jika ada file upload pdf
        if ($this->files) {
            $path = $this->files->store('office/surat-masuk/' . auth()->user()->kdunit, 'gcs');
            $this->form['path_surat'] = $path;
        }

        //menentukan nomor agenda ketika sudah lewat tahun restart dari 1
        $latestSurat = ModelsSuratMasuk::whereYear('created_at', date('Y'))->latest()->first();
        if ($latestSurat) {
            $this->form['nomor_agenda'] = (int) $latestSurat->nomor_agenda + 1;
        } else {
            $this->form['nomor_agenda'] = 1;
        }

        //mengambil unit opd user
        $this->form['kdunit'] = auth()->user()->kdunit;

        $surat = ModelsSuratMasuk::create($this->form);

        // cek jenis surat pesan jika surat masuk tipe agenda
        if ($this->form['surat_tp'] == 'SURAT_TP_01') {

            //jika tanggal tidak sama
            if ($this->form['tanggal_mulai'] != $this->form['tanggal_selesai']) {

                $tanggal = 'Tanggal : ' . '*' . Carbon::createFromFormat('Y-m-d', $this->form['tanggal_mulai'])->isoFormat('dddd, D MMMM') . '* *-* ' . '*' . Carbon::createFromFormat('Y-m-d', $this->form['tanggal_selesai'])->isoFormat('dddd, D MMMM Y') . '*' . "\n\n";
            }

            //jika tanggal sama
            if ($this->form['tanggal_mulai'] == $this->form['tanggal_selesai']) {

                $tanggal = 'Tanggal : ' . '*' . Carbon::createFromFormat('Y-m-d', $this->form['tanggal_mulai'])->isoFormat('dddd, D MMMM Y') . '*' . "\n\n";

            }

            $pesan = '*Surat Masuk*' . "\n\n" .
                'Subject : ' . '*' . $this->form['perihal'] . '*' . "\n" .
                $tanggal .
                'Tempat : ' . '*' . $this->form['tempat'] . '*' . "\n" .
                'Jam : ' . '*' . $this->form['jam_mulai'] . ' WIB*' . "\n\n" .
                'Silahkan untuk segera mendisposisi, klik pada tautan berikut ini :' . "\n\n" .
                url('disposisi/' . $surat->id);
        }

        // cek jenis surat pesan jika surat masuk tipe non agenda
        if ($this->form['surat_tp'] == 'SURAT_TP_02') {

            $pesan = '*Surat Masuk*' . "\n\n" .
                'Subject : ' . '*' . $this->form['perihal'] . '*' . "\n" .
                'Tanggal : ' . '*' . Carbon::createFromFormat('Y-m-d', $this->form['tanggal_surat'])->isoFormat('dddd, D MMMM Y') . '*' . "\n\n" .
                'Silahkan untuk segera mendisposisi, klik pada tautan berikut ini :' . "\n\n" .
                url('disposisi/' . $surat->id);
            ;
        }

        // KirimWA::dispatch($cek->wa, $pesan);

        $this->showSuccessMessage('Surat masuk berhasil ditambahkan!');
    }

    public function storeUpdate()
    {
        //jika ada file upload pdf
        if ($this->files) {
            $path = $this->files->store('office/surat-masuk/' . auth()->user()->kdunit, 'gcs');
            $this->form['path_surat'] = $path;
        }

        ModelsSuratMasuk::find($this->idnya)->update($this->form);

        $this->showSuccessMessage('Surat masuk berhasil diubah!');
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
                    window.location.href = '/surat-masuk-index'; // Ganti '/sppd-index' dengan route yang benar
                }
            });
        JS);
    }

    public function render()
    {
        return view('livewire.surat.surat-masuk');
    }
}
