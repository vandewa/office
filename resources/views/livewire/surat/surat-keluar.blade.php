<div>
    <div class="card">
        <div class="card-header">
            <h2>Form Surat Keluar</h2>
        </div>
        <div class="card-body">
            <form action="" wire:submit='save'>
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Pilih Jenis Surat</label>
                            <div class="col-lg-9">
                                <select id="selectSurat" class="form-control" name="jenis_surat"
                                    wire:model='form.jenis_surat'
                                    @if (Gate::allows('sekretariat', Auth::user())) {{ $readonly ? 'enabled' : '' }}
                                        @else
                                        {{ $readonly ? 'disabled' : '' }} @endif>
                                    <option value="none" selected>Pilih</option>
                                    <option value="surat_undangan">Surat Undangan</option>
                                    <option value="">Apalagi gt...</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="row">
                        <div class="col-6">
                            preview surat nnti
                        </div>
                        <div class="col-6">
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
                                    <input type="text" class="form-control"
                                        @if (Gate::allows('sekretariat', Auth::user())) {{ $readonly ? 'enabled' : '' }}
                                                     @else
                                                     {{ $readonly ? 'disabled' : '' }} @endif
                                        name="tujuan" wire:model='form.tujuan'>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Pembukaan Surat</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control"
                                        @if (Gate::allows('sekretariat', Auth::user())) {{ $readonly ? 'enabled' : '' }}
                                                     @else
                                                     {{ $readonly ? 'disabled' : '' }} @endif
                                        name="pembukaan_surat" wire:model='form.pembukaan_surat'>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Isi Surat</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control"
                                        @if (Gate::allows('sekretariat', Auth::user())) {{ $readonly ? 'enabled' : '' }}
                                                     @else
                                                     {{ $readonly ? 'disabled' : '' }} @endif
                                        name="isi_surat" wire:model='form.isi_surat'>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Penutup Surat</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" name="penutup_surat"
                                        wire:model='form.penutup_surat'
                                        @if (Gate::allows('sekretariat', Auth::user())) {{ $readonly ? 'enabled' : '' }}
                                            @else
                                            {{ $readonly ? 'disabled' : '' }} @endif>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Lampiran</label>
                                <div class="col-lg-9">
                                    <input type="file" class="form-control"
                                        @if (Gate::allows('sekretariat', Auth::user())) {{ $readonly ? 'enabled' : '' }}
                                                     @else
                                                     {{ $readonly ? 'disabled' : '' }} @endif
                                        name="lampiran" wire:model='form.lampiran'>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    @if (request()->routeIs('suratkeluar-verifikasi'))
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
                                        wire:model='formTindakLanjut.disposisi' {{ $readonly ? 'enabled' : '' }}>
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
                        <div class="form-group row">
                            <div class="col-lg-9">
                                @if (Gate::allows('sekretariat', Auth::user()))
                                    <button type="button" wire:click="distribusikan"
                                        class="btn btn-primary">Distribusikan</button>
                                @endif
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
