<div>
    <div class="content">
        <div class="card">
            <div class="card-header">
                <h2>Form Surat Undangan</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    @can('sekretariat')
                        <div class="col-12">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Unggah Dokumen</label>
                                <div class="col-lg-9">
                                    {{-- <form action="{{ route('unggah-dokumen.storekeluar') }}" method="POST"
                                        enctype="multipart/form-data"> --}}
                                    {{-- @if ($metodeTtd === 'ttd_offline') --}}
                                    @if (request()->routeIs('suratkeluar-verifikasi'))
                                        <form action="{{ route('documents.upload', $suratkeluar->id) }}" method="POST"
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
                                    @endif
                                </div>
                            </div>
                        @endcan
                    </div>
                    <div class="col-12">
                        <div class="row">
                            @if (request()->routeIs('suratkeluar-verifikasi') && $suratkeluar->document)
                                <div class="col-6">
                                    <h2>Preview Dokumen</h2>
                                    <embed src="{{ asset($suratkeluar->document->dok_surat) }}" width="100%"
                                        height="600px" type="application/pdf" />
                                </div>
                                @php $formColClass = 'col-6'; @endphp
                            @else
                                @php $formColClass = 'col-12'; @endphp
                            @endif

                            <div class="{{ $formColClass }}">
                                <form action="" wire:submit='save'>
                                    @csrf
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">nomor_surat</label>
                                        <div class="col-lg-9">
                                            <input type="text" class="form-control"
                                                @if (Gate::allows('sekretariat', Auth::user())) {{ $readonly ? 'enabled' : '' }}
                                            @else
                                            {{ $readonly ? 'disabled' : '' }} @endif
                                                name="nomor_surat" wire:model='form.nomor_surat'>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Tanggal Surat</label>
                                        <div class="col-lg-9">
                                            <input type="date" class="form-control"
                                                @if (Gate::allows('sekretariat', Auth::user())) {{ $readonly ? 'enabled' : '' }}
                                                         @else
                                                         {{ $readonly ? 'disabled' : '' }} @endif
                                                name="tanggal_surat" wire:model='form.tanggal_surat'>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Perihal</label>
                                        <div class="col-lg-9">
                                            <input type="text" class="form-control"
                                                @if (Gate::allows('sekretariat', Auth::user())) {{ $readonly ? 'enabled' : '' }}
                                                         @else
                                                         {{ $readonly ? 'disabled' : '' }} @endif
                                                name="perihal" wire:model='form.perihal'>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Tujuan</label>
                                        <div class="col-lg-9">
                                            <select class="form-control select-search" name="tujuan"
                                                wire:model='form.tujuan'
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
                                        <label class="col-lg-3 col-form-label">Tempat tujuan</label>
                                        <div class="col-lg-9">
                                            <input type="text" class="form-control"
                                                @if (Gate::allows('sekretariat', Auth::user())) {{ $readonly ? 'enabled' : '' }}
                                                         @else
                                                         {{ $readonly ? 'disabled' : '' }} @endif
                                                name="tempat_tujuan" wire:model='form.tempat_tujuan'>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Pembukaan Surat</label>
                                        <div class="col-lg-9">
                                            <input type="text" class="form-control"
                                                @if (Gate::allows('sekretariat', Auth::user())) {{ $readonly ? 'enabled' : '' }}
                                                         @else
                                                         {{ $readonly ? 'disabled' : '' }} @endif
                                                name="pembukaan" wire:model='form.pembukaan'>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Isi Surat</label>
                                        <div class="col-lg-9">
                                            <input type="text" class="form-control"
                                                @if (Gate::allows('sekretariat', Auth::user())) {{ $readonly ? 'enabled' : '' }}
                                       @else
                                           {{ $readonly ? 'disabled' : '' }} @endif
                                                name="isi" wire:model.defer='form.isi'>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">hari Acara</label>
                                        <div class="col-lg-9">
                                            <input type="text" class="form-control"
                                                @if (Gate::allows('sekretariat', Auth::user())) {{ $readonly ? 'enabled' : '' }}
                                                         @else
                                                         {{ $readonly ? 'disabled' : '' }} @endif
                                                name="hari" wire:model='form.hari'>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Tanggal Acara</label>
                                        <div class="col-lg-9">
                                            <input type="date" class="form-control"
                                                @if (Gate::allows('sekretariat', Auth::user())) {{ $readonly ? 'enabled' : '' }}
                                                         @else
                                                         {{ $readonly ? 'disabled' : '' }} @endif
                                                name="tanggal" wire:model='form.tanggal'>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Jam Acara</label>
                                        <div class="col-lg-9">
                                            <input type="time" class="form-control"
                                                @if (Gate::allows('sekretariat', Auth::user())) {{ $readonly ? 'enabled' : '' }}
                                                         @else
                                                         {{ $readonly ? 'disabled' : '' }} @endif
                                                name="pukul_mulai" wire:model='form.pukul_mulai'>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Jam Acara</label>
                                        <div class="col-lg-9">
                                            <input type="time" class="form-control"
                                                @if (Gate::allows('sekretariat', Auth::user())) {{ $readonly ? 'enabled' : '' }}
                                                         @else
                                                         {{ $readonly ? 'disabled' : '' }} @endif
                                                name="pukul_selesai" wire:model='form.pukul_selesai'>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">tempat Acara</label>
                                        <div class="col-lg-9">
                                            <input type="text" class="form-control"
                                                @if (Gate::allows('sekretariat', Auth::user())) {{ $readonly ? 'enabled' : '' }}
                                                         @else
                                                         {{ $readonly ? 'disabled' : '' }} @endif
                                                name="tempat_acara" wire:model='form.tempat_acara'>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Penutup Surat</label>
                                        <div class="col-lg-9">
                                            <input type="text" class="form-control" name="penutup"
                                                wire:model='form.penutup'
                                                @if (Gate::allows('sekretariat', Auth::user())) {{ $readonly ? 'enabled' : '' }}
                                                @else
                                                {{ $readonly ? 'disabled' : '' }} @endif>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        @if (request()->routeIs('suratkeluar-verifikasi'))
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Perlu Revisi</label>
                                                <div class="col-lg-9">
                                                    <div class="form-check">
                                                        <input type="radio" id="radioRevisi"
                                                            class="form-check-input" name="revisi" value="revisi"
                                                            wire:model="formTindakLanjut.revisi"
                                                            @if (Gate::allows('sekre-staff', Auth::user())) {{ $readonly ? 'disabled' : '' }}
                                                    @else
                                                    {{ $readonly ? 'enabled' : '' }} @endif>
                                                        <label class="form-check-label" for="radioRevisi">Ya</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input type="radio" id="radioTidakRevisi"
                                                            class="form-check-input" name="revisi"
                                                            value="tidak_revisi" wire:model="formTindakLanjut.revisi"
                                                            @if (Gate::allows('sekre-staff', Auth::user())) {{ $readonly ? 'disabled' : '' }}
                                                    @else
                                                    {{ $readonly ? 'enabled' : '' }} @endif>
                                                        <label class="form-check-label"
                                                            for="radioTidakRevisi">Tidak</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">komentar</label>
                                                <div class="col-lg-9">
                                                    @if (Gate::allows('add-disposisi', Auth::user()))
                                                        <textarea type="text" class="form-control" name="deskripsi" wire:model='formTindakLanjut.deskripsi'
                                                            {{ $readonly ? 'enabled' : '' }}></textarea>
                                                    @else
                                                        <div class="form-group">
                                                            <span class="form-control">
                                                                {{ $tindakLanjut->deskripsi ?? '-'}}</span>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>

                                            @can('kepala_dinas')
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Tanda tangan</label>
                                                    <select name="metode_ttd" wire:model='formTindakLanjut.metode_ttd'
                                                        id="" class="form-input">Metode Tanda Tangan
                                                        <option value="ttd_online">Tanda Tangan Online</option>
                                                        <option value="ttd_offline">Tanda Tangan Offline</option>
                                                    </select>
                                                </div>
                                            @endcan
                                            <div class="form-group row">
                                                <div class="col-lg-9">
                                                    @can('sekretariat')
                                                        <button type="button" wire:click="distribusikan"
                                                            class="btn btn-primary">Distribusikan</button>
                                                    @endcan
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="text-right">
                                        <button type="submit"
                                            class="btn btn-primary">{{ $edit ? 'Simpan Perubahan' : 'Buat SUrat keluar Baru' }}<i
                                                class="icon-paperplane ml-2"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
