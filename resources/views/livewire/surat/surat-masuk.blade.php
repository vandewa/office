<div>
    <div class="content">
        <div class="card">
            <div class="card-header">
                <h2>{{ $edit ? 'Edit Form Surat Masuk' : 'Buat Form Surat Masuk Baru' }}</h2>
                <div class="dropdown-divider"></div>
            </div>
            <div class="card-body">
                <form action="" wire:submit='save'>
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            {{-- jenis surat --}}
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Pilih Jenis Surat</label>
                                <div class="col-lg-9">
                                    <select id="selectSurat" class="form-control" name="jenis_agenda_tp"
                                        wire:model='form.jenis_agenda_tp'>
                                        <option value="none" selected>Pilih</option>
                                        <option value="JENIS_SURAT_TP_01">Surat Masuk (Agenda)</option>
                                        <option value="JENIS_SURAT_TP_02">Surat Masuk (Biasa)</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            {{-- unggah dokumen --}}
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Unggah Surat Masuk</label>
                                <div class="col-lg-9">
                                    <input type="file" id="fileInput" class="form-control"
                                        wire:model='form.dok_surat' name="dok_surat">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                                <embed id="preview" src="" type="application/pdf" width="100%"
                                    height="600">
                        </div>
                        {{-- kode lama --}}
                        <div class="col-6">
                            <div class="form0">
                                <!-- Kode lama -->
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Kode (Lama)</label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" name="kode_lama"
                                            wire:model='form.kode_lama'>
                                    </div>
                                </div>
                                <!--kode baru -->
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Kode (Baru)</label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" name="kode_baru"
                                            wire:model='form.kode_baru'>
                                    </div>
                                </div>
                                <!--nomor surat -->
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Nomor Surat</label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" name="nomor_surat"
                                            wire:model='form.nomor_surat'>
                                    </div>
                                </div>
                                {{-- Pengirim --}}
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Pengirim</label>
                                    <div class="col-lg-9">
                                        <select class="form-control" name="opd_id" wire:model='form.opd_id'>
                                            <option value="" selected>Pilih</option>
                                            <option value="A">Surat Masuk (Agenda)</option>
                                            <option value="B">Surat Masuk (Biasa)</option>
                                        </select>
                                    </div>
                                </div>
                                {{-- tanggal surat --}}
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Tanggal Surat</label>
                                    <div class="col-lg-9">
                                        <input type="date" class="form-control" name="tgl_surat"
                                            wire:model='form.tgl_surat'>
                                    </div>
                                </div>
                                {{-- tgl terima --}}
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Tanggal Terima</label>
                                    <div class="col-lg-9">
                                        <input type="date" class="form-control" name="tgl_terima"
                                            wire:model='form.tgl_terima'>
                                    </div>
                                </div>
                            </div>

                            <div class="form1">
                                {{-- subject --}}
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Subject</label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" name="acara"
                                            wire:model='form.acara'>
                                    </div>
                                </div>
                                {{-- tgl mulai --}}
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Tanggal Mulai</label>
                                    <div class="col-lg-9">
                                        <input type="date" class="form-control" name="tanggalBerangkat"
                                            wire:model='form.tanggalBerangkat'>
                                    </div>
                                </div>
                                {{-- tgl selesai --}}
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Tanggal Selesai</label>
                                    <div class="col-lg-9">
                                        <input type="date" class="form-control" name="tanggalPulang"
                                            wire:model='form.tanggalPulang'>
                                    </div>
                                </div>
                                {{-- jam mulai --}}
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Jam Mulai</label>
                                    <div class="col-lg-9">
                                        <input type="time" class="form-control" name="jamMulai"
                                            wire:model='form.jamMulai'>
                                    </div>
                                </div>
                                {{-- tempat --}}
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Tempat</label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" name="tempat"
                                            wire:model='form.tempat'>
                                    </div>
                                </div>
                            </div>

                            <div class="form2">
                                {{-- perihal --}}
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">perihal</label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" name="perihal"
                                            wire:model='form.perihal'>
                                    </div>
                                </div>
                            </div>

                            <div class="text-right">
                                <button type="submit"
                                    class="btn btn-primary">{{ $edit ? 'Simpan Perubahan' : 'Buat SUrat Masuk Baru' }}<i
                                        class="icon-paperplane ml-2"></i></button>
                            </div>
                </form>
            </div>
        </div>
    </div>
</div>



<script>
    $(document).ready(function() {
        // Sembunyikan semua form saat halaman dimuat
        $('.form0').hide();
        $('.form1').hide();
        $('.form2').hide();

        $('select[name=jenis_agenda_tp]').change(function() {
            let isi = $(this).val();

            if (isi == 'none') {
                $('.form0').hide('slow');
                $('.form1').hide('slow');
                $('.form2').hide('slow');
            }

            if (isi == 'JENIS_SURAT_TP_01') {
                $('.form0').show();
                $('.form1').show('slow');
            } else {
                $('.form1').hide('slow');
            }

            if (isi == 'JENIS_SURAT_TP_02') {
                $('.form0').show();
                $('.form2').show('slow');
            } else {
                $('.form2').hide('slow');
            }

            // Tampilkan form0 jika isi tidak sama dengan JENIS_SURAT_TP_01 atau JENIS_SURAT_TP_02
            if (isi != 'JENIS_SURAT_TP_01' && isi != 'JENIS_SURAT_TP_02') {
                $('.form0').hide('slow');
            }
        });
    });
</script>



<script>
    $(document).ready(function() {
        $('input[name=dok_surat]').change(function() {
            let dokumen = $(this).prop('files')[0];

            // Membuat objek FileReader
            let reader = new FileReader();

            // Event handler untuk menangani saat file selesai dibaca
            reader.onload = function(e) {
                // Mengambil URL hasil pembacaan file sebagai sumber gambar
                let previewUrl = e.target.result;

                // Menampilkan preview file
                $('#preview').attr('src', previewUrl);
            };

            // Membaca konten file sebagai URL data
            reader.readAsDataURL(dokumen);
        });
    });
</script>

</div>
