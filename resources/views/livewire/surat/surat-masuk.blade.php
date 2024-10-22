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
                                        <label>Pilih Tipe Surat Masuk</label><span class="text-danger">*</span>
                                        <select class="form-control" wire:model.live='form.surat_tp'>
                                            <option value="">-- Pilih --</option>

                                            @foreach ($tipeSurat as $list)
                                                <option value="{{ $list->com_cd }}">{{ $list->code_nm }}</option>
                                            @endforeach
                                        </select>
                                        @error('form.surat_tp')
                                            <div class="text-danger">
                                                <i class="icon-cancel-circle2"></i>
                                                <span><b>{{ $message }}</b></span>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            @if ($bukaForm)
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
                                                <input type="date" class="form-control"
                                                    wire:model="form.tanggal_surat">
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
                                                <input type="date" class="form-control"
                                                    wire:model="form.tanggal_terima">
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
                                                @error('form.opd_id')
                                                    <div class="text-danger">
                                                        <i class="icon-cancel-circle2"></i>
                                                        <span><b>{{ $message }}</b></span>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @if ($form['opd_id'] == '41')
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Nama Instansi:</label>
                                                <input type="text" class="form-control"
                                                    wire:model="form.nama_instansi"
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

                                    @if ($bukaFormAgenda)
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Tanggal Mulai<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="date" class="form-control"
                                                        wire:model="form.tanggal_mulai">

                                                </div>
                                                @error('form.tanggal_mulai')
                                                    <div class="text-danger">
                                                        <i class="icon-cancel-circle2"></i>
                                                        <span><b>{{ $message }}</b></span>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Tanggal Selesai<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="date" class="form-control"
                                                        wire:model="form.tanggal_selesai">

                                                </div>
                                                @error('form.tanggal_selesai')
                                                    <div class="text-danger">
                                                        <i class="icon-cancel-circle2"></i>
                                                        <span><b>{{ $message }}</b></span>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Jam Mulai<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="time" class="form-control"
                                                        wire:model="form.jam_mulai">
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
                                                    <input type="text" class="form-control"
                                                        wire:model="form.tempat"
                                                        placeholder="Masukkan Lokasi (Tempat)">
                                                </div>
                                                @error('form.tempat')
                                                    <div class="text-danger">
                                                        <i class="icon-cancel-circle2"></i>
                                                        <span><b>{{ $message }}</b></span>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Lampiran Surat<span class="text-danger">*
                                                    <span class="badge badge-danger form-text">format: .pdf | Max file:
                                                        2MB</span>
                                                </span></label>

                                            <div class="form-group-feedback form-group-feedback-right">
                                                <input type="file" wire:model.live='files' class="form-control"
                                                    accept="application/pdf">
                                                @error('files')
                                                    <div class="text-danger">
                                                        <i class="icon-cancel-circle2"></i>
                                                        <span><b>{{ $message }}</b></span>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Loading Animation Section -->
                                        <div wire:loading wire:target="files" class="loading-spinner">
                                            <div class="spinner"></div>
                                            <h5>Loading preview pdf...</h5>
                                        </div>

                                        <!-- PDF Preview Section -->
                                        @if ($lokasiFile)
                                            <object data="{{ asset($lokasiFile) }}" type="application/pdf"
                                                width="100%" height="400" style="border: solid 1px #ccc;">
                                            </object>
                                        @endif

                                        {{-- preview surat segment edit --}}
                                        @if ($form['path_surat'] && $edit)
                                            <object
                                                data="{{ route('helper.show-picture', ['path' => $form['path_surat']]) }}"
                                                type="application/pdf" width="100%" height="400"
                                                style="border: solid 1px #ccc;">
                                            </object>
                                        @endif

                                    </div>
                                </div>

                                <div class="d-flex justify-content-center mt-2">
                                    <button type="submit"
                                        class="btn btn-primary float-right btn-custom btn-lg btn-block">
                                        <i class="icon-paperplane"></i>
                                        {{ $edit ? 'Update' : 'Submit' }}
                                    </button>

                                    <div wire:loading wire:target="save">
                                        <div class="loading-state">
                                            <div class="loading"></div>
                                        </div>
                                    </div>

                                </div>
                            @endif

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

        /* Center and style the loading container */
        .loading-spinner {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            margin-top: 20px;
        }

        /* Spinner styles */
        .spinner {
            width: 40px;
            height: 40px;
            border: 4px solid rgba(0, 0, 0, 0.1);
            border-top-color: #007bff;
            /* Adjust color to your liking */
            border-radius: 50%;
            animation: spin 1s ease-in-out infinite;
        }

        /* Spinner animation */
        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* Text below spinner */
        .loading-spinner div {
            margin-top: 10px;
            font-size: 1rem;
            color: #007bff;
            /* Adjust color to match spinner */
        }

        .loading-state {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.3);
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .loading {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 10px solid #ddd;
            border-top-color: orange;
            animation: loading 1s linear infinite;
        }

        @keyframes loading {
            to {
                transform: rotate(360deg);
            }
        }
    </style>
@endpush
