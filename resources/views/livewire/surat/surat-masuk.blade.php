<div>
    <div class="content">
        <div class="card">
            <div class="card-header">

            </div>
            <div class="card-body">
                <form action="" wire:submit.prevent='save'>
                    @csrf
                    <div class="row">
                        <div class="col-12">
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
                                            <select multiple class="form-control" name="disposisi"
                                                wire:model='formTindakLanjut.disposisi'
                                                {{ $readonly ? 'enabled' : '' }}>
                                                <option value="" selected>Pilih</option>
                                                @foreach ($nama as $nip => $fullName)
                                                    <option value="{{ $fullName }}">{{ $fullName }}</option>
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
                                            <div class="form-group">
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
                            @endif
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">
                                    {{ $edit ? 'Simpan Perubahan' : 'Buat Surat Masuk Baru' }}
                                    <i class="icon-paperplane ml-2"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
