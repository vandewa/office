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
        <br>
        <table width="648">
            <tr>
                <td width="40">Nomor</td>
                <td width="20">:</td>
                <td>{nomor_surat}</td>
            </tr>
            <tr>
                <td width="40">Lampiran</td>
                <td width="20">:</td>
                <td>{lampiran}</td>
            </tr>
            <tr>
                <td width="40">Perihal</td>
                <td width="20">:</td>
                <td>{perihal}</td>
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
                <td>{nama}</td>
            </tr>
            <tr>
                <td>{tempat}</td>
            </tr>
        </table>
        <br>
        <br>
        <table width="648">
            <tr>
                <td>Dengan hormat,</td>
            </tr>
            <tr>
                <td>{pembukaan}</td>
            </tr>
            <tr>
                <td>{isi}</td>
            </tr>
            <tr>
                <td>{penutup}</td>
            </tr>
        </table>
        <br>
        <br>
        <br>
        <br>
        <table width="648">
            <tr>
                <td width="350"></td>
                <td class="text" align="center">KEPALA DINAS {dinas}</td>
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
                <td class="text" align="center"><b><u>{nama_kadin}</u></b></td>
            </tr>
            <tr>
                <td width="350"></td>
                <td class="text" align="center">{jab}</td>
            </tr>
            <tr>
                <td width="350"></td>
                <td class="text" align="center">NIP. {nip}</td>
            </tr>
        </table>
        <br>
    </center>
    {{-- <footer>
        <img src="{{ asset('surat/footer.png') }}" alt="Footer Image">
    </footer> --}}
</body>


</html>
