<!DOCTYPE html>
<html>

<head>
    <title>SURAT KELUAR</title>
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
        <table width="500">
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
        <br>
        <table width="648">
            <tr>
                <td width="40">Nomor</td>
                <td width="20">:</td>
                <td>{{ $suratkeluar->nomor_surat ?? '-' }}</td>
            </tr>
            <tr>
                <td width="40">Lampiran</td>
                <td width="20">:</td>
                <td>{{ $suratkeluar->lampiran ?? '-' }}</td>
            </tr>
            <tr>
                <td width="40">Perihal</td>
                <td width="20">:</td>
                <td>{{ $suratkeluar->perihal ?? '-' }}</td>
            </tr>
        </table>
        <br>
        <br>
        <br>
        <table width="648">
            <tr>
                <td>Yth.</td>
            </tr>
            <tr>
                <td>{{ $suratkeluar->tujuan ?? '-' }}</td>
            </tr>
            <tr>
                <td>{{ $suratkeluar->tempat_tujuan ?? '-' }}</td>
            </tr>
        </table>
        <br>
        <br>
        <table width="648">
            {{-- <tr>
                <td style="padding-bottom: 6px">Dengan hormat,</td>
            </tr> --}}
            <tr>
                <td style="padding: 10px 0;">{{ $suratkeluar->pembukaan ?? '-' }}</td>
            </tr>
            <tr>
                <td style="padding: 10px 0;">
                    <div style="padding-left: 40px;">
                        {{ $suratkeluar->isi ?? '-' }}
                        <table width="100%">
                            <tr>
                                <td width="100" style="padding: 5px 0;">Hari, Tanggal</td>
                                <td width="20" style="padding: 5px 0;">:</td>
                                <td style="padding: 5px 0;"> {{ $suratkeluar->hari ?? '-' }} ,
                                    {{ $suratkeluar->tanggal ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td width="50" style="padding: 5px 0;">Pukul</td>
                                <td width="20" style="padding: 5px 0;">:</td>
                                <td style="padding: 5px 0;">{{ $suratkeluar->pukul_mulai ?? '-' }} - {{ $suratkeluar->pukul_selesai ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td width="50" style="padding: 5px 0;">Tempat</td>
                                <td width="20" style="padding: 5px 0;">:</td>
                                <td style="padding: 5px 0;">{{ $suratkeluar->tempat_acara ?? '-' }}</td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="padding: 10px 0;">{{ $suratkeluar->penutup ?? '-' }}</td>
            </tr>
        </table>
        <br>
        <br>
        <br>
        <br>
        <table width="500">

            <tr>
                <td width="250"></td>
                <td class="text" align="center"> {{ $jab ?? '-' }}</td>
            </tr>
            <tr>
                <td width="250"></td>
                <td class="text" align="center">Kabupaten Wonosobo</td>
            </tr>
            <tr>
                <td width="250" height="70"></td>
                {{-- @if ($metodeTtd === 'ttd_online') --}}
                    <td align="center"><img src="{{ asset('surat/qr-code.png') }}" alt="Logo" width="100"></td>
                {{-- @endif --}}
                <td></td>
            </tr>
            <tr>
                <td width="250"></td>
                <td class="text" align="center"><b><u> {{ $kepalaDinas->gdp ?? '-'}} {{ $kepalaDinas->nama ?? '-'}}
                            {{ $kepalaDinas->gdb ?? '-'}}</u></b></td>
            </tr>
            <tr>
                <td width="250"></td>
                <td class="text" align="center">NIP. {{ $kepalaDinas->nip ?? '-'}}</td>
            </tr>
        </table>
        <br>
    </center>
    {{-- <footer>
        <img src="{{ asset('surat/footer.png') }}" alt="Footer Image">
    </footer> --}}
</body>


</html>
