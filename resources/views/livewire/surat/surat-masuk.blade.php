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
                                        wire:model='form.jenis_agenda_tp' {{ $readonly ? 'disabled' : '' }}>
                                        <option value="none" selected>Pilih</option>
                                        <option value="JENIS_SURAT_TP_01">Surat Masuk (Agenda)</option>
                                        <option value="JENIS_SURAT_TP_02">Surat Masuk (Biasa)</option>
                                    </select>
                                </div>
                            </div>
                            @can('sekretariat')
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Unggah Surat Masuk</label>
                                    <div class="col-lg-9">
                                        <input type="file" id="fileInput" class="form-control"
                                            wire:model='dok_surat' name="dok_surat" {{ $readonly ? 'disabled' : '' }}>
                                    </div>
                                </div>
                            @endcan
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-6">
                                    @if (request()->routeIs('suratmasuk-disposisi') && $suratmasuk)
                                        <embed src="{{ asset('storage/' . $suratmasuk->dok_surat) }}"
                                            type="application/pdf" width="100%" height="600">
                                    @else
                                        <embed id="preview" src="" type="application/pdf" width="100%"
                                            height="600">
                                    @endif
                                </div>
                                <div class="col-6">
                                    @if (request()->routeIs('suratmasuk'))
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
                                                <select class="form-control" name="opd_id" wire:model='form.opd_id'
                                                    @if (Gate::allows('sekretariat', Auth::user())) {{ $readonly ? 'enabled' : '' }}
                                                     @else
                                                     {{ $readonly ? 'disabled' : '' }} @endif>
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
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label">Perihal</label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control" name="perihal"
                                                    wire:model='form.perihal'@if (Gate::allows('sekretariat', Auth::user())) {{ $readonly ? 'enabled' : '' }}
                                                     @else
                                                     {{ $readonly ? 'disabled' : '' }} @endif>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            @if (request()->routeIs('suratmasuk-disposisi'))

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">komentar</label>
                                    <div class="col-lg-9">
                                        @if (Gate::allows('kepala_dinas', Auth::user()))
                                            <textarea type="text" class="form-control" name="deskripsi" wire:model='formTindakLanjut.deskripsi'
                                                {{ $readonly ? 'enabled' : '' }}></textarea>
                                        @else
                                            <textarea type="text" class="form-control" {{ $readonly ? 'disabled' : '' }}>{{ $tindakLanjut->deskripsi }}</textarea>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Diteruskan Kepada</label>
                                    <div class="col-lg-9">
                                        @if (Gate::allows('kepala_dinas', Auth::user()))
                                            <select multiple class="form-control" name="diteruskan_kepada"
                                                wire:model='formTindakLanjut.diteruskan_kepada'
                                                {{ $readonly ? 'enabled' : '' }}>
                                                <option value="" selected>Pilih</option>
                                                @foreach ($skpd as $skpdOption)
                                                    <option value="{{ $skpdOption }}">{{ $skpdOption }}</option>
                                                @endforeach
                                            </select>
                                        @else
                                            <textarea type="text" class="form-control" {{ $readonly ? 'disabled' : '' }}>{{ $tindakLanjut->diteruskan_kepada }}</textarea>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">disposisi</label>
                                    <div class="col-lg-9">
                                        @if (Gate::allows('kepala_bidang', Auth::user()))
                                            <select multiple class="form-control" name="disposisi"
                                                wire:model='formTindakLanjut.disposisi'
                                                {{ $readonly ? 'enabled' : '' }}>
                                                <option value="" selected>Pilih</option>
                                                @foreach ($nama as $nip => $fullName)
                                                    <option value="{{ $nip }}">{{ $fullName }}</option>
                                                @endforeach
                                            </select>
                                        @else
                                            <textarea type="text" class="form-control" {{ $readonly ? 'disabled' : '' }}>{{ $tindakLanjut->disposisi }}</textarea>
                                        @endif
                                    </div>
                                </div>
                                {{-- @can('sekretariat')
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">komentar</label>
                                        <div class="col-lg-9">
                                            <textarea type="text" class="form-control" {{ $readonly ? 'disabled' : '' }}>{{ $tindakLanjut->deskripsi }}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Diteruskan Kepada</label>
                                        <div class="col-lg-9">
                                            <textarea type="text" class="form-control" {{ $readonly ? 'disabled' : '' }}>{{ $tindakLanjut->diteruskan_kepada }}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Diteruskan Kepada</label>
                                        <div class="col-lg-9">
                                            <textarea type="text" class="form-control" {{ $readonly ? 'disabled' : '' }}>{{ $tindakLanjut->disposisi }}</textarea>
                                        </div>
                                    </div>
                                @endcan --}}
                            @endif
                            <div class="text-right">
                                @cannot('staff')
                                    <button type="submit"
                                        class="btn btn-primary">{{ $edit ? 'Simpan Perubahan' : 'Buat SUrat Masuk Baru' }}<i
                                            class="icon-paperplane ml-2"></i></button>
                                @endcannot
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
