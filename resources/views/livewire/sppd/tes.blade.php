

<?php

public function generateSpd($sppd)
{
    $user = Auth::user();
    $nip = $user->nip;
    $kepalaDinas = Tb01::where('idskpd', $user->kdunit)
        ->where('idjabjbt', $user->kdunit)
        ->where('idjenjab', 20)
        ->where('idjenkedudupeg', 1)
        ->first();
    $tanggal = $this->form['ditetapkan_tgl'] ?? now()->format('Y-m-d'); // Menggunakan tanggal saat ini jika tidak ada tanggal di input data
    $pegawaiList = Tb01::where('tb_01.kdunit', $user->kdunit)
        ->where('idjenkedudupeg', 1)
        ->join('a_golruang', 'tb_01.idgolrupkt', '=', 'a_golruang.idgolru')
        ->leftJoin('a_jabfung', 'tb_01.idjabfung', '=', 'a_jabfung.idjabfung')
        ->leftJoin('a_jabfungum', 'tb_01.idjabfungum', '=', 'a_jabfungum.idjabfungum')
        ->leftJoin('a_skpd', 'tb_01.idjabjbt', '=', 'a_skpd.idskpd')
        ->select(
            'tb_01.*',
            'a_golruang.golru as golongan',
            'a_golruang.pangkat',
            'a_jabfung.jabfung as jabatan',
            'a_jabfungum.jabfungum',
            'a_skpd.jab'
        )
        ->get(); // Change from ->first() to ->get()


    foreach ($pegawaiList as $pegawai) {
        // Membuat objek TemplateProcessor untuk setiap pegawai
        $phpWord = new \PhpOffice\PhpWord\TemplateProcessor('spd.docx');
        // Menentukan pegawai utama dan pengikut
        $pengikutList = $pegawaiList->filter(function ($item) use ($pegawai) {
            return $item->nip !== $pegawai->nip;
        });
        // Menyiapkan string pengikut
        $pengikutStr = '';
        $index = 1;
        foreach ($pengikutList as $pengikut) {
            $pengikutStr .= $index . ". " . $pengikut->nama . "\t" . $pengikut->tgl_lahir . "\n";
            $index++;
        }
        // Set nilai untuk placeholder dalam dokumen
        $values = [
            'tingkat_id' => strval($this->form['tingkat_id'] ?? ''),
            'maksud' => strval($this->form['maksud'] ?? ''),
            'tempat_berangkat' => strval($this->form['tempat_berangkat'] ?? ''),
            'tempat_tujuan' => strval($this->form['tempat_tujuan'] ?? ''),
            'hari' => strval($this->form['hari'] ?? ''),
            'tgl_berangkat' => strval($this->form['tgl_berangkat'] ?? ''),
            'tgl_kembali' => strval($this->form['tgl_kembali'] ?? ''),
            'alat_angkut_st' => strval($this->form['alat_angkut_st'] ?? ''),
            'pengikut' => $pengikutStr,
            'keterangan' => strval($this->form['keterangan'] ?? ''),
            'tanggal' => $tanggal,
            'n_kep' => $kepalaDinas->nama ?? '',
            'n_pangkat' => $kepalaDinas->pangkat ?? '',
            'n_nip' => $kepalaDinas->nip ?? '',
            'nama' => $pegawai->nama ?? '',
            'nip' => $pegawai->nip ?? '',
            'pangkat' => $pegawai->pangkat ?? '',
            'golongan' => $pegawai->golongan ?? '',
            'jabatan' => $pegawai->jabatan ?? ''
        ];
        // Set values in the template
        $phpWord->setValues($values);
        $namaDokumen = 'SPD_' . $pegawai->nama . '_' . date('d_F_Y', strtotime($tanggal)) . '.docx';
        // Menyimpan dokumen
        $phpWord->saveAs($namaDokumen);
    }
}


public function generateSpd($sppd)
    {
        $user = Auth::user();
        $nip = $user->nip;

        $kepalaDinas = Tb01::where('idskpd', $user->kdunit)
            ->where('idjabjbt', $user->kdunit)
            ->where('idjenjab', 20)
            ->where('idjenkedudupeg', 1)
            ->first();

        $tanggal = $this->form['ditetapkan_tgl'] ?? now()->format('Y-m-d');

        $nipList = $this->formNama['nip'] ?? [];
        foreach ($nipList as $nip) {
            $pegawai = Tb01::where('nip', $nip)->first();
            if ($pegawai) {
                $gdp = $pegawai->gdp ?? '';
                $nama = $pegawai->nama ?? '';
                $gdb = $pegawai->gdb ?? '';
                $nip = $pegawai->nip ?? '';
                $jabatan = '';
                // Cek apakah pegawai memiliki jabfung
                $jabfung = Tb01::join('a_jabfung', 'tb_01.idjabfung', '=', 'a_jabfung.idjabfung')
                    ->where('tb_01.nip', $nip)
                    ->select('a_jabfung.jabfung')
                    ->first();
                // Jika pegawai tidak memiliki jabfung, coba cari jabfungum
                if ($jabfung) {
                    $jabatan = $jabfung->jabfung;
                } else {
                    $jabfungum = Tb01::join('a_jabfungum', 'tb_01.idjabfungum', '=', 'a_jabfungum.idjabfungum')
                        ->where('tb_01.nip', $nip)
                        ->select('a_jabfungum.jabfungum')
                        ->first();
                    if ($jabfungum) {
                        $jabatan = $jabfungum->jabfungum;
                    } else {
                        $jabjbt = Tb01::join('a_skpd', 'tb_01.idjabjbt', '=', 'a_skpd.idskpd')
                            ->where('tb_01.nip', $nip)
                            ->select('a_skpd.jab')
                            ->first();
                        if ($jabjbt) {
                            $jabatan = $jabjbt->jab;
                        }
                    }
                }
                $golonganData = Tb01::join('a_golruang', 'tb_01.idgolrupkt', '=', 'a_golruang.idgolru')
                    ->where('tb_01.nip', $nip)
                    ->select('a_golruang.golru', 'a_golruang.pangkat')
                    ->first();
                $golongan = $golonganData ? str_replace('\/', '/', $golonganData->golru) : '';
                $pangkat = $golonganData ? $golonganData->pangkat : '';
            }
        }
        foreach ($nipList as $nip) {
            // Membuat objek TemplateProcessor untuk setiap pegawai
            $phpWord = new \PhpOffice\PhpWord\TemplateProcessor('spd.docx');
            // Menentukan pegawai utama dan pengikut
            $pengikutList = $nipList->filter(function ($item) use ($nip) {
                return $item->nip !== $nip->nip;
            });
            // Menyiapkan string pengikut
            $pengikutStr = '';
            $index = 1;
            foreach ($pengikutList as $pengikut) {
                $pengikutStr .= $index . ". " . $pengikut->nama . "\t" . $pengikut->tgl_lahir . "\n";
                $index++;
            }
            // Set nilai untuk placeholder dalam dokumen
            $values = [
                'tingkat_id' => strval($this->form['tingkat_id'] ?? ''),
                'maksud' => strval($this->form['maksud'] ?? ''),
                'tempat_berangkat' => strval($this->form['tempat_berangkat'] ?? ''),
                'tempat_tujuan' => strval($this->form['tempat_tujuan'] ?? ''),
                'hari' => strval($this->form['hari'] ?? ''),
                'tgl_berangkat' => strval($this->form['tgl_berangkat'] ?? ''),
                'tgl_kembali' => strval($this->form['tgl_kembali'] ?? ''),
                'alat_angkut_st' => strval($this->form['alat_angkut_st'] ?? ''),
                'pengikut' => $pengikutStr,
                'keterangan' => strval($this->form['keterangan'] ?? ''),
                'tanggal' => $tanggal,
                'n_kep' => $kepalaDinas->nama ?? '',
                'n_pangkat' => $kepalaDinas->pangkat ?? '',
                'n_nip' => $kepalaDinas->nip ?? '',
                'nama' => $pegawai->nama ?? '',
                'nip' => $pegawai->nip ?? '',
                'pangkat' => $pegawai->pangkat ?? '',
                'golongan' => $pegawai->golongan ?? '',
                'jabatan' => $pegawai->jabatan ?? ''
            ];
        }
        // Set values in the template
        $phpWord->setValues($values);

        $namaDokumen = 'SPD_' . $pegawai->nama . '_' . date('d_F_Y', strtotime($tanggal)) . '.docx';

        // Menyimpan dokumen
        $phpWord->saveAs($namaDokumen);
    }
