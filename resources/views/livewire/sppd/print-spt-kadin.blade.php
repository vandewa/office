<!DOCTYPE html>
<html>

<head>
    <title>SPT KEPALA DINAS</title>
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
                        <font size="5"><b>SEKRETARIAT DAERAH</b></font><br>
                        <font size="2">Jalan Soekarno-Hatta Nomor 2-4 Wonosobo, Jawa Tengah, 56311</font><br>
                        <font size="2">Telepon (0286) 321341, Faksimile (0286) 321341</font><br>
                        <font size="2">Laman ppidsetda.wonosobokab.go.id, Pos-el setda@wonosobokab.go.id</font><br>
                    </center>
                </td>
            </tr>
        </table>
        <hr>
        <table width="648">
            <tr>
                <td class="text"><b><u>SURAT PERINTAH TUGAS</u></b></td>
            </tr>
            <tr>
                <td class="text">NOMOR : </td>
            </tr>
        </table>
        <br>
        <table width="648">
            <tr>
                <td width="60">Dasar</td>
                <td width="20">:</td>
                @foreach ($dasar_sppd as $index => $dasar)
                    <td width="20">{{ $index + 1 }}.</td>
                    <td>{{ $dasar->dasar }}</td>
                @endforeach
            </tr>
        </table>
        <br>
        <table width="648">
            <tr>
                <td class="text">MEMERINTAHKAN</td>
            </tr>
        </table>
        <br>
        <table width="648">
            <tr>
                <td width="60">Kepada</td>
                <td width="20">:</td>
                <td width="20">1.</td>
                <td width="120">Nama</td>
                <td width="20">:</td>
                <td>FAHRUDIN AZIS, S.Sn.</td>
            </tr>
            <tr>
                <td width="60"></td>
                <td width="20"></td>
                <td width="20"></td>
                <td width="120">NIP</td>
                <td width="20">:</td>
                <td>197710122006041007</td>
            </tr>
            <tr>
                <td width="60"></td>
                <td width="20"></td>
                <td width="20"></td>
                <td width="120">Pangkat, gol.ruang</td>
                <td width="20">:</td>
                <td>Penata Tingkat I / III/d</td>
            </tr>
            <tr>
                <td width="60"></td>
                <td width="20"></td>
                <td width="20"></td>
                <td width="120">Jabatan</td>
                <td width="20">:</td>
                <td>Kepala Seksi Pengembangan Sumber Daya Manusia Dan Kerjasama Media Bidang Informasi Dan Komunikasi
                    Publik Dinas Komunikasi Dan Informatika</td>
            </tr>
        </table>
        <br>
        <table width="648">
            <tr>
                <td width="60">Untuk</td>
                <td width="20">:</td>
                <td width="20">1.</td>
                <td>{{ $sppd->untuk }}</td>
            </tr>
            <tr>
                <td width="60"></td>
                <td width="20"></td>
                <td width="20">2.</td>
                <td>Melaporkan hasilnya kepada pejabat yang bersangkutan.</td>
            </tr>
            <tr>
                <td width="60"></td>
                <td width="20"></td>
                <td width="20">3.</td>
                <td>Perintah ini dilaksanakan dengan penuh tanggung jawab.</td>
            </tr>
        </table>
        <br>
        <table width="648">
            <tr>
                <td width="350"></td>
                <td class="text" align="center">Ditetapkan di Wonosobo</td>
            </tr>
            <tr>
                @php
                    use Carbon\Carbon;
                @endphp
                <td width="350"></td>
                <td class="text" align="center">pada tanggal
                    {{ Carbon::parse($sppd->ditetapkan_tgl)->format('d-m-Y') }}</td>
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
                <td width="350"></td>
                <td class="text" align="center"><img src="{{ asset('surat/qr-code.png') }}" alt="QR-Code"
                        width="100"></td>
            </tr>
            <tr>
                <td width="350"></td>
                <td class="text" align="center"><b><u>BAPAK SEKDA YANG TERHORMAT</u></b></td>
            </tr>
            <tr>
                <td width="350"></td>
                <td class="text" align="center">SEKRETARIS DAERAH</td>
            </tr>
            <tr>
                <td width="350"></td>
                <td class="text" align="center">NIP. 1234567890</td>
            </tr>
        </table>
        <br>
    {{-- </center>
    <footer>
        <img src="{{ asset('surat/footer.png') }}" alt="Footer Image">
    </footer> --}}
</body>


</html>
