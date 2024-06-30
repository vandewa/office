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
                <td>{n_kep}</td>
            </tr>
            <tr>
                <td width="20">2.</td>
                <td width="200">Nama/NIP Pegawai yang Melaksanakan perjalanan dinas</td>
                <td width="20">:</td>
                <td>{nama}<br>NIP.{nip}</td>
            </tr>
            <tr>
                <td width="20">3.</td>
                <td width="200">a. Pangkat dan golongan</td>
                <td width="20">:</td>
                <td>{pangkat} {golongan}</td>
            </tr>
            <tr>
                <td width="20"></td>
                <td width="200">b. Jabatan / Instansi</td>
                <td width="20">:</td>
                <td>{jabatan}</td>
            </tr>
            <tr>
                <td width="20"></td>
                <td width="200">c. Tingkat Biaya Perjalanan Dinas</td>
                <td width="20">:</td>
                <td>{tingkat}</td>
            </tr>
            <tr>
                <td width="20">4.</td>
                <td width="200">Maksud Perjalanan Dinas</td>
                <td width="20">:</td>
                <td>{maksud}</td>
            </tr>
            <tr>
                <td width="20">5.</td>
                <td width="200">Alat angkut yang dipergunakan</td>
                <td width="20">:</td>
                <td>{alat_angkut}</td>
            </tr>
            <tr>
                <td width="20">6.</td>
                <td width="200">a. Tempat berangkat</td>
                <td width="20">:</td>
                <td>{tmpt_berangkat}</td>
            </tr>
            <tr>
                <td width="20"></td>
                <td width="200">b. Tempat tujuan</td>
                <td width="20">:</td>
                <td>{tmpt_tujuan}</td>
            </tr>
            <tr>
                <td width="20">7.</td>
                <td width="200">a. Lamanya Perjalanan Dinas</td>
                <td width="20">:</td>
                <td>{hari2} {hari} Hari</td>
            </tr>
            <tr>
                <td width="20"></td>
                <td width="200">b. Tanggal berangkat</td>
                <td width="20">:</td>
                <td>{berangkat}</td>
            </tr>
            <tr>
                <td width="20"></td>
                <td width="200">c. Tanggal harus kembali / tiba di tempat baru *)</td>
                <td width="20">:</td>
                <td>{pulang}</td>
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
                <td width="200">{namanya}</td>
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
                <td>{keterangan}</td>
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
                <td width="350"></td>
                <td class="text" align="center">Dikeluarkan di Wonosobo</td>
            </tr>
            <tr>
                @php
                    use Carbon\Carbon;
                @endphp
                <td width="350"></td>
                <td class="text" align="center">Tanggal
                    {{ Carbon::parse($sppd->ditetapkan_tgl)->format('d-m-Y') }}</td>
            </tr>
            <br>
            <tr>
                <td colspan="2"><br></td>
            </tr>
            <tr>
                <td width="350"></td>
                <td class="text" align="center">Pejabat Pembuat Komitmen,</td>
            </tr>
            <tr>
                <td colspan="2"><br><br><br><br><br></td>
            </tr>
            <tr>
                <td width="350"></td>
                <td class="text" align="center"><b><u>{n_kep}</u></b></td>
            </tr>
            <tr>
                <td width="350"></td>
                <td class="text" align="center">NIP. {n_nip}</td>
            </tr>
        </table>
        <br>
    {{-- <footer>
        <img src="{{ asset('surat/footer.png') }}" alt="Footer Image">
    </footer> --}}
    </center>

    <div style="page-break-before: always;"></div>
    <center>
        <table width="648">
            <tr>
                <td width="20"></td>
                <td width="120"></td>
                <td width="20"></td>
                <td></td>
                <td width="20">I.</td>
                <td width="120">Berangkat dari</td>
                <td width="20">:</td>
                <td></td>
            </tr>
            <tr>
                <td width="20"></td>
                <td width="120"></td>
                <td width="20"></td>
                <td></td>
                <td width="20"></td>
                <td width="120">(Tempat Kedudukan)</td>
                <td width="20"></td>
                <td></td>
            </tr>
            <tr>
                <td width="20"></td>
                <td width="120"></td>
                <td width="20"></td>
                <td></td>
                <td width="20"></td>
                <td width="120">Ke</td>
                <td width="20">:</td>
                <td></td>
            </tr>
            <tr>
                <td width="20"></td>
                <td width="120"></td>
                <td width="20"></td>
                <td></td>
                <td width="20"></td>
                <td width="120">Pada Tanggal</td>
                <td width="20">:</td>
                <td></td>
            </tr>
            <tr>
                <td colspan="2"><br></td>
            </tr>
            <tr>
                <td width="20"></td>
                <td width="120"></td>
                <td width="20"></td>
                <td></td>
                <td width="20"></td>
                <td width="120">Kepala</td>
                <td width="20"></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="2"><br><br></td>
            </tr>
            <tr>
                <td width="20"></td>
                <td width="120"></td>
                <td width="20"></td>
                <td></td>
                <td width="20"></td>
                <td width="120">(...........................)</td>
                <td width="20"></td>
                <td></td>
            </tr>
            <tr>
                <td width="20"></td>
                <td width="120"></td>
                <td width="20"></td>
                <td></td>
                <td width="20"></td>
                <td width="120">NIP.</td>
                <td width="20"></td>
                <td></td>
            </tr>
        </table>
        <table width="648">
            <tr>
                <td width="20">II.</td>
                <td width="120">Berangkat dari</td>
                <td width="20">:</td>
                <td></td>
                <td width="20"></td>
                <td width="120">Berangkat dari</td>
                <td width="20">:</td>
                <td></td>
            </tr>
            <tr>
                <td width="20"></td>
                <td width="120">(Tempat Kedudukan)</td>
                <td width="20"></td>
                <td></td>
                <td width="20"></td>
                <td width="120">(Tempat Kedudukan)</td>
                <td width="20"></td>
                <td></td>
            </tr>
            <tr>
                <td width="20"></td>
                <td width="120">Ke</td>
                <td width="20">:</td>
                <td></td>
                <td width="20"></td>
                <td width="120">Ke</td>
                <td width="20">:</td>
                <td></td>
            </tr>
            <tr>
                <td width="20"></td>
                <td width="120">Pada Tanggal</td>
                <td width="20">:</td>
                <td></td>
                <td width="20"></td>
                <td width="120">Pada Tanggal</td>
                <td width="20">:</td>
                <td></td>
            </tr>
            <tr>
                <td colspan="2"><br></td>
            </tr>
            <tr>
                <td width="20"></td>
                <td width="120">Kepala</td>
                <td width="20"></td>
                <td></td>
                <td width="20"></td>
                <td width="120">Kepala</td>
                <td width="20"></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="2"><br><br></td>
            </tr>
            <tr>
                <td width="20"></td>
                <td width="120">(...........................)</td>
                <td width="20"></td>
                <td></td>
                <td width="20"></td>
                <td width="120">(...........................)</td>
                <td width="20"></td>
                <td></td>
            </tr>
            <tr>
                <td width="20"></td>
                <td width="120">NIP.</td>
                <td width="20"></td>
                <td></td>
                <td width="20"></td>
                <td width="120">NIP.</td>
                <td width="20"></td>
                <td></td>
            </tr>
        </table>
        <table width="648">
            <tr>
                <td width="20">III.</td>
                <td width="120">Berangkat dari</td>
                <td width="20">:</td>
                <td></td>
                <td width="20"></td>
                <td width="120">Berangkat dari</td>
                <td width="20">:</td>
                <td></td>
            </tr>
            <tr>
                <td width="20"></td>
                <td width="120">(Tempat Kedudukan)</td>
                <td width="20"></td>
                <td></td>
                <td width="20"></td>
                <td width="120">(Tempat Kedudukan)</td>
                <td width="20"></td>
                <td></td>
            </tr>
            <tr>
                <td width="20"></td>
                <td width="120">Ke</td>
                <td width="20">:</td>
                <td></td>
                <td width="20"></td>
                <td width="120">Ke</td>
                <td width="20">:</td>
                <td></td>
            </tr>
            <tr>
                <td width="20"></td>
                <td width="120">Pada Tanggal</td>
                <td width="20">:</td>
                <td></td>
                <td width="20"></td>
                <td width="120">Pada Tanggal</td>
                <td width="20">:</td>
                <td></td>
            </tr>
            <tr>
                <td colspan="2"><br></td>
            </tr>
            <tr>
                <td width="20"></td>
                <td width="120">Kepala</td>
                <td width="20"></td>
                <td></td>
                <td width="20"></td>
                <td width="120">Kepala</td>
                <td width="20"></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="2"><br><br></td>
            </tr>
            <tr>
                <td width="20"></td>
                <td width="120">(...........................)</td>
                <td width="20"></td>
                <td></td>
                <td width="20"></td>
                <td width="120">(...........................)</td>
                <td width="20"></td>
                <td></td>
            </tr>
            <tr>
                <td width="20"></td>
                <td width="120">NIP.</td>
                <td width="20"></td>
                <td></td>
                <td width="20"></td>
                <td width="120">NIP.</td>
                <td width="20"></td>
                <td></td>
            </tr>
        </table>
        <table width="648">
            <tr>
                <td width="20">IV.</td>
                <td width="120">Berangkat dari</td>
                <td width="20">:</td>
                <td></td>
                <td width="20"></td>
                <td width="120">Berangkat dari</td>
                <td width="20">:</td>
                <td></td>
            </tr>
            <tr>
                <td width="20"></td>
                <td width="120">(Tempat Kedudukan)</td>
                <td width="20"></td>
                <td></td>
                <td width="20"></td>
                <td width="120">(Tempat Kedudukan)</td>
                <td width="20"></td>
                <td></td>
            </tr>
            <tr>
                <td width="20"></td>
                <td width="120">Ke</td>
                <td width="20">:</td>
                <td></td>
                <td width="20"></td>
                <td width="120">Ke</td>
                <td width="20">:</td>
                <td></td>
            </tr>
            <tr>
                <td width="20"></td>
                <td width="120">Pada Tanggal</td>
                <td width="20">:</td>
                <td></td>
                <td width="20"></td>
                <td width="120">Pada Tanggal</td>
                <td width="20">:</td>
                <td></td>
            </tr>
            <tr>
                <td colspan="2"><br></td>
            </tr>
            <tr>
                <td width="20"></td>
                <td width="120">Kepala</td>
                <td width="20"></td>
                <td></td>
                <td width="20"></td>
                <td width="120">Kepala</td>
                <td width="20"></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="2"><br><br></td>
            </tr>
            <tr>
                <td width="20"></td>
                <td width="120">(...........................)</td>
                <td width="20"></td>
                <td></td>
                <td width="20"></td>
                <td width="120">(...........................)</td>
                <td width="20"></td>
                <td></td>
            </tr>
            <tr>
                <td width="20"></td>
                <td width="120">NIP.</td>
                <td width="20"></td>
                <td></td>
                <td width="20"></td>
                <td width="120">NIP.</td>
                <td width="20"></td>
                <td></td>
            </tr>
        </table>
        <table width="648">
            <tr>
                <td width="20">V.</td>
                <td width="120">Berangkat dari</td>
                <td width="20">:</td>
                <td></td>
                <td width="20"></td>
                <td width="120">Berangkat dari</td>
                <td width="20">:</td>
                <td></td>
            </tr>
            <tr>
                <td width="20"></td>
                <td width="120">(Tempat Kedudukan)</td>
                <td width="20"></td>
                <td></td>
                <td width="20"></td>
                <td width="120">(Tempat Kedudukan)</td>
                <td width="20"></td>
                <td></td>
            </tr>
            <tr>
                <td width="20"></td>
                <td width="120">Ke</td>
                <td width="20">:</td>
                <td></td>
                <td width="20"></td>
                <td width="120">Ke</td>
                <td width="20">:</td>
                <td></td>
            </tr>
            <tr>
                <td width="20"></td>
                <td width="120">Pada Tanggal</td>
                <td width="20">:</td>
                <td></td>
                <td width="20"></td>
                <td width="120">Pada Tanggal</td>
                <td width="20">:</td>
                <td></td>
            </tr>
            <tr>
                <td colspan="2"><br></td>
            </tr>
            <tr>
                <td width="20"></td>
                <td width="120">Kepala</td>
                <td width="20"></td>
                <td></td>
                <td width="20"></td>
                <td width="120">Kepala</td>
                <td width="20"></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="2"><br><br></td>
            </tr>
            <tr>
                <td width="20"></td>
                <td width="120">(...........................)</td>
                <td width="20"></td>
                <td></td>
                <td width="20"></td>
                <td width="120">(...........................)</td>
                <td width="20"></td>
                <td></td>
            </tr>
            <tr>
                <td width="20"></td>
                <td width="120">NIP.</td>
                <td width="20"></td>
                <td></td>
                <td width="20"></td>
                <td width="120">NIP.</td>
                <td width="20"></td>
                <td></td>
            </tr>
        </table>
        <table width="648">
            <tr>
                <td width="20">VI.</td>
                <td width="120">Berangkat dari</td>
                <td width="20">:</td>
                <td></td>
                <td width="20"></td>
                <td width="120"></td>
                <td width="20"></td>
                <td></td>
            </tr>
            <tr>
                <td width="20"></td>
                <td width="120">(Tempat Kedudukan)</td>
                <td width="20"></td>
                <td></td>
                <td width="20"></td>
                <td width="120"></td>
                <td width="20"></td>
                <td></td>
            </tr>
            <tr>
                <td width="20"></td>
                <td width="120">Ke</td>
                <td width="20">:</td>
                <td></td>
                <td width="20"></td>
                <td width="120"></td>
                <td width="20"></td>
                <td></td>
            </tr>
            <tr>
                <td width="20"></td>
                <td width="120">Pada Tanggal</td>
                <td width="20">:</td>
                <td></td>
                <td width="20"></td>
                <td width="120"></td>
                <td width="20"></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="2"><br></td>
            </tr>
            <tr>
                <td width="20"></td>
                <td width="120">Kepala</td>
                <td width="20"></td>
                <td></td>
                <td width="20"></td>
                <td width="120"></td>
                <td width="20"></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="2"><br><br></td>
            </tr>
            <tr>
                <td width="20"></td>
                <td width="120">(...........................)</td>
                <td width="20"></td>
                <td></td>
                <td width="20"></td>
                <td width="120"></td>
                <td width="20"></td>
                <td></td>
            </tr>
            <tr>
                <td width="20"></td>
                <td width="120">NIP.</td>
                <td width="20"></td>
                <td></td>
                <td width="20"></td>
                <td width="120"></td>
                <td width="20"></td>
                <td></td>
            </tr>
        </table>
        <table width="648">
            <tr>
                <td width="20">VII.</td>
                <td>Catatan Lain-lain</td>
            </tr>
        </table>
        <table width="648">
            <tr>
                <td width="20">VIII.</td>
                <td width="60">PERHATIAN:</td>
                <td>PPK yang menerbitkan SPD, pegawai yang melakukan perjalanan dinas, para pejabat yang</td>
            </tr>
            <tr>
                <td width="20"></td>
                <td width="60"></td>
                <td>mengesahkan tanggal berangkat/tiba, serta bendahara pengeluaran bertanggung jawab</td>
            </tr>
            <tr>
                <td width="20"></td>
                <td width="60"></td>
                <td>berdasarkan peraturan-peraturan Keuangan Negara apabila negara menderita rugi akibat</td>
            </tr>
            <tr>
                <td width="20"></td>
                <td width="60"></td>
                <td>kesalahan, kelalaian dan kealpaannya.</td>
            </tr>
        </table>
        <table width="648">
            <tr>
                <td colspan="2"><br><br></td>
            </tr>
            <tr>
                <td width="350"></td>
                <td class="text" align="center">SEKRETARIS DAERAH</td>
            </tr>
            <tr>
                <td width="350"></td>
                <td class="text" align="center">KABUPATEN WONOSOBO</td>
            </tr>
            <tr>
                <td colspan="2"><br><br><br><br><br></td>
            </tr>
            <tr>
                <td width="350"></td>
                <td class="text" align="center"><b><u>{n_sekda}</u></b></td>
            </tr>
            <tr>
                <td width="350"></td>
                <td class="text" align="center">NIP. {n_nip_sekda}</td>
            </tr>
        </table>
    </center>
</body>


</html>
