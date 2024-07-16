<div>
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
                            @if (request()->routeIs('suratmasuk-disposisi') && $suratmasuk->document)
                                <h2>Preview Dokumen</h2>
                                <embed src="{{ asset($suratmasuk->document->dok_surat) }}" width="100%" height="600px"
                                    type="application/pdf" />
                            @endif
                        </div>
                        <div class="col-6">
                            <form action="" wire:submit='save'>
                                @csrf
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Pilihan</label>
                                    <div class="col-lg-9">
                                        @if (Gate::allows('sekretariat', Auth::user()))
                                            <select id="dynamicSelect" class="form-control" name="jenis_agenda_tp"
                                                wire:model="form.jenis_agenda_tp" {{ $readonly ? 'enabled' : '' }}>
                                                <option value="select" selected>Pilih</option>
                                                <option value="JENIS_SURAT_TP_01">Surat Agenda</option>
                                                <option value="JENIS_SURAT_TP_02">Surat Biasa</option>
                                            </select>
                                        @else
                                            <textarea name="" id="" class="form-control"{{ $readonly ? 'disabled' : '' }}>
                                                {{ $form['jenis_agenda_tp'] ?? 'no data' }}
                                            </textarea>
                                        @endif
                                    </div>
                                </div>
                                <div id="selalu-muncul"
                                    @if (request()->routeIs('suratmasuk')) style="display: none;" @else style="" @endif>
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
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Pengirim</label>
                                        <div class="col-lg-9">
                                            <select class="form-control select-search" name="opd_id"
                                                wire:model='form.opd_id'
                                                @if (Gate::allows('sekretariat', Auth::user())) {{ $readonly ? 'enabled' : '' }}
                                                     @else
                                                     {{ $readonly ? 'disabled' : '' }} @endif
                                                data-fouc>
                                                <option value="" selected>Pilih</option>
                                                @foreach ($opdOptions as $id => $opd)
                                                    <option value="{{ $id }}">{{ $opd }}
                                                    </option>
                                                @endforeach
                                            </select>
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
                                <div id="agenda"
                                    @if (request()->routeIs('suratmasuk')) style="display: none;" @else style="" @endif>
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
                                <div id="biasa"
                                    @if (request()->routeIs('suratmasuk')) style="display: none;" @else style="" @endif>
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
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">komentar</label>
                                        <div class="col-lg-9">
                                            @if (Gate::allows('kepala_dinas', Auth::user()))
                                                <textarea type="text" class="form-control" name="deskripsi" wire:model='formTindakLanjut.deskripsi'
                                                    {{ $readonly ? 'enabled' : '' }}></textarea>
                                            @else
                                                <textarea type="text" class="form-control" {{ $readonly ? 'disabled' : '' }}>{{ $tindakLanjut->deskripsi ?? 'no data' }}</textarea>
                                            @endif
                                        </div>
                                    </div>
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
                                                    <option value="" selected>Pilih</option>
                                                    @foreach ($skpd as $skpdOption)
                                                        <option value="{{ $skpdOption }}">{{ $skpdOption }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            @else
                                                <textarea type="text" class="form-control" {{ $readonly ? 'disabled' : '' }}>
                                                {{ $tindakLanjut->diteruskan_kepada ?? 'no data' }}
                                                </textarea>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">disposisi</label>
                                        <div class="col-lg-9">
                                            @if (Gate::allows('kepala_bidang', Auth::user()))
                                                <button type="button" class="btn btn-secondary mb-2"
                                                    onclick="selectAllOptionsDisposisi()">Select All</button>
                                                <select multiple class="form-control" name="disposisi" id="disposisi"
                                                    wire:model='formTindakLanjut.disposisi'
                                                    {{ $readonly ? 'enabled' : '' }}>
                                                    <option value="" selected>Pilih</option>
                                                    @foreach ($nama as $nip => $fullName)
                                                        <option value="{{ $fullName }}">{{ $fullName }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            @else
                                                <textarea type="text" class="form-control" {{ $readonly ? 'disabled' : '' }}>
                                                {{ $tindakLanjut->disposisi ?? 'no data' }}
                                                </textarea>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-9">
                                            @can('sekretariat')
                                                <button type="button" wire:click="distribusikan"
                                                    class="btn btn-primary">Distribusikan</button>
                                            @endcan
                                            @can('add-disposisi')
                                                <div class="form-group row">
                                                    <label class="d-block font-weight-semibold">Perlu revisi</label>
                                                    <div class="form-check form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input"
                                                                wire:model="formTindakLanjut.revisi" name="revisi"
                                                                value="1">
                                                            Ya
                                                        </label>
                                                    </div>
                                                </div>
                                            @endcan
                                        </div>
                                    </div>
                                @endif
                                @can('view-status-surat')
                                    <div id="selalu-muncul-tombol"
                                        @if (request()->routeIs('suratmasuk')) style="display: none;" @else style="" @endif>
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
<script>
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
