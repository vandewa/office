<div>
    <div class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Informasi Organisasi Perangkat Daerah</h3>
                        <div class="dropdown-divider"></div>
                    </div>
                    <div class="card-body">
                        <form wire:submit='save'>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <label class="col-form-label col-lg-12">Organisasi Perangkat Daerah<span
                                                    class="text-danger">*</span></label>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <input type="text" wire:model='namaOpd' class="form-control"
                                                        readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="col-form-label col-lg-12">Alamat<span
                                                    class="text-danger">*</span></label>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <textarea wire:model='form.alamat' rows="2" class="form-control"
                                                        placeholder="Contoh: Jalan Sabuk Alu Nomor 2A Wonosobo Jawa Tengah 56311"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                @error('form.alamat')
                                                    <div class="text-danger">
                                                        <i class="icon-cancel-circle2"></i>
                                                        <span><b>{{ $message }}</b></span>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="col-form-label col-lg-12">Website<span
                                                    class="text-danger">*</span></label>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <input type="text" wire:model='form.website' class="form-control"
                                                        placeholder="Contoh: diskominfo.wonosobokab.go.id">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                @error('form.website')
                                                    <div class="text-danger">
                                                        <i class="icon-cancel-circle2"></i>
                                                        <span><b>{{ $message }}</b></span>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="col-form-label col-lg-12">Email<span
                                                    class="text-danger">*</span></label>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <input type="text" wire:model='form.email' class="form-control"
                                                        placeholder="Contoh: diskominfo@wonosobokab.go.id">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                @error('form.email')
                                                    <div class="text-danger">
                                                        <i class="icon-cancel-circle2"></i>
                                                        <span><b>{{ $message }}</b></span>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="col-form-label col-lg-12">Telepon<span
                                                    class="text-danger">*</span></label>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <input type="text" wire:model='form.telepon' class="form-control"
                                                        placeholder="Contoh: (0286) 3225112">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                @error('form.telepon')
                                                    <div class="text-danger">
                                                        <i class="icon-cancel-circle2"></i>
                                                        <span><b>{{ $message }}</b></span>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="col-form-label col-lg-12">Faximile<span
                                                    class="text-danger">*</span></label>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <input type="text" wire:model='form.fax' class="form-control"
                                                        placeholder="Contoh: (0286) 3225112">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                @error('form.fax')
                                                    <div class="text-danger">
                                                        <i class="icon-cancel-circle2"></i>
                                                        <span><b>{{ $message }}</b></span>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Button Submit -->
                            <div class="text-right mt-3">
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary"><i class="mr-2 icon-paperplane"></i>
                                        Update
                                    </button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Pembebanan Anggaran Perjalanan
                            Dinas</h3>
                        <div class="dropdown-divider"></div>
                    </div>
                    <div class="card-body">
                        <form wire:submit='saveAnggaran'>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <label class="col-form-label col-lg-12">Akun<span
                                                    class="text-danger">*</span></label>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <input type="text" wire:model='form2.akun' class="form-control"
                                                        placeholder="Contoh: 2.16.2.20.2.21.01.000">
                                                    @error('form2.akun')
                                                        <div class="text-danger">
                                                            <i class="icon-cancel-circle2"></i>
                                                            <span><b>{{ $message }}</b></span>
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Button Submit -->
                            <div class="text-right mt-3">
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary"><i
                                            class="mr-2 icon-paperplane"></i>
                                        Update
                                    </button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

#
