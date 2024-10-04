<div>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Surat Masuk</h3>
                        <div class="dropdown-divider"></div>
                    </div>

                    <div class="card-body">
                        <form wire:submit='save'>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Kode (Lama)</label>
                                        <input type="text" class="form-control" wire:model="form.kode_lama"
                                            placeholder="Masukkan Kode (lama)" autofocus>
                                        @error('form.kode_lama')
                                            <div class="text-danger">
                                                <i class="icon-cancel-circle2"></i>
                                                <span><b>{{ $message }}</b></span>
                                            </div>
                                        @enderror
                                    </div>

                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Kode (Baru)</label>
                                        <input type="text" class="form-control" wire:model="form.kode_baru"
                                            placeholder="Masukkan Kode (baru)">
                                        @error('form.kode_baru')
                                            <div class="text-danger">
                                                <i class="icon-cancel-circle2"></i>
                                                <span><b>{{ $message }}</b></span>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Nomor Surat</label><span class="text-danger">*</span>
                                        <input type="text" class="form-control" wire:model="form.nomor_surat"
                                            placeholder="Cth: 520.23/416/Bappeda">
                                        @error('form.nomor_surat')
                                            <div class="text-danger">
                                                <i class="icon-cancel-circle2"></i>
                                                <span><b>{{ $message }}</b></span>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Tanggal Surat<span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="date" class="form-control" wire:model="form.tanggal_surat">
                                            @error('form.tanggal_surat')
                                                <div class="text-danger">
                                                    <i class="icon-cancel-circle2"></i>
                                                    <span><b>{{ $message }}</b></span>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Tanggal Terima<span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="date" class="form-control" wire:model="form.tanggal_terima">
                                            @error('form.tanggal_terima')
                                                <div class="text-danger">
                                                    <i class="icon-cancel-circle2"></i>
                                                    <span><b>{{ $message }}</b></span>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Pengirim<span class="text-danger">*</span></label>
                                        <div class="input-group ">
                                            <p class="form-control">{{ $opd->nama_opd ?? '' }}</p>
                                            <span class="input-group-append">
                                                <button type="button" class="btn btn-info btn-flat"
                                                    wire:click="$dispatch('show-modal-opd')">Pilih</button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if ($form['opd_id'] == '41')
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Nama Instansi:</label>
                                            <input type="text" class="form-control" wire:model="form.nama_instansi"
                                                placeholder="Masukkan Nama Instansi">
                                            @error('form.nama_instansi')
                                                <div class="text-danger">
                                                    <i class="icon-cancel-circle2"></i>
                                                    <span><b>{{ $message }}</b></span>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Perihal<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" wire:model="form.perihal"
                                            placeholder="Masukkan Perihal (Subject)">
                                        @error('form.perihal')
                                            <div class="text-danger">
                                                <i class="icon-cancel-circle2"></i>
                                                <span><b>{{ $message }}</b></span>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Tanggal Mulai<span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="date" class="form-control" wire:model="form.tanggal_mulai">
                                            @error('form.tanggal_mulai')
                                                <div class="text-danger">
                                                    <i class="icon-cancel-circle2"></i>
                                                    <span><b>{{ $message }}</b></span>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Tanggal Selesai<span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="date" class="form-control"
                                                wire:model="form.tanggal_selesai">
                                            @error('form.tanggal_selesai')
                                                <div class="text-danger">
                                                    <i class="icon-cancel-circle2"></i>
                                                    <span><b>{{ $message }}</b></span>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Jam Mulai<span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="time" class="form-control" wire:model="form.jam_mulai">
                                            <span class="input-group-prepend">
                                                <span class="input-group-text">WIB</span>
                                            </span>
                                            @error('form.jam_mulai')
                                                <div class="text-danger">
                                                    <i class="icon-cancel-circle2"></i>
                                                    <span><b>{{ $message }}</b></span>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Tempat<span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" wire:model="form.tempat"
                                                placeholder="Masukkan Lokasi (Tempat)">
                                            @error('form.tempat')
                                                <div class="text-danger">
                                                    <i class="icon-cancel-circle2"></i>
                                                    <span><b>{{ $message }}</b></span>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Lampiran Surat<span class="text-danger">* <span
                                                    class="badge  badge-danger form-text">format : .pdf | Max file:
                                                    2MB</span>
                                            </span></label>
                                        <div class="form-group-feedback form-group-feedback-right">
                                            <input type="file" name="surat" class="form-control"
                                                accept="application/pdf">
                                            {{-- @error('form.jam_mulai')
                                                <div class="text-danger">
                                                    <i class="icon-cancel-circle2"></i>
                                                    <span><b>{{ $message }}</b></span>
                                                </div>
                                            @enderror --}}
                                        </div>
                                    </div>

                                    <object data="https://pii.or.id/uploads/dummies.pdf" type="application/pdf"
                                        width="100%" height="400" style="border: solid 1px #ccc;"></object>

                                </div>
                            </div>

                            <div class="d-flex justify-content-center mt-2">
                                <button type="submit"
                                    class="btn btn-primary float-right btn-custom btn-lg btn-block">
                                    <i class="icon-paperplane"></i> Submit
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <livewire:component.modal-opd wire:key='modal-opd'>
</div>

@push('css')
    <style>
        .margin {
            margin-bottom: 0.2rem
        }

        .btn-custom {
            background-color: #007bff;
            border: none;
            color: white;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            transition: background-color 0.3s, transform 0.3s;
        }

        .btn-custom:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        .btn-custom i {
            margin-right: 5px;
        }
    </style>
@endpush
