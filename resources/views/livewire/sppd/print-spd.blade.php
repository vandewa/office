<!DOCTYPE html>
<html>

<head>
    <title>SPD KEPALA DINAS</title>
    <style>
        @page {
            size: A4;
            margin: 20mm;
        }

        hr {
            border: 1px solid black;
        }

        table tr td {
            font-size: 13px;
        }

        table tr .text {
            text-align: center;
            font-size: 13px;
        }

        footer {
            position: fixed;
            bottom: 40px;
            left: 0px;
            right: 0px;
            height: 50px;
            text-align: center;
        }

        footer img {
            width: 100%;
            height: auto;
        }
    </style>
</head>

<body onload="window.print()">
    <center>
        <!-- Header and content specific to the first page -->
        <table>
            <tr>
                <td><img src="{{ asset('surat/logo.png') }}" alt="Logo" width="200"></td>
                <td>
                    <center>
                        <font size="4">PEMERINTAH KABUPATEN WONOSOBO</font><br>
                        <font size="5"><b>DINAS KOMUNIKASI DAN INFORMATIKA</b></font><br>
                        <font size="2">Jalan Sabuk Alu No 2A Wonosobo, Jawa Tengah, 56311</font><br>
                        <font size="2">Telepon (0286) 321341, Faksimile (0286) 321341</font><br>
                        <font size="2">Laman diskominfo.wonosobokab.go.id</font><br>
                        <font size="2">Pos-el diskominfo@wonosobokab.go.id</font><br>
                    </center>
                </td>
            </tr>
        </table>
        <hr>
        <table width="648">
            <tr>
                <td></td>
                <td width="100">Lembar ke</td>
                <td width="20">:</td>
                <td width="150"></td>
            </tr>
            <tr>
                <td></td>
                <td width="100">Kode No.</td>
                <td width="20">:</td>
                <td width="150">800.1.11.1</td>
            </tr>
            <tr>
                <td></td>
                <td width="100">Nomor</td>
                <td width="20">:</td>
                <td width="150">800.1.11.1/nomor/diskominfo</td>
            </tr>
        </table>
        <br>
        <table width="648">
            <tr>
                <td class="text"><b><u>SURAT PERJALANAN DINAS (SPD)</u></b></td>
            </tr>
        </table>
        <br>
        <table width="648">
            <tr>
                <td width="20">1.</td>
                <td width="200">Pejabat Pembuat Komitmen</td>
                <td width="20">:</td>
                <td>{{ $kepalaDinas->gdp }} {{ $kepalaDinas->nama }} {{ $kepalaDinas->gdb }}</td>
            </tr>
            <tr>
                <td width="20">2.</td>
                <td width="200">Nama/NIP Pegawai yang Melaksanakan perjalanan dinas</td>
                <td width="20">:</td>
                <td>
                    @foreach ($pegawaiData as $index => $pegawai)
                        {{ $pegawai['nama'] }}
                        <br>NIP. {{ $pegawai['nip'] }}
                    @endforeach
                </td>
            </tr>
            @foreach ($pegawaiData as $index => $pegawai)
                <tr>
                    <td width="20">3.</td>
                    <td width="200">a. Pangkat dan golongan</td>
                    <td width="20">:</td>
                    <td>{{ $pegawai['golru'] }} {{ $pegawai['pangkat'] }}</td>
                </tr>
                <tr>
                    <td width="20"></td>
                    <td width="200">b. Jabatan / Instansi</td>
                    <td width="20">:</td>
                    <td>{{ $pegawai['jab'] }} {{ $pegawai['jabfung'] }} {{ $pegawai['jabfungum'] }}</td>
                </tr>
            @endforeach
            <tr>
                <td width="20"></td>
                <td width="200">c. Tingkat Biaya Perjalanan Dinas</td>
                <td width="20">:</td>
                <td>{{ $sppd->tingkat_id }}</td>
            </tr>
            <tr>
                <td width="20">4.</td>
                <td width="200">Maksud Perjalanan Dinas</td>
                <td width="20">:</td>
                <td>{{ $sppd->untuk }}</td>
            </tr>
            <tr>
                <td width="20">5.</td>
                <td width="200">Alat angkut yang dipergunakan</td>
                <td width="20">:</td>
                <td>{{ $sppd->alat_angkut_st }}</td>
            </tr>
            <tr>
                <td width="20">6.</td>
                <td width="200">a. Tempat berangkat</td>
                <td width="20">:</td>
                <td>{{ $sppd->tempat_berangkat }}</td>
            </tr>
            <tr>
                <td width="20"></td>
                <td width="200">b. Tempat tujuan</td>
                <td width="20">:</td>
                <td>{{ $sppd->tempat_tujuan }}</td>
            </tr>
            <tr>
                <td width="20">7.</td>
                <td width="200">a. Lamanya Perjalanan Dinas</td>
                <td width="20">:</td>
                <td>{{ $sppd->hari }} Hari</td>
            </tr>
            <tr>
                <td width="20"></td>
                <td width="200">b. Tanggal berangkat</td>
                <td width="20">:</td>
                <td>{{ $sppd->tgl_berangkat }}</td>
            </tr>
            <tr>
                <td width="20"></td>
                <td width="200">c. Tanggal harus kembali / tiba di tempat baru *)</td>
                <td width="20">:</td>
                <td>{{ $sppd->tgl_kembali }}</td>
            </tr>
            <tr>
                <td width="20">8.</td>
                <td width="200">Pengikut : Nama</td>
                <td width="20">:</td>
                <td>Tanggal Lahir</td>
                <td>Keterangan</td>
            </tr>
            <tr>
                <td width="20"></td>
                <td width="200">{{ $sppd->pengikut }}</td>
                <td width="20"></td>
                <td>{tgl_lahir}</td>
                <td>{ket}</td>
            </tr>
            <tr>
                <td width="20">9.</td>
                <td width="200">Pembebanan anggaran</td>
                <td width="20"></td>
                <td></td>
            </tr>
            <tr>
                <td width="20"></td>
                <td width="200">a. Instansi</td>
                <td width="20">:</td>
                <td>Dinas Komunikasi dan Informatika</td>
            </tr>
            <tr>
                <td width="20"></td>
                <td width="200">b. Akun</td>
                <td width="20">:</td>
                <td>APBD</td>
            </tr>
            <tr>
                <td width="20">10.</td>
                <td width="200">Keterangan lain-lain</td>
                <td width="20">:</td>
                <td>{{ $sppd->keterangan }}</td>
            </tr>
        </table>
        <table width="648">
            <tr>
                <td>*coret yang tidak perlu</td>
            </tr>
        </table>
        <br>
        <table width="648">
            <tr>
                <td width="400"></td>
                <td width="150">
                    <center>
                        Dikeluarkan di: Wonosobo<br>
                        Pada tanggal: {{ $sppd->ditetapkan_tgl }}<br>
                        Pejabat Pembuat Komitmen<br>
                        <br><br><br>
                        {{ $kepalaDinas->gdp }} {{ $kepalaDinas->nama }} {{ $kepalaDinas->gdb }}<br>
                        NIP. {{ $kepalaDinas->nip }}
                    </center>
                </td>
            </tr>
        </table>
        <br><br><br><br><br>
    </center>
    {{-- <footer>
        <img src="{{ asset('surat/footer.jpg') }}" alt="Footer">
    </footer> --}}
    {{-- <div style="page-break-before: always;"></div>
    <!-- Second page content -->
    <center>
        <br>
        <table width="648">
            <tr>
                <td class="text"><b><u>SURAT PERJALANAN DINAS (SPD)</u></b></td>
            </tr>
        </table>
        <br>
        <table width="648">
            <tr>
                <td width="400"></td>
                <td width="150">
                    <center>
                        Wonosobo, {{ $sppd->tgl_surat }}<br>
                        Kepala Dinas Komunikasi dan Informatika<br>
                        <br><br><br><br><br>
                        {{ $kepalaDinas->gdp }} {{ $kepalaDinas->nama }} {{ $kepalaDinas->gdb }}<br>
                        NIP. {{ $kepalaDinas->nip }}
                    </center>
                </td>
            </tr>
        </table>
        <br><br>
    </center>
    <footer>
        <img src="{{ asset('surat/footer.jpg') }}" alt="Footer">
    </footer> --}}
</body>

</html>
