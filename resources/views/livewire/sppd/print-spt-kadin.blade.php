
<!DOCTYPE html>
<html>

<head>
    <title>SPT</title>
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
                {{-- <td style="text-align: left;"><img src="{{ asset('surat/logo.png') }}" alt="Logo" width="170"></td>
                <td>
                    <center>
                        <font size="3">PEMERINTAH KABUPATEN WONOSOBO</font><br>
                        <font size="4"><b>DINAS KOMUNIKASI DAN INFORMATIKA</b></font><br>
                        <font size="1">Jalan Sabuk Alu No 2A Wonosobo, Jawa Tengah, 56311</font><br>
                        <font size="1">Telepon (0286) 321341, Faksimile (0286) 321341</font><br>
                        <font size="1">Laman diskominfo.wonosobokab.go.id</font><br>
                        <font size="1">Pos-el diskominfo@wonosobokab.go.id</font><br>
                    </center> --}}
                    <td><img src="{{ asset('surat/header.png') }}" alt="Logo" width="100%"></td>
                </td>
            </tr>
        </table>
        {{-- <hr> --}}
        <table width="648">
            <tr>
                <td class="text"><b><u>SURAT PERINTAH TUGAS</u></b></td>
            </tr>
            <tr>
                <td class="text">NOMOR : 800.1.11.1/nomor/diskominfo</td>
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
                <td></td>
            </tr>
            <tr>
                <td width="60"></td>
                <td width="20"></td>
                <td width="20"></td>
                <td width="120">NIP</td>
                <td width="20">:</td>
                <td></td>
            </tr>
            <tr>
                <td width="60"></td>
                <td width="20"></td>
                <td width="20"></td>
                <td width="120">Pangkat, gol.ruang</td>
                <td width="20">:</td>
                <td></td>
            </tr>
            <tr>
                <td width="60"></td>
                <td width="20"></td>
                <td width="20"></td>
                <td width="120">Jabatan</td>
                <td width="20">:</td>
                <td></td>
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
        <table width="700">
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
                <td></td>
            </tr>
            <tr>
                <td width="350"></td>
                <td class="text" align="center">KEPALA DINAS KOMUNIKASI DAN INFORMATIKA</td>
            </tr>
            <tr>
                <td width="350"></td>
                <td class="text" align="center">KABUPATEN WONOSOBO</td>
            </tr>
            <tr>
                <td width="350"></td>
                <td class="text" align="center" style="width: 100"></td>
            </tr>
            <tr>
                <td width="350"></td>
                <td class="text" align="center"><b><u>FAHMI HIDAYAT, S.I.P., M.P.P</u></b></td>
            </tr>
            <tr>
                <td width="350"></td>
                <td class="text" align="center">Pembina Tingkat I</td>
            </tr>
            <tr>
                <td width="350"></td>
                <td class="text" align="center">NIP. 197108251999031006</td>
            </tr>
        </table>
        <br>
    {{-- </center>
    <footer>
        <img src="{{ asset('surat/footer.png') }}" alt="Footer Image">
    </footer> --}}
</body>


</html>