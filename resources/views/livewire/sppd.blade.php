<div>
    <div class="content" style="padding: 20px">
        <div class="card">
            <div class="card-header">
                <h2>Form SPT</h2>
                <div class="dropdown-divider"></div>
            </div>
            <div class="card-body">
                <form action="">
                    <div class="row" style="margin: 20px">
                        <div class="col-4">
                            <div>
                                <label class="col-form-label col-lg-12">Tingkat Menurut Perjalanan<span
                                        class="text-danger">*</span></label>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <select class="form-control is-valid" required="" name="tingkat_id"
                                            aria-describedby="tingkat_id-error" aria-invalid="false">
                                            <option value="C">C</option>
                                            <option value="A">A</option>
                                            <option value="B">B</option>
                                            <option value="D">D</option>
                                            <option value="E">E</option>
                                        </select><span id="tingkat_id-error" class="invalid-feedback"
                                            style="display: block;"></span>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label class="col-form-label col-lg-12">Lama Perjalanan<span
                                        class="text-danger">*</span></label>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <div class="input-group input-group-sm">
                                            <input class="form-control" required="" name="hari" type="number">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <span>Hari</span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label class="col-form-label col-lg-12">Alat Angkut Yg Dipergunakan<span
                                        class="text-danger">*</span></label>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <select class="form-control" required="" name="alat_angkut_st">
                                            <option value="ALAT_ANGKUT_ST_01">Kendaraan Dinas</option>
                                            <option value="ALAT_ANGKUT_ST_02">Kendaraan Umum</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label class="col-form-label col-lg-12">Tempat Berangkat<span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <input class="form-control" required="" id="input-field"
                                                onkeyup="capitalizeFirstLetter()" name="tempat_berangkat" type="text"
                                                value="Wonosobo">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label class="col-form-label col-lg-12">Tempat Tujuan<span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <input class="form-control" id="input-field2"
                                                onkeyup="capitalizeFirstLetter2()" name="tempat_tujuan" type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label class="col-form-label col-lg-12">Ditetapkan Pada Tanggal<span
                                        class="text-danger">*</span></label>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input class="form-control daterange-single" required=""
                                            name="ditetapkan_tgl" type="text">
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label class="col-form-label col-lg-12">Pengikut</label>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input class="form-control " placeholder="Pengikut" name="pengikut"
                                            type="text">
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label class="col-form-label col-lg-12">Keterangan lain-lain</label>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input class="form-control " placeholder="Keterangan lain-lain"
                                            name="keterangan" type="text">
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label class="col-form-label col-lg-12">Ditetapkan Pada Tanggal<span
                                        class="text-danger">*</span></label>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input class="form-control daterange-single" required=""
                                            name="ditetapkan_tgl" type="text">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div>
                                <label class="col-form-label col-lg-12">Pilih Nama Pegawai<span
                                        class="text-danger"><small>*(urutkan berdasarkan
                                            kepangkatan)</small></span></label>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <select class="form-control select-search select2-hidden-accessible"
                                            multiple="" required="" name="user_id[]" tabindex="-1"
                                            aria-hidden="true">
                                            <option value="790">FAHMI HIDAYAT, S.I.P., M.P.P - Kepala Dinas</option>
                                            <option value="1071">EDI SANTOSO, S.STP.,M.Si - Sekretariat</option>
                                            <option value="1063">INDARWATI, S.Sos.,M.M - IKP (Informasi dan
                                                Komunikasi
                                                Publik)</option>
                                            <option value="1019">SUGENG RIYADI, S.Sos - Informatika</option>
                                            <option value="578">RATNA SULISTIYANI, S.Kom., MM - Informatika</option>
                                            <option value="581">ANITA MARTILOFA, A.Md - Informatika</option>
                                            <option value="1003">BORIMIN, A.Md. - Sekretariat</option>
                                            <option value="798">NOOR ABDILLAH, S.Kom. - Sekretariat</option>
                                            <option value="799">FAHRUDIN AZIS, S.Sn. - IKP (Informasi dan Komunikasi
                                                Publik)</option>
                                            <option value="802">DANANG HARI PURNOMO, S.Kom - Informatika</option>
                                            <option value="801">SUWARTI - Sekretariat</option>
                                            <option value="805">DAMAR WISNU CANDRA PRABOWO, S.Kom - Informatika
                                            </option>
                                            <option value="806">ASEP GINANJAR PUTRA, S.Ds. - IKP (Informasi dan
                                                Komunikasi Publik)</option>
                                            <option value="807">YUNI MUJI LESTARI, A.Md. - IKP (Informasi dan
                                                Komunikasi
                                                Publik)</option>
                                            <option value="808">RICHARD RIYANTO - Informatika</option>
                                            <option value="1000">DEVAN DEWANANTA, S.Kom - Informatika</option>
                                            <option value="1001">ISA MAULANA TANTRA, S.Kom - Informatika</option>
                                            <option value="706">LAYLY NURUL QOMARIAH, S.Kom - Informatika</option>
                                            <option value="1006">AGUNG SETIAWAN, A.Md - IKP (Informasi dan Komunikasi
                                                Publik)</option>
                                            <option value="1009">DINA FEBRIANI WULANSARI, S.Tr.I.Kom - IKP (Informasi
                                                dan
                                                Komunikasi Publik)</option>
                                            <option value="1010">HERSA ARIFATUL MAR'AH, S.Tr.I.Kom - IKP (Informasi
                                                dan
                                                Komunikasi Publik)</option>
                                            <option value="1011">LUTHFIANA NURUL 'AINI, S.S - IKP (Informasi dan
                                                Komunikasi Publik)</option>
                                            <option value="1012">RADIKSA ARDIANTO, S.Tr.I.Kom - IKP (Informasi dan
                                                Komunikasi Publik)</option>
                                            <option value="1013">FAIZAL AZMI NURFAIZIN - IKP (Informasi dan
                                                Komunikasi
                                                Publik)</option>
                                            <option value="1014">MAHARDINI RAHMADHINA, S.Tr.I.Kom - IKP (Informasi
                                                dan
                                                Komunikasi Publik)</option>
                                            <option value="589">SETO RITMA RUMEKSO, S.Kom - Informatika</option>
                                            <option value="1021">RETNO LESTARI - Sekretariat</option>
                                            <option value="1022">Sekretariat - Sekretariat</option>
                                            <option value="1023">DEWANGGA TOMI YULIANTARA - Sekretariat</option>
                                            <option value="1024">HERI AHMAD - Sekretariat</option>
                                            <option value="1025">AHMAD SYAKUR - Sekretariat</option>
                                            <option value="1026">ACHMAD RIFA'I - Sekretariat</option>
                                            <option value="1027">SOLIHIN - Sekretariat</option>
                                            <option value="1028">SLAMET RIYADI - Sekretariat</option>
                                            <option value="1032">ILHAM ARDHA SAPUTRA, S.I.Kom - IKP (Informasi dan
                                                Komunikasi Publik)</option>
                                            <option value="1033">ANDHIKA DEDE SUNDAWA - IKP (Informasi dan Komunikasi
                                                Publik)</option>
                                            <option value="1034">DESTA ARIYANI ASTUTI, S.Sos - IKP (Informasi dan
                                                Komunikasi Publik)</option>
                                            <option value="1035">EKA SAPUTRI, S.M - IKP (Informasi dan Komunikasi
                                                Publik)
                                            </option>
                                            <option value="1036">MITA ROSANA, S.I.Kom - IKP (Informasi dan Komunikasi
                                                Publik)</option>
                                            <option value="1037">NUR KHASANAH - IKP (Informasi dan Komunikasi Publik)
                                            </option>
                                            <option value="1039">BUKHORI - IKP (Informasi dan Komunikasi Publik)
                                            </option>
                                            <option value="1041">TUNJANG ARI SUSENO, S.Ars - IKP (Informasi dan
                                                Komunikasi Publik)</option>
                                            <option value="1042">TITO SUSENO - IKP (Informasi dan Komunikasi Publik)
                                            </option>
                                            <option value="1043">URIP YULIANTO - IKP (Informasi dan Komunikasi
                                                Publik)
                                            </option>
                                            <option value="1044">WAHYU TRI ATMAJA - Informatika</option>
                                            <option value="1045">FAZA LUTHFIA, S. Pd - IKP (Informasi dan Komunikasi
                                                Publik)</option>
                                            <option value="1046">IKBAL SANTOSA - IKP (Informasi dan Komunikasi
                                                Publik)
                                            </option>
                                            <option value="1047">Pesona FM - IKP (Informasi dan Komunikasi Publik)
                                            </option>
                                            <option value="1048">SUPRAYOGI, A.Md.Kom - Informatika</option>
                                            <option value="1050">ARDI KURNIAWAN - IKP (Informasi dan Komunikasi
                                                Publik)
                                            </option>
                                            <option value="1051">DIMAS ANDYKA SAPUTRA - IKP (Informasi dan Komunikasi
                                                Publik)</option>
                                            <option value="1052">YAZILATUN NADHIYAH, S.I.Kom - IKP (Informasi dan
                                                Komunikasi Publik)</option>
                                            <option value="1053">SOFIYANTO, S. Sos - IKP (Informasi dan Komunikasi
                                                Publik)</option>
                                            <option value="1054">DEWI NGASMANAH, S. Tr. I. Kom - IKP (Informasi dan
                                                Komunikasi Publik)</option>
                                            <option value="1055">M NURCHOLIS, S.Kom - Informatika</option>
                                            <option value="1056">TRI MARYANTO, S.Kom - Informatika</option>
                                            <option value="1058">AMALIA FAJARSARI - IKP (Informasi dan Komunikasi
                                                Publik)
                                            </option>
                                            <option value="1059">PELANGI KARISMAKRISTI - IKP (Informasi dan
                                                Komunikasi
                                                Publik)</option>
                                            <option value="1060">Drs. SUPRIYADI, M.M - IKP (Informasi dan Komunikasi
                                                Publik)</option>
                                            <option value="1061">FANA ASY-SYIFA - Sekretariat</option>
                                            <option value="577">ZAKY MOHAMMAD, S.Kom - IKP (Informasi dan Komunikasi
                                                Publik)</option>
                                            <option value="1064">NUR NOFIKA SARI - IKP (Informasi dan Komunikasi
                                                Publik)
                                            </option>
                                            <option value="1065">Drs. ONE ANDANG WARDOYO, M.Si - Informatika</option>
                                            <option value="1066">IWAN MINANTO, A.Md - Informatika</option>
                                            <option value="546">SADDAM HUSAIN, S.Kom - Informatika</option>
                                            <option value="1072">R ARIF BUDIYANTO - Sekretariat</option>
                                            <option value="1074">ZAKI NUR AMALIA KAMILAH, S.Kom - Informatika
                                            </option>
                                            <option value="1075">DEA ALDY ALFIAN, S.Kom - Informatika</option>
                                        </select><span
                                            class="select2 select2-container select2-container--default select2-container--below"
                                            dir="ltr" style="width: 100%;"><span class="selection"><span
                                                    class="select2-selection select2-selection--multiple"
                                                    role="combobox" aria-haspopup="true" aria-expanded="false"
                                                    tabindex="-1">
                                                    <ul class="select2-selection__rendered">
                                                        <li class="select2-search select2-search--inline"><input
                                                                class="select2-search__field" type="search"
                                                                tabindex="0" autocomplete="off" autocorrect="off"
                                                                autocapitalize="none" spellcheck="false"
                                                                role="textbox" aria-autocomplete="list"
                                                                placeholder="" style="width: 0.75em;"></li>
                                                    </ul>
                                                </span></span><span class="dropdown-wrapper"
                                                aria-hidden="true"></span></span>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label class="col-form-label  col-lg-12">Tanggal Berangkat<span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <input class="form-control daterange-single" required=""
                                                id="tgl_berangkat" name="tgl_berangkat" type="date">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label class="col-form-label col-lg-12">Tanggal Harus Kembali<span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <input class="form-control daterange-single" required=""
                                                id="tgl_kembali" name="tgl_kembali" type="date">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label class="col-form-label col-lg-12">Maksud Perjalanan Dinas<span
                                        class="text-danger">*</span></label><!-- Button trigger modal -->
                                <button type="button" class="mb-2 ml-2 btn btn-info btn-sm" data-toggle="modal"
                                    data-target="#exampleModalCenter">
                                    Preview Maksud Perjalanan Dinas
                                </button>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <textarea class="form-control" rows="3" id="maksud" required="" name="maksud" cols="50"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label class="col-form-label col-lg-12">Untuk<span class="text-danger">*</span><small
                                        class="text-danger">(tidak perlu angka)</small></label>
                                <button type="button" class="mb-2 ml-2 btn btn-info btn-sm" data-toggle="modal"
                                    data-target="#exampleModalCenter2">
                                    Preview Untuk
                                </button>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <textarea class="form-control" rows="3" id="untuk" required="" name="untuk" cols="50"></textarea>
                                    </div>
                                    2. Melaporkan hasilnya kepada pejabat yang bersangkutan; <br>
                                    3. Perintah ini dilaksanakan dengan penuh tanggung jawab.
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div>
                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                    data-target="#exampleModalCenter3">
                                    Preview Dasar
                                </button>
                            </div>
                            <div>
                                <label class="col-form-label">Dasar<span class="text-danger">*</span><small
                                        class="text-danger">(tidak perlu angka)</small></label>
                            </div>
                            <div>
                                <button type="button" class="btn btn-primary repeater-add-btn">
                                    Tambah Dasar
                                </button>
                            </div><br>
                            <div>
                                <textarea class="form-control" rows="6" cols="50"
                                    placeholder="Contoh: Surat Keputusan Menteri Keuangan RI Nomor: S-185/MK.03/1996 tanggal 2 April 1996 tentang Uang Harian Perjalanan Dinas Dalam Negeri Pegawai Negeri Sipil;"
                                    required="" data-name="dasar" rows="2" name="test[0][dasar]" cols="50" value=""
                                    id="test_0_dasar"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                        <a href="https://diskominfo.wonosobokab.go.id/spt-sppd" class="btn bg-grey-400">Kembali <i
                                class="ml-2 icon-square-left"></i></a>
                        <button type="submit" class="bg-teal-400 btn">Submit form <i
                                class="ml-2 icon-paperplane"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
