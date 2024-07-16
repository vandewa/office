<div>
    <div class="content" style="padding: 20px">
        <div class="card">
            <div class="card-header">
                <h2>{{ $edit ? 'Edit Form SPT' : 'Buat Form SPT Baru' }}</h2>
                <div class="dropdown-divider"></div>
            </div>
            <div class="card-body">
                <div class="col-12">
                    {{-- <form action=""

                        @if (request()->routeIs('sppd')) wire:submit='save' @else  wire:submit='submitLaporan' @endif> --}}
                    <form action="" wire:submit.prevent='save'>
                        @csrf
                        <div class="row" style="margin: 20px">
                            <div class="col-6">
                                <!-- Nama Pegawai -->
                                <div>
                                    <label for="nama" class="col-form-label col-lg-12">Pilih Nama
                                        Pegawai<span class="text-danger"><small>*(urutkan berdasarkan
                                                kepangkatan)</small></span></label>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <select multiple class="form-control" id="nip" name="nip[]"
                                                wire:model='formNama.nip' {{ $readonly ? 'disabled' : '' }}>
                                                @foreach ($nama as $nip => $namaOption)
                                                    <option value="{{ $nip }}">{{ $namaOption }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- Tingkat Menurut Perjalanan -->
                                <div>
                                    <label class="col-form-label col-lg-12">Tingkat Menurut Perjalanan<span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <select class="form-control is-valid" required="" name="tingkat_id"
                                                wire:model='form.tingkat_id' aria-describedby="tingkat_id-error"
                                                aria-invalid="false" {{ $readonly ? 'disabled' : '' }}>
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
                                                cols="50" {{ $readonly ? 'disabled' : '' }}></textarea>
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
                                                    wire:model='form.alat_angkut_st' {{ $readonly ? 'disabled' : '' }}>
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
                                                    wire:model='form.tempat_berangkat' type="text" value="Wonosobo"
                                                    {{ $readonly ? 'disabled' : '' }}>
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
                                                    wire:model='form.tempat_tujuan' type="text"
                                                    {{ $readonly ? 'disabled' : '' }}>
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
                                                    wire:model='form.hari' type="number"
                                                    {{ $readonly ? 'disabled' : '' }}>
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
                                                    wire:model='form.tgl_berangkat' type="date"
                                                    {{ $readonly ? 'disabled' : '' }}>
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
                                                    type="date" {{ $readonly ? 'disabled' : '' }}>
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
                                                wire:model='form.pengikut' type="text"
                                                {{ $readonly ? 'disabled' : '' }}>
                                        </div>
                                    </div>
                                </div>

                                <!-- Keterangan Lain-Lain -->
                                <div>
                                    <label class="col-form-label col-lg-12">Keterangan lain-lain</label>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <input class="form-control " placeholder="Keterangan lain-lain"
                                                name="keterangan" wire:model='form.keterangan' type="text"
                                                {{ $readonly ? 'disabled' : '' }}>
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
                                                name="ditetapkan_tgl" wire:model='form.ditetapkan_tgl' type="date"
                                                {{ $readonly ? 'disabled' : '' }}>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <!--Untuk-->
                                <div>
                                    <label class="col-form-label col-lg-12">Untuk<span
                                            class="text-danger">*</span><small class="text-danger">(tidak
                                            perlu
                                            angka)</small></label>
                                    <button type="button" class="mb-2 ml-2 btn btn-info btn-sm" data-toggle="modal"
                                        data-target="#exampleModalCenter2">
                                        Contoh Untuk
                                    </button>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <textarea class="form-control" rows="3" id="untuk" required="" name="untuk" wire:model='form.untuk'
                                                cols="50" {{ $readonly ? 'disabled' : '' }}></textarea>
                                        </div>
                                        2. Melaporkan hasilnya kepada pejabat yang bersangkutan; <br>
                                        3. Perintah ini dilaksanakan dengan penuh tanggung jawab.
                                    </div>
                                </div>
                                <br>

                                <!--Dasar -->
                                <div>
                                    <label class="col-form-label col-lg-12">Dasar<span
                                            class="text-danger">*</span><small class="text-danger">(tidak
                                            perlu
                                            angka)</small></label>
                                    <button type="button" class="mb-2 ml-2 btn btn-info btn-sm" data-toggle="modal"
                                        data-target="#exampleModalCenter3">
                                        Contoh Dasar
                                    </button>
                                    <div class="col-lg-12">
                                        @foreach ($formDasar as $index => $dasar)
                                            <div class="form-group">
                                                <textarea class="form-control" rows="6" cols="50" required="" data-name="dasar" rows="2"
                                                    cols="50" name="dasar[]" wire:model="formDasar.{{ $index }}.dasar" {{ $readonly ? 'disabled' : '' }}></textarea>
                                                <button type="button" class="btn btn-danger"
                                                    wire:click="removeDasar({{ $index }})">Hapus
                                                    Dasar</button>
                                            </div>
                                        @endforeach

                                        <button type="button" class="btn btn-primary pull-right"
                                            wire:click="addDasar">Tambah Dasar</button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <!-- Laporan Sppd -->
                                @if (request()->routeIs('sppd-laporan'))
                                    <div>
                                        <label class="col-form-label col-lg-12">Laporan Sppd</label>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <input class="form-control " placeholder="Laporan Sppd"
                                                    name="laporan_sppd" wire:model='formLaporan.laporan_sppd'
                                                    type="text" {{ $readonly ? 'enabled' : '' }}>
                                            </div>
                                        </div>
                                    </div>
                                @endif
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
    </div>
