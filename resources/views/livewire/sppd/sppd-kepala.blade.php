<div>
    <div class="content">
        <div class="card">
            <div class="card-header text-center">
                <h3>Perjalanan Dinas</h3>
                <div class="dropdown-divider"></div>
            </div>
            <div class="card-body">
                <form wire:submit='save'>
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Nama Pegawai -->
                            <div class="form-group margin">
                                <label for="nama" class="col-form-label col-lg-12">Pilih Pegawai<span
                                        class="text-danger">*</span></label>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <div wire:ignore>
                                            <select class="form-control select-search-kusus" id="nip"
                                                wire:model.live='formNama'>
                                                @foreach ($nama as $nip => $namaOption)
                                                    <option value="{{ $nip }}">{{ $namaOption }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    @error('formNama')
                                        <div class="text-danger">
                                            <i class="icon-cancel-circle2"></i>
                                            <span><b>{{ $message }}</b></span>
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Tanggal Berangkat Tanggal Kembali -->
                            <div class="form-group margin row">
                                <div class="col-md-6">
                                    <label class="col-form-label  col-lg-12">Tanggal Berangkat<span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <input class="form-control daterange-single"
                                                wire:model.live='form.tgl_berangkat' type="date">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        @error('form.tgl_berangkat')
                                            <div class="text-danger">
                                                <i class="icon-cancel-circle2"></i>
                                                <span><b>{{ $message }}</b></span>
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="col-form-label col-lg-12">Tanggal Harus Kembali<span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <input class="form-control daterange-single"
                                                wire:model.live='form.tgl_kembali' type="date">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        @error('form.tgl_kembali')
                                            <div class="text-danger">
                                                <i class="icon-cancel-circle2"></i>
                                                <span><b>{{ $message }}</b></span>
                                            </div>
                                        @enderror
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
                                <div class="col-lg-12">
                                    @error('form.hari')
                                        <div class="text-danger">
                                            <i class="icon-cancel-circle2"></i>
                                            <span><b>{{ $message }}</b></span>
                                        </div>
                                    @enderror
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
                                    <div class="col-lg-12">
                                        @error('form.tempat_berangkat')
                                            <div class="text-danger">
                                                <i class="icon-cancel-circle2"></i>
                                                <span><b>{{ $message }}</b></span>
                                            </div>
                                        @enderror
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
                                    <div class="col-lg-12">
                                        @error('form.tempat_tujuan')
                                            <div class="text-danger">
                                                <i class="icon-cancel-circle2"></i>
                                                <span><b>{{ $message }}</b></span>
                                            </div>
                                        @enderror
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
                                            <select class="form-control" wire:model.live='form.tingkat_id'>
                                                <option value="C">C</option>
                                                <option value="A">A</option>
                                                <option value="B">B</option>
                                                <option value="D">D</option>
                                                <option value="E">E</option>
                                            </select>
                                            <span id="tingkat_id-error" class="invalid-feedback"
                                                style="display: block;"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        @error('form.tingkat_id')
                                            <div class="text-danger">
                                                <i class="icon-cancel-circle2"></i>
                                                <span><b>{{ $message }}</b></span>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="col-form-label col-lg-12">Alat Angkut Yang Dipergunakan<span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <select class="form-control" wire:model.live='form.alat_angkut_st'>
                                                <option value="ALAT_ANGKUT_ST_01">Kendaraan Dinas</option>
                                                <option value="ALAT_ANGKUT_ST_02">Kendaraan Umum</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        @error('form.alat_angkut_st')
                                            <div class="text-danger">
                                                <i class="icon-cancel-circle2"></i>
                                                <span><b>{{ $message }}</b></span>
                                            </div>
                                        @enderror
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
                                <div class="col-lg-12">
                                    @error('form.keterangan')
                                        <div class="text-danger">
                                            <i class="icon-cancel-circle2"></i>
                                            <span><b>{{ $message }}</b></span>
                                        </div>
                                    @enderror
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
                                <div class="col-lg-12">
                                    @error('form.ditetapkan_tgl')
                                        <div class="text-danger">
                                            <i class="icon-cancel-circle2"></i>
                                            <span><b>{{ $message }}</b></span>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div>
                                <label class="col-form-label col-lg-12">Dasar
                                    <span class="text-danger">*</span>
                                    {{-- <span class="badge badge-danger">Tidak Perlu Menuliskan Nomor (3.)</span> --}}
                                </label>
                                <div class="col-lg-12">
                                    <ol>
                                        <li>Surat Keputusan Menteri Keuangan RI Nomor: S-185/MK.03/1996 tanggal 2 April
                                            1996 tentang Uang Harian Perjalanan Dinas Dalam Negeri Pegawai Negeri Sipil;
                                        </li>
                                        <li>{{ $masterDasar }}
                                        </li>
                                        <li>
                                            <textarea class="form-control" rows="3"
                                                placeholder="Contoh: Surat Undangan Pemerintah Provinsi Jawa Tengah Dinas Komunikasi dan Informatika Nomor : 500.12/439 tgl. 26 September 2024;"
                                                rows="2" wire:model='formDasar'></textarea>
                                            <div>
                                                @error('formDasar')
                                                    <div class="text-danger">
                                                        <i class="icon-cancel-circle2"></i>
                                                        <span><b>{{ $message }}</b></span>
                                                    </div>
                                                @enderror
                                            </div>
                                        </li>
                                    </ol>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        {{-- <textarea class="form-control" rows="3"
                                            placeholder="Contoh: Surat Keputusan Menteri Keuangan RI Nomor: S-185/MK.03/1996 tanggal 2 April 1996 tentang Uang Harian Perjalanan Dinas Dalam Negeri Pegawai Negeri Sipil;"
                                            data-name="dasar" rows="2" wire:model='form.dasar'></textarea>
                                        <div>
                                            @error('form.dasar')
                                                <div class="text-danger">
                                                    <i class="icon-cancel-circle2"></i>
                                                    <span><b>{{ $message }}</b></span>
                                                </div>
                                            @enderror
                                        </div> --}}


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
                                    <ol>
                                        <div class="form-group">
                                            <textarea class="form-control" rows="2" id="maksud" wire:model='form.maksud'
                                                placeholder="Contoh: Audiensi dan konsultasi terkait Evaluasi Keterbukaan Informasi Publik"></textarea>
                                            <div>
                                                @error('form.maksud')
                                                    <div class="text-danger">
                                                        <i class="icon-cancel-circle2"></i>
                                                        <span><b>{{ $message }}</b></span>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </ol>

                                </div>
                            </div>

                            <div>
                                <label class="col-form-label col-lg-12">Untuk<span class="text-danger">*</span>
                                    {{-- <span class="badge badge-danger">Tidak Perlu Angka </span> --}}
                                </label>

                                <div class="col-lg-12">
                                    <ol>
                                        <li>
                                            <textarea class="form-control" rows="3" wire:model='form.untuk'
                                                placeholder="Contoh: Melakukan audiensi dan konsultasi terkait Evaluasi Keterbukaan Informasi Publik, pada hari Kamis 9 Maret 2023 di Kantor Komisi Informasi Jawa Tengah;">
                                            </textarea>
                                            @error('form.untuk')
                                                <div class="text-danger">
                                                    <i class="icon-cancel-circle2"></i>
                                                    <span><b>{{ $message }}</b></span>
                                                </div>
                                            @enderror
                                        </li>
                                        <li>Melaporkan hasilnya kepada pejabat yang
                                            bersangkutan;
                                        </li>
                                        <li>Perintah ini dilaksanakan dengan penuh
                                            tanggung jawab.
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="container">
                        <div class="dropdown-divider"></div>
                    </div> --}}

                    <!-- Button Submit -->
                    <div class="text-right mt-3">
                        <div class="card-footer">
                            <a href="{{ route('sppd-index') }}" class="btn bg-grey-400 float-left"><i
                                    class="mr-2 icon-square-left"></i>Kembali
                            </a>
                            <button type="submit" class="btn btn-primary"><i
                                    class="mr-2 icon-paperplane"></i>{{ $edit ? 'Simpan Perubahan' : 'Submit' }}
                            </button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>

    @script
        <script>
            $('.select-search-kusus').select2();

            $('.select-search-kusus').change(function() {
                let nilai = $(this).val();
                $wire.set('formNama', nilai);
            });

            setTimeout(function() {
                $('.select-search-kusus').trigger('change');
            }, 500); // 500 milliseconds delay

            $wire.on('update-pegawai', () => {
                console.log($wire.formNama);
            });
        </script>
    @endscript


    @push('css')
        <style>
            .margin {
                margin-bottom: 0.1rem
            }
        </style>
    @endpush
