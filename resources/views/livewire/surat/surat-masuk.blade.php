<div>
    <style>
        .custom-select-container {
            position: relative;
            display: inline-block;
            width: 100%;
        }

        .custom-select-search {
            width: 100%;
            padding: .375rem .75rem;
            font-size: 1rem;
            line-height: 1.5;
            border: 1px solid #ced4da;
            border-radius: .25rem;
            box-sizing: border-box;
        }

        .custom-select-options {
            position: absolute;
            width: 100%;
            border: 1px solid #ced4da;
            border-radius: .25rem;
            background-color: #fff;
            z-index: 1000;
            max-height: 200px;
            overflow-y: auto;
            display: none;
        }

        .custom-select-option {
            padding: .375rem .75rem;
            cursor: pointer;
        }

        .custom-select-option:hover {
            background-color: #f1f1f1;
        }

        .custom-select-options.show {
            display: block;
        }
    </style>
    <div class="content">
        <div class="card">
            <div class="card-header">
                <h3>Surat Masuk</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    @can('sekretariat')
                        <div class="col-12">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Unggah Dokumen</label>
                                <div class="col-lg-9">
                                    <form action="{{ route('unggah-dokumen.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-11">
                                                    <input type="file" name="dok_surat" class="form-control"
                                                        id="file" required>
                                                </div>
                                                <div class="col-1">
                                                    <button type="submit" class="btn btn-primary">Upload</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    @endcan
                </div>
                <div class="col-12">
                    <div class="row">
                        <div class="col-6">
                            @if ($document_id)
                                <div class="mt-4">
                                    <h2>Preview Dokumen</h2>
                                    @php
                                        $document = \App\Models\Document::find($document_id);
                                    @endphp
                                    @if ($document)
                                        <embed src="{{ $document->dok_surat }}" width="100%" height="600px"
                                            type="application/pdf" />
                                    @endif
                                </div>
                            @endif
                            {{--  @if (request()->routeIs('suratmasuk-disposisi'))
                                <h2>Preview Dokumen</h2>
                                <embed src="{{ Storage::url('uploads/1720880207_LSP MARSA.pdf') }}" width="100%"
                                    height="600px" type="application/pdf" />
                            @endif --}}
                            @if (request()->routeIs('suratmasuk-disposisi') && $suratmasuk->document && $suratmasuk->document->dok_surat)
                                <h2>Preview Dokumen</h2>
                                <embed src="{{ asset($suratmasuk->document->dok_surat) }}" width="100%" height="600px"
                                    type="application/pdf" />
                            @elseif (request()->routeIs('suratmasuk') &&
                                    request()->route('id') &&
                                    $suratmasuk->document &&
                                    $suratmasuk->document->dok_surat)
                                <h2>Preview Dokumen</h2>
                                <embed src="{{ asset($suratmasuk->document->dok_surat) }}" width="100%" height="600px"
                                    type="application/pdf" />
                            @else
                                <p>No document uploaded yet.</p>
                            @endif
                        </div>
                        <div class="col-6">
                            <form action="" wire:submit='save'>
                                @csrf
                                {{-- @if (Gate::allows('sekretariat', Auth::user())) --}}
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Jenis Surat</label>
                                    <div class="col-lg-9">
                                        <div class="form-check">
                                            <input type="radio" id="radioSuratAgenda" class="form-check-input"
                                                name="jenis_agenda_tp" value="JENIS_SURAT_TP_01"
                                                wire:model="form.jenis_agenda_tp"
                                                @if (Gate::allows('sekretariat', Auth::user())) {{ $readonly ? 'enabled' : '' }}
                                                    @else
                                                    {{ $readonly ? 'disabled' : '' }} @endif>
                                            <label class="form-check-label" for="radioSuratAgenda">Surat
                                                Agenda</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" id="radioSuratBiasa" class="form-check-input"
                                                name="jenis_agenda_tp" value="JENIS_SURAT_TP_02"
                                                wire:model="form.jenis_agenda_tp"
                                                @if (Gate::allows('sekretariat', Auth::user())) {{ $readonly ? 'enabled' : '' }}
                                                    @else
                                                    {{ $readonly ? 'disabled' : '' }} @endif>
                                            <label class="form-check-label" for="radioSuratBiasa">Surat
                                                Biasa</label>
                                        </div>
                                    </div>
                                </div>
                                {{-- @endif --}}

                                <div id="selalu-muncul" style="display: none;">
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Kode (Lama)</label>
                                        <div class="col-lg-9">
                                            <input type="text" class="form-control" name="kode_lama"
                                                wire:model='form.kode_lama'
                                                @if (Gate::allows('sekretariat', Auth::user())) {{ $readonly ? 'enabled' : '' }}
                                                     @else
                                                     {{ $readonly ? 'disabled' : '' }} @endif>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Kode (Baru)</label>
                                        <div class="col-lg-9">
                                            <input type="text" class="form-control" name="kode_baru"
                                                wire:model='form.kode_baru'@if (Gate::allows('sekretariat', Auth::user())) {{ $readonly ? 'enabled' : '' }}
                                                     @else
                                                     {{ $readonly ? 'disabled' : '' }} @endif>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Nomor Surat</label>
                                        <div class="col-lg-9">
                                            <input type="text" class="form-control" name="nomor_surat"
                                                wire:model='form.nomor_surat'@if (Gate::allows('sekretariat', Auth::user())) {{ $readonly ? 'enabled' : '' }}
                                                     @else
                                                     {{ $readonly ? 'disabled' : '' }} @endif>
                                        </div>
                                    </div>
                                    {{-- <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Pengirim</label>
                                        <div class="col-lg-9">
                                            <select class="form-control select-search" name="opd_id"
                                                wire:model='form.opd_id'
                                                @if (Gate::allows('sekretariat', Auth::user())) {{ $readonly ? 'enabled' : '' }}
                                                @else
                                                {{ $readonly ? 'disabled' : '' }} @endif
                                                data-fouc>
                                                @foreach ($opdOptions as $id => $opd)
                                                    <option value="{{ $id }}">
                                                        {{ $opd }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div> --}}
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Pengirim</label>
                                        <div class="col-lg-9 custom-select-container">
                                            @if (Gate::allows('sekretariat', Auth::user()))
                                                <input type="text" class="form-control custom-select-search"
                                                    placeholder="Cari..." id="opd-search">
                                                <input type="hidden" name="opd_id" wire:model='form.opd_id'>
                                                <div class="custom-select-options">
                                                    @foreach ($opdOptions as $id => $opd)
                                                        <div class="custom-select-option"
                                                            data-value="{{ $opd }}"
                                                            data-label="{{ $opd }}">
                                                            {{ $opd }}
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @else
                                                <span class="badge bg-blue">{{ $suratmasuk->opd_id }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Tanggal Surat</label>
                                        <div class="col-lg-9">
                                            <input type="date" class="form-control" name="tgl_surat"
                                                wire:model='form.tgl_surat'@if (Gate::allows('sekretariat', Auth::user())) {{ $readonly ? 'enabled' : '' }}
                                                     @else
                                                     {{ $readonly ? 'disabled' : '' }} @endif>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Tanggal Terima</label>
                                        <div class="col-lg-9">
                                            <input type="date" class="form-control" name="tgl_terima"
                                                wire:model='form.tgl_terima'@if (Gate::allows('sekretariat', Auth::user())) {{ $readonly ? 'enabled' : '' }}
                                                     @else
                                                     {{ $readonly ? 'disabled' : '' }} @endif>
                                        </div>
                                    </div>
                                </div>
                                <div id="agenda" style="display: none;">
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Subject</label>
                                        <div class="col-lg-9">
                                            <input type="text" class="form-control" name="acara"
                                                wire:model='form.acara'@if (Gate::allows('sekretariat', Auth::user())) {{ $readonly ? 'enabled' : '' }}
                                                     @else
                                                     {{ $readonly ? 'disabled' : '' }} @endif>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Tanggal Mulai</label>
                                        <div class="col-lg-9">
                                            <input type="date" class="form-control" name="tanggalBerangkat"
                                                wire:model='form.tanggalBerangkat'
                                                @if (Gate::allows('sekretariat', Auth::user())) {{ $readonly ? 'enabled' : '' }}
                                                     @else
                                                     {{ $readonly ? 'disabled' : '' }} @endif>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Tanggal Selesai</label>
                                        <div class="col-lg-9">
                                            <input type="date" class="form-control" name="tanggalPulang"
                                                wire:model='form.tanggalPulang'@if (Gate::allows('sekretariat', Auth::user())) {{ $readonly ? 'enabled' : '' }}
                                                     @else
                                                     {{ $readonly ? 'disabled' : '' }} @endif>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Jam Mulai</label>
                                        <div class="col-lg-9">
                                            <input type="time" class="form-control" name="jamMulai"
                                                wire:model='form.jamMulai'@if (Gate::allows('sekretariat', Auth::user())) {{ $readonly ? 'enabled' : '' }}
                                                     @else
                                                     {{ $readonly ? 'disabled' : '' }} @endif>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Tempat</label>
                                        <div class="col-lg-9">
                                            <input type="text" class="form-control" name="tempat"
                                                wire:model='form.tempat'@if (Gate::allows('sekretariat', Auth::user())) {{ $readonly ? 'enabled' : '' }}
                                                     @else
                                                     {{ $readonly ? 'disabled' : '' }} @endif>
                                        </div>
                                    </div>
                                </div>
                                <div id="biasa" style="display: none;">
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Perihal</label>
                                        <div class="col-lg-9">
                                            <input type="text" class="form-control" name="perihal"
                                                wire:model='form.perihal'@if (Gate::allows('sekretariat', Auth::user())) {{ $readonly ? 'enabled' : '' }}
                                                     @else
                                                     {{ $readonly ? 'disabled' : '' }} @endif>
                                        </div>
                                    </div>
                                </div>
                                {{-- @endif --}}
                                @if (request()->routeIs('suratmasuk-disposisi'))
                                    {{-- @can('add-disposisi') --}}
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Perlu Revisi</label>
                                        <div class="col-lg-9">
                                            <div class="form-check">
                                                <input type="radio" id="radioRevisi" class="form-check-input"
                                                    name="revisi" value="revisi"
                                                    wire:model="formTindakLanjut.revisi"
                                                    @if (Gate::allows('kepala_dinas', Auth::user())) {{ $readonly ? 'enabled' : '' }}
                                                @else
                                                {{ $readonly ? 'disabled' : '' }} @endif>
                                                <label class="form-check-label" for="radioRevisi">Ya</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" id="radioTidakRevisi" class="form-check-input"
                                                    name="revisi" value="tidak_revisi"
                                                    wire:model="formTindakLanjut.revisi"
                                                    @if (Gate::allows('kepala_dinas', Auth::user())) {{ $readonly ? 'enabled' : '' }}
                                                @else
                                                {{ $readonly ? 'disabled' : '' }} @endif>
                                                <label class="form-check-label" for="radioTidakRevisi">Tidak</label>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- @endcan --}}

                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">komentar</label>
                                        <div class="col-lg-9">
                                            @if (Gate::allows('kepala_dinas', Auth::user()))
                                                <textarea type="text" class="form-control" name="deskripsi" wire:model='formTindakLanjut.deskripsi'
                                                    {{ $readonly ? 'enabled' : '' }}></textarea>
                                            @else
                                                <div class="form-group">
                                                    <span class="form-control"> {{ $tindakLanjut->deskripsi }}</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div id="tidakRevisi" style="display: none;">
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label">Diteruskan kepada</label>
                                            <div class="col-lg-9">
                                                @if (Gate::allows('kepala_dinas', Auth::user()))
                                                    <button type="button" class="btn btn-secondary mb-2"
                                                        onclick="selectAllOptions()">Select All</button>
                                                    <select multiple class="form-control" name="diteruskan_kepada"
                                                        id="diteruskan_kepada"
                                                        wire:model='formTindakLanjut.diteruskan_kepada'
                                                        {{ $readonly ? 'enabled' : '' }}>
                                                        @foreach ($skpd as $skpdOption)
                                                            <option value="{{ $skpdOption }}">{{ $skpdOption }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                @else
                                                    @foreach ($suratmasuk->tindakLanjuts as $tindakLanjut)
                                                        <span
                                                            class="badge bg-purple">{{ $tindakLanjut->diteruskan_kepada }}</span>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label">disposisi</label>
                                            <div class="col-lg-9">
                                                @if (Gate::allows('kepala_bidang', Auth::user()))
                                                    <button type="button" class="btn btn-secondary mb-2"
                                                        onclick="selectAllOptionsDisposisi()">Select All</button>
                                                    <select multiple class="form-control" name="disposisi"
                                                        id="disposisi" wire:model='formTindakLanjut.disposisi'
                                                        {{ $readonly ? 'enabled' : '' }}>
                                                        @foreach ($nama as $nip => $fullName)
                                                            <option value="{{ $fullName }}">{{ $fullName }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                @else
                                                    @foreach ($suratmasuk->tindakLanjuts as $tindakLanjut)
                                                        <span
                                                            class="badge bg-blue">{{ $tindakLanjut->disposisi }}</span>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-9">
                                            @can('sekretariat')
                                                <button type="button" wire:click="distribusikan"
                                                    class="btn btn-primary">Distribusikan</button>
                                            @endcan
                                        </div>
                                    </div>
                                @endif
                                @can('view-status-surat')
                                    <div id="selalu-muncul-tombol" style="display: none;">
                                        <div class="text-right">
                                            <button type="submit" class="btn btn-primary">
                                                {{ $edit ? 'Simpan Perubahan' : 'Submit' }}
                                                <i class="icon-paperplane ml-2"></i>
                                            </button>
                                        </div>
                                    </div>
                                @elsecan('staff')
                                    <div class="text-right">
                                        <button wire:click="back" class="btn btn-primary">
                                            Kembali
                                            <i class="icon-back"></i>
                                        </button>
                                    </div>
                                @endcan
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script> --}}
{{-- <script>
    $(document).ready(function() {
        // Inisialisasi select2
        $('#dynamicSelect').select2();
        // Event handler untuk perubahan select
        $('#dynamicSelect').on('change', function() {
            var selectedOption = $(this).val();
            // Menampilkan form sesuai dengan opsi yang dipilih
            if (selectedOption === 'JENIS_SURAT_TP_01') {
                $('#selalu-muncul').show();
                $('#selalu-muncul-tombol').show();
                $('#agenda').show();
                $('#biasa').hide();
            } else if (selectedOption === 'JENIS_SURAT_TP_02') {
                $('#selalu-muncul').show();
                $('#selalu-muncul-tombol').show();
                $('#agenda').hide();
                $('#biasa').show();
            } else {
                // Default jika tidak ada yang dipilih
                $('#selalu-muncul').hide();
                $('#selalu-muncul-tombol').hide();
                $('#agenda').hide();
                $('#biasa').hide();
            }
        });
    });
</script> --}}

<script>
    $(document).ready(function() {
        // Fungsi untuk mengatur tampilan berdasarkan radio button yang dipilih
        function updateVisibility() {
            var selectedValue = $('input[name="jenis_agenda_tp"]:checked').val();

            if (selectedValue === 'JENIS_SURAT_TP_01') {
                $('#selalu-muncul').show();
                $('#selalu-muncul-tombol').show();
                $('#agenda').show();
                $('#biasa').hide();
            } else if (selectedValue === 'JENIS_SURAT_TP_02') {
                $('#selalu-muncul').show();
                $('#selalu-muncul-tombol').show();
                $('#agenda').hide();
                $('#biasa').show();
            } else {
                $('#selalu-muncul').hide();
                $('#selalu-muncul-tombol').hide();
                $('#agenda').hide();
                $('#biasa').hide();
            }
        }

        // Inisialisasi tampilan berdasarkan pilihan default saat halaman dimuat
        updateVisibility();

        // Event handler untuk perubahan radio button
        $('input[name="jenis_agenda_tp"]').on('change', function() {
            updateVisibility();
        });
    });
</script>

<script>
    $(document).ready(function() {
        // Fungsi untuk mengatur tampilan berdasarkan radio button yang dipilih
        function updateVisibility() {
            var selectedValue = $('input[name="revisi"]:checked').val();

            if (selectedValue === 'revisi') {
                $('#tidakRevisi').hide();
            } else if (selectedValue === 'tidak_revisi') {
                $('#tidakRevisi').show();
            } else {
                $('#tidakRevisi').show();
            }
        }

        // Inisialisasi tampilan berdasarkan pilihan default saat halaman dimuat
        updateVisibility();

        // Event handler untuk perubahan radio button
        $('input[name="revisi"]').on('change', function() {
            updateVisibility();
        });
    });
</script>

<script>
    function selectAllOptions() {
        var select = document.getElementById('diteruskan_kepada');
        for (var i = 0; i < select.options.length; i++) {
            select.options[i].selected = true;
        }
        // Trigger the change event to inform Livewire about the changes
        select.dispatchEvent(new Event('change'));
    }
</script>
<script>
    function selectAllOptionsDisposisi() {
        var select = document.getElementById('disposisi');
        if (select) {
            for (var i = 0; i < select.options.length; i++) {
                select.options[i].selected = true;
            }
            // Trigger the change event to inform Livewire about the changes
            select.dispatchEvent(new Event('change'));
        } else {
            console.error('Element with ID disposisi not found.');
        }
    }
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.querySelector('#opd-search');
        const optionsContainer = document.querySelector('.custom-select-options');
        const optionsList = Array.from(document.querySelectorAll('.custom-select-option'));

        // Menampilkan opsi saat input fokus
        searchInput.addEventListener('focus', function() {
            optionsContainer.classList.add('show');
        });

        // Menyaring opsi berdasarkan input pencarian
        searchInput.addEventListener('input', function() {
            const searchTerm = searchInput.value.toLowerCase();
            optionsList.forEach(option => {
                const label = option.dataset.label.toLowerCase();
                option.style.display = label.includes(searchTerm) ? 'block' : 'none';
            });
        });

        // Menangani klik pada opsi
        optionsList.forEach(option => {
            option.addEventListener('click', function() {
                searchInput.value = option.dataset.label; // Menampilkan nama yang dipilih
                const hiddenInput = document.querySelector('input[name="opd_id"]');
                hiddenInput.value = option.dataset.value; // Menyimpan ID ke hidden input

                // Memicu pembaruan Livewire
                hiddenInput.dispatchEvent(new Event('input'));

                optionsContainer.classList.remove('show');
            });
        });

        // Menutup dropdown saat klik di luar elemen dropdown
        document.addEventListener('click', function(event) {
            if (!event.target.closest('.custom-select-container')) {
                optionsContainer.classList.remove('show');
            }
        });
    });
</script>
