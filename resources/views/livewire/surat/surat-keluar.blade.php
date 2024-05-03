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
                                    <select id="selectSurat" class="form-control" name="jenis_agenda_tp" wire:model='form.jenis_agenda_tp'>
                                        <option value="" selected>Pilih</option>
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
                                        wire:model='form.dok_surat'>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div id="previewContainer"></div>
                        </div>
                        {{-- kode lama --}}
                        <div class="col-6">
                            <div id="formTetap" style="display: none;">
                                <!-- Kode lama -->
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Kode (Lama)</label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" name="kode_lama" wire:model='form.kode_lama'>
                                    </div>
                                </div>
                                <!--kode baru -->
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Kode (Baru)</label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" name="kode_baru" wire:model='form.kode_baru'>
                                    </div>
                                </div>
                                <!--nomor surat -->
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Nomor Surat</label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" name="nomor_surat" wire:model='form.nomor_surat'>
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
                                        <input type="date" class="form-control" name="tgl_surat" wire:model='form.tgl_surat'>
                                    </div>
                                </div>
                                {{-- tgl terima --}}
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Tanggal Terima</label>
                                    <div class="col-lg-9">
                                        <input type="date" class="form-control" name="tgl_terima" wire:model='form.tgl_terima'>
                                    </div>
                                </div>
                            </div>
                            <div id="formJENIS_SURAT_TP_01" style="display: none;">
                                {{-- subject --}}
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Subject</label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" name="acara" wire:model='form.acara'>
                                    </div>
                                </div>
                                {{-- tgl mulai --}}
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Tanggal Mulai</label>
                                    <div class="col-lg-9">
                                        <input type="date" class="form-control" name="tanggalBerangkat" wire:model='form.tanggalBerangkat'>
                                    </div>
                                </div>
                                {{-- tgl selesai --}}
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Tanggal Selesai</label>
                                    <div class="col-lg-9">
                                        <input type="date" class="form-control" name="tanggalPulang" wire:model='form.tanggalPulang'>
                                    </div>
                                </div>
                                {{-- jam mulai --}}
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Jam Mulai</label>
                                    <div class="col-lg-9">
                                        <input type="time" class="form-control" name="jamMulai" wire:model='form.jamMulai'>
                                    </div>
                                </div>
                                {{-- tempat --}}
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Tempat</label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" name="tempat" wire:model='form.tempat'>
                                    </div>
                                </div>
                            </div>
                            <div id="formJENIS_SURAT_TP_02" style="display: none;">
                                {{-- perihal --}}
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">perihal</label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" name="perihal" wire:model='form.perihal'>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">{{ $edit ? 'Simpan Perubahan' : 'Buat SUrat Masuk Baru' }}<i
                                        class="icon-paperplane ml-2"></i></button>
                            </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- pilih jenis surat --}}
<script>
    // Mendapatkan elemen select dan semua elemen form input
    const selectSurat = document.getElementById("selectSurat");
    const formTetap = document.getElementById("formTetap");
    const formJENIS_SURAT_TP_01 = document.getElementById("formJENIS_SURAT_TP_01");
    const formJENIS_SURAT_TP_02 = document.getElementById("formJENIS_SURAT_TP_02");

    // Fungsi untuk menampilkan atau menyembunyikan form input berdasarkan pilihan
    function toggleForms() {
        // Semua form disembunyikan terlebih dahulu
        formTetap.style.display = "none";
        formJENIS_SURAT_TP_01.style.display = "none";
        formJENIS_SURAT_TP_02.style.display = "none";

        // Menampilkan form yang sesuai dengan pilihan pada select option
        if (selectSurat.value === "JENIS_SURAT_TP_01") {
            formTetap.style.display = "block";
            formJENIS_SURAT_TP_01.style.display = "block";
        } else if (selectSurat.value === "JENIS_SURAT_TP_02") {
            formTetap.style.display = "block";
            formJENIS_SURAT_TP_02.style.display = "block";
        }
    }

    // Panggil fungsi toggleForms saat nilai select berubah
    selectSurat.addEventListener("change", toggleForms);

    // Panggil fungsi toggleForms saat halaman dimuat untuk menampilkan form sesuai dengan nilai awal select
    window.onload = toggleForms;
</script>

{{-- preview dokumen --}}
<script>
    const fileInput = document.getElementById("fileInput");
    const previewContainer = document.getElementById("previewContainer");

    fileInput.addEventListener("change", function() {
        const file = this.files[0];

        if (file) {
            const reader = new FileReader();

            reader.onload = function(event) {
                const pdfUrl = event.target.result;
                const iframe = document.createElement("iframe");
                iframe.src = pdfUrl;
                iframe.width = "600";
                iframe.height = "850";
                previewContainer.innerHTML = ""; // Clear previous preview
                previewContainer.appendChild(iframe);
            };

            reader.readAsDataURL(file);
        } else {
            previewContainer.innerHTML = ""; // Clear preview if no file selected
        }
    });
</script>

</div>
