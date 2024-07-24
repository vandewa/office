<div>
    <div class="content">
        <div class="card">
            <div class="card-header text-center">
                <h2>Perjalanan Dinas</h2>
                <div class="dropdown-divider"></div>
            </div>
            <div class="card-body">
                <form wire:submit='save'>
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Nama Pegawai -->
                            {{-- <div> --}}
                            <div class="form-group margin">
                                <label for="nama" class="col-form-label col-lg-12">Pilih Pegawai<span
                                        class="text-danger">*</span></label>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <select multiple class="form-control select-search" id="nip"
                                            wire:model='formNama.nip'>
                                            @foreach ($nama as $nip => $namaOption)
                                                <option value="{{ $nip }}">{{ $namaOption }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- Tanggal Berangkat Tanggal Kembali -->
                            <div class="form-group margin row">
                                <div class="col-md-6">
                                    <label class="col-form-label  col-lg-12">Tanggal Berangkat<span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <input class="form-control daterange-single" wire:model='form.tgl_berangkat'
                                                type="date">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="col-form-label col-lg-12">Tanggal Harus Kembali<span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <input class="form-control daterange-single" wire:model='form.tgl_kembali'
                                                type="date">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Lama Perjalanan -->
                            <div class="form-group margin">
                                <label class="col-form-label col-lg-12">Lama Perjalanan<span
                                        class="text-danger">*</span></label>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <div class="input-group input-group-sm">
                                            <input class="form-control" wire:model='form.hari' type="number">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <span>Hari</span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Tempat Berangkat -->
                            <div class="form-group margin row">
                                <div class="col-md-6">
                                    <label class="col-form-label col-lg-12">Tempat Berangkat<span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <input class="form-control" wire:model='form.tempat_berangkat'
                                                type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="col-form-label col-lg-12">Tempat Tujuan<span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <input class="form-control" wire:model='form.tempat_tujuan' type="text"
                                                placeholder="Contoh: Semarang">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Tingkat Menurut Perjalanan -->

                            <div class="form-group margin row">
                                <div class="col-md-6">
                                    <label class="col-form-label col-lg-12">Tingkat Menurut Perjalanan<span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <select class="form-control is-valid" wire:model='form.tingkat_id'
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
                                <div class="col-md-6">
                                    <label class="col-form-label col-lg-12">Alat Angkut Yg Dipergunakan<span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <select class="form-control" wire:model='form.alat_angkut_st'>
                                                <option value="ALAT_ANGKUT_ST_01">Kendaraan Dinas</option>
                                                <option value="ALAT_ANGKUT_ST_02">Kendaraan Umum</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Keterangan Lain-Lain -->
                            <div class="form-group margin">
                                <label class="col-form-label col-lg-12">Keterangan lain-lain</label>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input class="form-control " placeholder="Keterangan lain-lain"
                                            wire:model='form.keterangan' type="text">
                                    </div>
                                </div>
                            </div>

                            <!-- Ditetapkan pada -->
                            <div class="form-group margin">
                                <label class="col-form-label col-lg-12">Ditetapkan Pada Tanggal<span
                                        class="text-danger">*</span></label>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input class="form-control daterange-single" wire:model='form.ditetapkan_tgl'
                                            type="date">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div>
                                <label class="col-form-label col-lg-12">Dasar<span class="text-danger">*</span>
                                    <small class="text-danger">(tidak perlu
                                        angka)</small> <br><br>
                                    <span>
                                        <b>1.</b> Surat Keputusan Menteri Keuangan RI Nomor: S-185/MK.03/1996 tanggal 2
                                        April
                                        1996
                                        tentang Uang Harian Perjalanan Dinas Dalam Negeri Pegawai Negeri Sipil;
                                    </span> <br>
                                    <span>
                                        <b>2.</b> Peraturan Bupati Kabupaten Wonosobo Nomor 46 Tahun 2022 tentang
                                        Standar
                                        Satuan
                                        Harga dan Standar Biaya Umum Pemerintah Kabupaten Wonosobo Tahun Anggaran
                                        2023;
                                    </span>
                                </label>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <textarea class="form-control" rows="3"
                                            placeholder="Contoh: Surat Keputusan Menteri Keuangan RI Nomor: S-185/MK.03/1996 tanggal 2 April 1996 tentang Uang Harian Perjalanan Dinas Dalam Negeri Pegawai Negeri Sipil;"
                                            data-name="dasar" rows="2" wire:model='formDasar.dasar'></textarea>
                                    </div>
                                    {{-- <button type="button" class="btn btn-primary pull-right repeater-add-btn">
                                        Tambah Dasar
                                    </button> --}}
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

                            {{-- @foreach ($this->inputs as $index => $input)
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Name"
                                        wire:model="inputs.{{ $index }}.name">
                                    <input type="email" class="form-control" placeholder="Email"
                                        wire:model="inputs.{{ $index }}.email">
                                    <button type="button" class="btn btn-danger"
                                        wire:click="removeInput({{ $index }})">Remove</button>
                                </div>
                            @endforeach

                            <button type="button" class="btn btn-primary" wire:click="addInput">Add Input</button> --}}

                            <!-- Maksud Perjalanan Dinas -->
                            <div>
                                <label class="col-form-label col-lg-12">Maksud Perjalanan Dinas<span
                                        class="text-danger">*</span>
                                </label><!-- Button trigger modal -->
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <textarea class="form-control" rows="2" id="maksud" wire:model='form.maksud'
                                            placeholder="Contoh: Audiensi dan konsultasi terkait Evaluasi Keterbukaan Informasi Publik"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label class="col-form-label col-lg-12">Untuk<span class="text-danger">*</span>
                                    <small class="text-danger">(tidak perlu angka)</small>
                                </label>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <textarea class="form-control" rows="3" wire:model='form.untuk'
                                            placeholder="Contoh: Melakukan audiensi dan konsultasi terkait Evaluasi Keterbukaan Informasi Publik, pada hari Kamis 9 Maret 2023 di Kantor Komisi Informasi Jawa Tengah;">
                                        </textarea>
                                        <div class="container">
                                            2. Melaporkan hasilnya kepada pejabat yang
                                            bersangkutan;
                                            <br>
                                            3. Perintah ini dilaksanakan dengan penuh
                                            tanggung jawab.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Button Submit -->
                    <div class="text-right">
                        <a href="{{ route('sppd-index') }}" class="btn bg-grey-400" wire:click='batal'>Kembali <i
                                class="ml-2 icon-square-left"></i></a>
                        <button type="submit" class="bg-teal-400 btn">{{ $edit ? 'Simpan Perubahan' : 'Submit' }}<i
                                class="ml-2 icon-paperplane"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    @push('css')
        <style>
            .margin {
                margin-bottom: 0.25rem
            }
        </style>
    @endpush
