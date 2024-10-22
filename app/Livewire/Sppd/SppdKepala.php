<?php

namespace App\Livewire\Sppd;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\DasarSppd;
use App\Models\Simpeg\Tb01;
use App\Models\SppdPegawai;
use App\Models\Sppd as ModelsSppd;
use App\Models\Ssh;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SppdKepala extends Component
{

    public $nama, $sppd, $sppdId = null, $edit = false, $kdunit;
    public $formNama;
    public $formDasar;

    public $masterDasar;

    public $form = [
        'maksud' => null,
        'untuk' => null,
        'tingkat_id' => null,
        'alat_angkut_st' => null,
        'tempat_berangkat' => null,
        'tempat_tujuan' => null,
        'tgl_berangkat' => null,
        'tgl_kembali' => null,
        'hari' => null,
        'ditetapkan_tgl' => null,
        'pengikut' => null,
        'keterangan' => null,
        'created_by' => null,
        'updated_by' => null,
        'kdunit' => null,
    ];

    public function mount($id = null)
    {
        if ($id) {
            $this->getEdit($id);
        } else {
            $this->edit = false;
        }

        $this->sppdId = $id;
        $this->masterDasar = Ssh::first()->nama;
      
        //menampilkan nama di form select nama pegawai
        $nip = Auth::user()->nip;

        $kdunit = Tb01::where('nip', $nip)->value('kdunit');
        $this->kdunit = $kdunit;

        $kepalaDinas = Tb01::with(['skpd'])->select('tmlhr', 'photo', 'tb_01.tglhr', 'nip', 'tb_01.kdunit', 'email', 'gdp', 'gdb', 'email_dinas', 'nama', 'tb_01.idskpd', "jabatan.skpd", 'a_golruang.idgolru', DB::Raw("
            case when jabfung is null and jabfungum is null then jabatan.jab
               when jabfung is null then jabfungum
               else  jabfung end as jabatan
           "), DB::Raw("a_jenjurusan.jenjurusan as pendidikan"), DB::Raw("a_golruang.pangkat as pangkat"), DB::Raw("a_golruang.golru as golru"), DB::Raw("induk.skpd as unor"))
            ->leftJoin('a_skpd as jabatan', "tb_01.idskpd", "jabatan.idskpd")
            ->leftJoin('a_jenjurusan', "tb_01.idjenjurusan", "a_jenjurusan.idjenjurusan")
            ->leftJoin('a_skpd as induk', DB::Raw("substring(tb_01.idskpd,1,2)"), '=', "induk.idskpd")
            ->leftJoin('a_golruang', "tb_01.idgolrupkt", "a_golruang.idgolru")
            ->leftJoin('a_jabfungum', "tb_01.idjabfungum", "a_jabfungum.idjabfungum")
            ->leftJoin('a_jabfung', "tb_01.idjabfung", "a_jabfung.idjabfung")
            ->where('tb_01.kdunit', $kdunit) //kode opd
            ->where('idjenkedudupeg', 1) //aktif / tidak
            ->where('idjenjab', '>', '4')
            ->orderBy('idesljbt', 'ASC')
            ->orderBy('idgolrupkt', 'DESC')
            ->first();

        $this->nama = Tb01::join('a_skpd', 'tb_01.kdunit', '=', 'a_skpd.kdunit')
            ->where('a_skpd.kdunit', $kdunit)
            ->where('idjenkedudupeg', 1)
            ->where('tb_01.nip', $kepalaDinas->nip) // Pengecualian data dengan nip kepala dinas
            ->groupBy('tb_01.nip', 'tb_01.nama', 'tb_01.gdb', 'tb_01.gdp')
            ->orderBy('tb_01.nama', 'asc')
            ->pluck(DB::raw("CONCAT(
                    IF(tb_01.gdp IS NOT NULL AND tb_01.gdp != '', CONCAT(tb_01.gdp, ' '), ''),
                    tb_01.nama,
                    IF(tb_01.gdb IS NOT NULL AND tb_01.gdb != '', CONCAT(', ', tb_01.gdb), '')
                ) as nama_gdb"), 'tb_01.nip');


        $this->form['tempat_berangkat'] = 'Wonosobo';
        $this->form['tgl_berangkat'] = date('Y-m-d');
        $this->form['tgl_kembali'] = date('Y-m-d');
        $this->form['ditetapkan_tgl'] = date('Y-m-d');
        $this->form['alat_angkut_st'] = 'ALAT_ANGKUT_ST_01';
        $this->form['tingkat_id'] = 'C';
        $this->form['hari'] = $this->hitungSelisihHari();

    }

    public function getEdit($id)
    {
        $this->edit = true;
        $this->sppd = ModelsSppd::findOrFail($id); // Gunakan ModelsSppd, bukan Sppd
        $this->form = array_intersect_key($this->sppd->toArray(), $this->form);
        $this->formDasar = DasarSppd::where('sppd_id', $id)->first()->dasar;
        $this->formNama = SppdPegawai::where('sppd_id', $id)->pluck('nip')->toArray();
    }


    public function save()
    {
        if ($this->edit === false) {
            $this->store();
        } else {
            $this->storeUpdate();
        }
    }

    public function store()
    {
        $this->validate(
            [
                'formNama' => 'required',
                'form.tgl_berangkat' => 'required|date',
                'form.tgl_kembali' => 'required|date|after_or_equal:form.tgl_berangkat',
                'form.hari' => 'required',
                'form.tempat_berangkat' => 'required',
                'form.tempat_tujuan' => 'required',
                'form.tingkat_id' => 'required',
                'form.alat_angkut_st' => 'required',
                'form.ditetapkan_tgl' => 'required',
                'formDasar' => 'required',
                'form.maksud' => 'required',
                'form.untuk' => 'required',
            ],
            [
                'formNama.required' => 'Pegawai harus diisi.',
                'form.tgl_kembali.after_or_equal' => 'Tanggal Kembali tidak boleh kurang dari Tanggal Berangkat',
                'form.hari.required' => 'Lama Perjalanan harus diisi.',
                'form.tempat_berangkat.required' => 'Tempat Berangkat harus diisi.',
                'form.tempat_tujuan.required' => 'Tempat Tujuan harus diisi.',
                'form.tingkat_id.required' => 'Tingkat Menurut Perjalanan harus diisi.',
                'form.alat_angkut_st.required' => 'Alat Angkut Yang Dipergunakan harus diisi.',
                'form.ditetapkan_tgl.required' => 'Ditetapkan Pada Tanggal harus diisi.',
                'form.dasar.required' => 'Dasar harus diisi.',
                'form.maksud.required' => 'Maksud harus diisi.',
                'form.untuk.required' => 'Untuk harus diisi.',
            ]
        );

        //Karakter awal besar
        $this->form['tempat_tujuan'] = ucfirst($this->form['tempat_tujuan'] ?? '');

        // simpan input form ke tabel sppd
        $this->form['kdunit'] = $this->kdunit;
        $this->form['created_by'] = auth()->user()->nip;
        $sppd = ModelsSppd::create($this->form);

        // Simpan input dasar ke tabel dasar_sppd
        DasarSppd::create([
            'sppd_id' => $sppd->id,
            'dasar' => $this->formDasar
        ]);

        // Simpan nip dan idskpd dari select nama ke tabel sppd_pegawai
        SppdPegawai::create([
            'sppd_id' => $sppd->id,
            'nip' => $this->formNama,
            'kdunit' => $this->kdunit
        ]);

        $this->showSuccessMessage('Data perjalanan dinas berhasil ditambahkan!');

    }

    public function storeUpdate()
    {
        // Temukan data SPPD yang akan diperbarui
        $sppd = ModelsSppd::findOrFail($this->sppdId); // Menggunakan $this->sppdId daripada $this->sppd->id

        // Perbarui data SPPD dengan nilai baru dari formulir yang diedit
        $sppd->update($this->form);

        // Simpan input dasar ke tabel dasar_sppd
        DasarSppd::where('sppd_id', $this->sppdId)->update([
            'dasar' => $this->formDasar
        ]);

        // Simpan nip dan idskpd dari select nama ke tabel sppd_pegawai
        $nipList = $this->formNama['nip'] ?? []; // Ambil nip dari formNama
        foreach ($nipList as $nip) {
            $pegawai = Tb01::where('nip', $nip)->first(); // Cari data pegawai berdasarkan nip
            if ($pegawai) {
                SppdPegawai::where('sppd_id', $sppd->id)->update([
                    'nip' => $nip,
                    'id_skpd' => $pegawai->idskpd
                ]);
            }
        }

        // Simpan nip dan idskpd dari select nama ke tabel sppd_pegawai
        SppdPegawai::where('sppd_id', $this->sppdId)->delete();
        SppdPegawai::create([
            'sppd_id' => $sppd->id,
            'nip' => $this->formNama,
            'kdunit' => $this->kdunit
        ]);

        $this->showSuccessMessage('Data perjalanan dinas berhasil diedit!');

    }

    public function updated($property)
    {
        if ($property == 'form.tgl_berangkat' || $property == 'form.tgl_kembali') {
            $this->form['hari'] = $this->hitungSelisihHari();
            // $this->form['tempat_tujuan'] = ucfirst($this->form['tempat_tujuan'] ?? '');
        }
    }

    public function hitungSelisihHari()
    {
        $tglBerangkat = Carbon::createFromFormat('Y-m-d', $this->form['tgl_berangkat']);
        $tglKembali = Carbon::createFromFormat('Y-m-d', $this->form['tgl_kembali']);
        return $tglBerangkat->diffInDays($tglKembali) + 1;
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
        return view('livewire.sppd.sppd-kepala');
    }
}
