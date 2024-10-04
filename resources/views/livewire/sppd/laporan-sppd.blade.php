<div>
    <div class="content">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <h3>Laporan Perjalanan Dinas</h3>
                    <div class="dropdown-divider"></div>
                </div>
                <div class="card-body">
                    <form wire:submit='save'>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label class="col-form-label  col-lg-12">Hasil Laporan<span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <textarea class="form-control" rows="7" wire:model='form.laporan'></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            @error('form.laporan')
                                                <div class="text-danger">
                                                    <i class="icon-cancel-circle2"></i>
                                                    <span><b>{{ $message }}</b></span>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="col-form-label  col-lg-12">Tanggal<span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <input class="form-control daterange-single" wire:model='form.tanggal'
                                                    type="date">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            @error('form.tanggal')
                                                <div class="text-danger">
                                                    <i class="icon-cancel-circle2"></i>
                                                    <span><b>{{ $message }}</b></span>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="created_by" class="col-form-label col-lg-12">Created By<span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-12">
                                            <select id="created_by" class="form-control select-search-kusus"
                                                wire:ignore>
                                                <option value="">Pilih Pegawai</option>
                                                @foreach ($nama as $nip => $namaOption)
                                                    @if ($edit)
                                                        <option value="{{ $nip }}"
                                                            {{ $nip == $form['nip'] ? 'selected' : '' }}>
                                                            {{ $namaOption }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $nip }}"
                                                            {{ $nip == auth()->user()->nip ? 'selected' : '' }}>
                                                            {{ $namaOption }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @error('form.nip')
                                                <div class="text-danger mt-1">
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
                                <a href="{{ route('sppd-index') }}" class="btn bg-grey-400 float-left"
                                    wire:click='batal'><i class="mr-2 icon-square-left"></i>Kembali
                                </a>
                                <button type="submit" class="btn btn-primary"><i class="mr-2 icon-paperplane"></i>
                                    Submit
                                </button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@script
    <script>
        $('.select-search-kusus').change(function() {
            let nilai = $(this).val();
            $wire.set('form.nip', nilai);
        });

        setTimeout(function() {
            $('.select-search-kusus').trigger('change');
        }, 500); // 500 milliseconds delay

        $wire.on('update-pegawai', () => {
            console.log($wire.formNama);
        });
    </script>
@endscript
