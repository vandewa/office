<div>
    <div class="content" style="padding: 20px">
        <div class="card">
            <div class="card-header">
                <h2>{{ $edit ? 'Edit Form SPT' : 'Buat Form SPT Baru' }}</h2>
                <div class="dropdown-divider"></div>
            </div>
            <div class="card-header">
                <h2>Form SPT</h2>
                <div class="dropdown-divider"></div>
            </div>
            <div class="card-body">
                <form action="" wire:submit='save'>
                    <div class="row" style="margin: 20px">
                        <div class="col-6">
                            <!-- Nama Pegawai -->
                            <div>
                                <label for="nama" class="col-form-label col-lg-12">Pilih Nama Pegawai<span
                                        class="text-danger"><small>*(urutkan berdasarkan
                                            kepangkatan)</small></span></label>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <select multiple class="form-control" id="nip" name="nip[]"
                                            wire:model='formNama.nip'>
                                            @foreach ($nama as $nip => $namaOption)
                                                <option value="{{ $nip }}">{{ $namaOption }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            {{-- <div>
                                <label for="nip" class="col-form-label col-lg-12">Pilih Nama Pegawai<span class="text-danger"><small>*(urutkan berdasarkan kepangkatan)</small></span></label>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <select multiple="multiple" class="form-control select-fixed-multiple" data-fouc id="nip" name="nip[]" wire:model='formNama.nip'>
                                            @foreach ($nama as $nip => $namaOption)
                                                <option value="{{ $nip }}">{{ $namaOption }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div> --}}

                            {{-- <div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="d-block">Fixed width select</label>
                                        <select multiple="multiple" class="form-control select-fixed-multiple" data-fouc id="nip" name="nip[]"
                                        wire:model='formNama.nip'>
                                            @foreach ($nama as $nip => $namaOption)
                                                <option value="{{ $nip }}">{{ $namaOption }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div> --}}

                            <!-- Tingkat Menurut Perjalanan -->
                            <div>
                                <label class="col-form-label col-lg-12">Tingkat Menurut Perjalanan<span
                                        class="text-danger">*</span></label>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <select class="form-control is-valid" required="" name="tingkat_id"
                                            wire:model='form.tingkat_id' aria-describedby="tingkat_id-error"
                                            aria-invalid="false">
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
                            <!-- Maksud Perjalanan Dinas -->
                            <div>
                                <label class="col-form-label col-lg-12">Maksud Perjalanan Dinas<span
                                        class="text-danger">*</span></label><!-- Button trigger modal -->
                                <button type="button" class="mb-2 ml-2 btn btn-info btn-sm" data-toggle="modal"
                                    data-target="#exampleModalCenter">
                                    Contoh Maksud Perjalanan Dinas
                                </button>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <textarea class="form-control" rows="3" id="maksud" required="" name="maksud" wire:model='form.maksud'
                                            cols="50"></textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- Alat Angkut -->
                            <div>
                                <div>
                                    <label class="col-form-label col-lg-12">Alat Angkut Yg Dipergunakan<span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <select class="form-control" required="" name="alat_angkut_st"
                                                wire:model='form.alat_angkut_st'>
                                                <option value="ALAT_ANGKUT_ST_01">Kendaraan Dinas</option>
                                                <option value="ALAT_ANGKUT_ST_02">Kendaraan Umum</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- Tempat Berangkat -->
                            <div class="row">
                                <div class="col-6">
                                    <label class="col-form-label col-lg-12">Tempat Berangkat<span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <input class="form-control" required="" id="input-field"
                                                onkeyup="capitalizeFirstLetter()" name="tempat_berangkat"
                                                wire:model='form.tempat_berangkat' type="text" value="Wonosobo">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label class="col-form-label col-lg-12">Tempat Tujuan<span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <input class="form-control" id="input-field2"
                                                onkeyup="capitalizeFirstLetter2()" name="tempat_tujuan"
                                                wire:model='form.tempat_tujuan' type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Lama Perjalanan -->
                            <div>
                                <label class="col-form-label col-lg-12">Lama Perjalanan<span
                                        class="text-danger">*</span></label>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <div class="input-group input-group-sm">
                                            <input class="form-control" required="" name="hari"
                                                wire:model='form.hari' type="number">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <span>Hari</span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Tanggal Berangkat Tanggal Kembali -->
                            <div class="row">
                                <div class="col-6">
                                    <label class="col-form-label  col-lg-12">Tanggal Berangkat<span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <input class="form-control daterange-single" required=""
                                                id="tgl_berangkat" name="tgl_berangkat"
                                                wire:model='form.tgl_berangkat' type="date">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label class="col-form-label col-lg-12">Tanggal Harus Kembali<span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <input class="form-control daterange-single" required=""
                                                id="tgl_kembali" name="tgl_kembali" wire:model='form.tgl_kembali'
                                                type="date">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Pengikut -->
                            <div>
                                <label class="col-form-label col-lg-12">Pengikut</label>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input class="form-control " placeholder="Pengikut" name="pengikut"
                                            wire:model='form.pengikut' type="text">
                                    </div>
                                </div>
                            </div>
                            <!-- Keterangan Lain-Lain -->
                            <div>
                                <label class="col-form-label col-lg-12">Keterangan lain-lain</label>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input class="form-control " placeholder="Keterangan lain-lain"
                                            name="keterangan" wire:model='form.keterangan' type="text">
                                    </div>
                                </div>
                            </div>
                            <!-- Ditetapkan pada -->
                            <div>
                                <label class="col-form-label col-lg-12">Ditetapkan Pada Tanggal<span
                                        class="text-danger">*</span></label>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input class="form-control daterange-single" required=""
                                            name="ditetapkan_tgl" wire:model='form.ditetapkan_tgl' type="date">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div>
                                <label class="col-form-label col-lg-12">Untuk<span class="text-danger">*</span><small
                                        class="text-danger">(tidak perlu angka)</small></label>
                                <button type="button" class="mb-2 ml-2 btn btn-info btn-sm" data-toggle="modal"
                                    data-target="#exampleModalCenter2">
                                    Contoh Untuk
                                </button>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <textarea class="form-control" rows="3" id="untuk" required="" name="untuk" wire:model='form.untuk'
                                            cols="50"></textarea>
                                    </div>
                                    2. Melaporkan hasilnya kepada pejabat yang bersangkutan; <br>
                                    3. Perintah ini dilaksanakan dengan penuh tanggung jawab.
                                </div>
                            </div>
                            <br>
                            <div>
                                <label class="col-form-label col-lg-12">Dasar<span class="text-danger">*</span><small
                                        class="text-danger">(tidak perlu angka)</small></label>
                                <button type="button" class="mb-2 ml-2 btn btn-info btn-sm" data-toggle="modal"
                                    data-target="#exampleModalCenter3">
                                    Contoh Dasar
                                </button>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <textarea class="form-control" rows="6" cols="50"
                                            placeholder="Contoh: Surat Keputusan Menteri Keuangan RI Nomor: S-185/MK.03/1996 tanggal 2 April 1996 tentang Uang Harian Perjalanan Dinas Dalam Negeri Pegawai Negeri Sipil;"
                                            required="" data-name="dasar" rows="2" cols="50" value="" name="dasar"
                                            wire:model='formDasar.dasar' id="test_0_dasar"></textarea>
                                    </div>
                                    <button type="button" class="btn btn-primary pull-right repeater-add-btn">
                                        Tambah Dasar
                                    </button>
                                    {{-- <div class="items" data-index="0">
                                        <!-- Repeater Content -->
                                        <div class="mt-3 mb-3 item-content">
                                            <div class="form-group">
                                                <div class="col-lg-12">
                                                    <textarea class="form-control is-valid" placeholder="Contoh: Surat Keputusan Menteri Keuangan RI Nomor: S-185/MK.03/1996 tanggal 2 April 1996 tentang Uang Harian Perjalanan Dinas Dalam Negeri Pegawai Negeri Sipil;" required="" data-name="dasar" rows="2" name="test[0][dasar]" cols="50" value="" id="test_0_dasar" aria-invalid="false"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Repeater Remove Btn -->
                                        <div class="mt-3 pull-right repeater-remove-btn">
                                            <button class="btn btn-danger remove-btn" disabled="disabled" onclick="$(this).parents('.items').remove()">
                                                Hapus Dasar
                                            </button>
                                        </div>
                                        <div class="clearfix"></div>
                                    <div></div></div> --}}
                                </div>
                            </div>
                            {{-- <div>
                                <label class="col-form-label col-lg-12">Status Laporan</label>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <select class="form-control is-valid" required="" name="status_laporan"
                                        wire:model='formStatus.status_laporan'
                                        aria-invalid="false">
                                        <option value="BS">Belum Selesai</option>
                                        <option value="S">Selesai</option>
                                    </select><span id="tingkat_id-error" class="invalid-feedback"
                                        style="display: block;"></span>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Preview Maksud
                                        Perjalanan Dinas</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <img src="https://diskominfo.wonosobokab.go.id/maksud.jpg" alt=""
                                        width="100%">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Preview Untuk</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <img src="https://diskominfo.wonosobokab.go.id/untuk.jpg" alt=""
                                        width="100%">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalCenter3" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Preview Dasar</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <img src="https://diskominfo.wonosobokab.go.id/dasar.jpg" alt=""
                                        width="100%">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Button Submit -->
                    <div class="text-right">
                        <button class="btn bg-grey-400" wire:click='batal'>Batal <i
                                class="ml-2 icon-square-left"></i></button>
                        <button type="submit"
                            class="bg-teal-400 btn">{{ $edit ? 'Simpan Perubahan' : 'Buat SPT Baru' }}<i
                                class="ml-2 icon-paperplane"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
