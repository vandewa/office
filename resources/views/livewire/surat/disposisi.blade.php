<div>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-sm-6">

                        <!-- Left aligned -->
                        <div class="card card-body border-top-teal">
                            <h5 class="text-center">Disposisi</h5>
                            <hr>

                            <form wire:submit='save'>
                                <div class="row">
                                    <div class="col-md-12">
                                        <!-- Nama Pegawai -->
                                        <div class="form-group margin">
                                            <label for="nama" class="col-form-label col-lg-12">Disposisi<span
                                                    class="text-danger">*</span></label>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <div wire:ignore>
                                                        <select class="form-control select-search-kusus"
                                                            wire:model='disposisi' multiple>
                                                            @foreach ($pegawai as $nip => $namaOption)
                                                                <option value="{{ $nip }}">
                                                                    {{ $namaOption }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                @error('disposisi')
                                                    <div class="text-danger">
                                                        <i class="icon-cancel-circle2"></i>
                                                        <span><b>{{ $message }}</b></span>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group margin">
                                            <label for="nama" class="col-form-label col-lg-12">CC</label>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <div wire:ignore>
                                                        <select class="form-control select-search-kusus2"
                                                            wire:model='cc' multiple>
                                                            @foreach ($pegawai as $nip => $namaOption)
                                                                <option value="{{ $nip }}">
                                                                    {{ $namaOption }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                @error('cc')
                                                    <div class="text-danger">
                                                        <i class="icon-cancel-circle2"></i>
                                                        <span><b>{{ $message }}</b></span>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Nama Pegawai -->
                                        <div class="form-group margin">
                                            <label for="nama" class="col-form-label col-lg-12">Keterangan<span
                                                    class="text-danger">*</span></label>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <textarea rows="2" class="form-control" wire:model='form.keterangan'></textarea>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                @error('form.keterangan')
                                                    <div class="text-danger">
                                                        <i class="icon-cancel-circle2"></i>
                                                        <span><b>{{ $message }}</b></span>
                                                    </div>
                                                @enderror
                                            </div>

                                        </div>

                                        <div class="container mt-2">
                                            <button class="btn btn-block btn-info" type="submit">
                                                <i class="mr-1 icon-paperplane"></i>
                                                Submit
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <div class="card-body">
                                <div class="table-responsive mb-2">
                                    {{-- jika ada disposisi --}}
                                    @if (count($cekPegawaiDisposisi))
                                        <table class="table table-striped mb-4">
                                            <h5><u>Disposisi</u></h5>
                                            <thead>
                                                <tr role="row">
                                                    <th>Nama</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @foreach ($cekPegawaiDisposisi as $list)
                                                    <tr>
                                                        <td>
                                                            @if ($list->gdb)
                                                                {{ $list->gdp . ' ' . $list->nama . ', ' . $list->gdb }}
                                                            @else
                                                                {{ $list->gdp . ' ' . $list->nama }}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a wire:click="delete('{{ $list->disposisi_id }}')">
                                                                <i class="icon-trash" style="color:red;"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach

                                            </tbody>

                                        </table>
                                    @endif

                                    @if (count($cekPegawaiCc))
                                        <table class="table table-striped">
                                            <h5><u>Carbon Copy (CC)</u></h5>
                                            <thead>
                                                <tr role="row">
                                                    <th>Nama</th>
                                                    <th></th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @foreach ($cekPegawaiCc as $list)
                                                    <tr>
                                                        <td>
                                                            @if ($list->gdb)
                                                                {{ $list->gdp . ' ' . $list->nama . ', ' . $list->gdb }}
                                                            @else
                                                                {{ $list->gdp . ' ' . $list->nama }}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a wire:click="delete('{{ $list->disposisi_id }}')">
                                                                <i class="icon-trash" style="color:red;"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach

                                            </tbody>

                                        </table>
                                    @endif

                                </div>

                                @if ($keterangan)
                                    <div class="card-footer">
                                        <span class="badge bg-teal-400 mr-2">Keterangan</span>
                                        {{ $keterangan }}
                                    </div>
                                @endif
                            </div>

                        </div>
                        <!-- /left aligned -->


                    </div>

                    <div class="col-sm-6">
                        <!-- Bottom aligned -->
                        <div class="card card-body border-top-teal">
                            <h5>Log Surat Masuk</h5>
                            <div class="list-feed">
                                @foreach ($logSurat->disposisi as $list)
                                    <div class="list-feed-item">
                                        <a href="#">
                                            @if ($list->dari->gdb)
                                                {{ $list->dari->gdp . ' ' . $list->dari->nama . ', ' . $list->dari->gdb }}
                                            @else
                                                {{ $list->dari->gdp . ' ' . $list->dari->nama }}
                                            @endif
                                        </a>
                                        <br>
                                        <a href="#">
                                            @if ($list->untuk->gdb)
                                                {{ $list->untuk->gdp . ' ' . $list->untuk->nama . ', ' . $list->untuk->gdb }}
                                            @else
                                                {{ $list->untuk->gdp . ' ' . $list->untuk->nama }}
                                            @endif
                                        </a>

                                        <span class="badge badge-dark">
                                            Disposisi
                                        </span>


                                        <div class="text-muted">
                                            {{ Carbon\Carbon::parse($list->created_at)->isoFormat('LLLL') }} WIB
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- /bottom aligned -->

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@script
    <script>
        $('.select-search-kusus').select2();
        $('.select-search-kusus2').select2();

        $('.select-search-kusus').change(function() {
            let nilai = $(this).val();
            $wire.set('disposisi', nilai);
        });

        $('.select-search-kusus2').change(function() {
            let nilai = $(this).val();
            $wire.set('cc', nilai);
        });

        setTimeout(function() {
            $('.select-search-kusus').trigger('change');
        }, 500); // 500 milliseconds delay

        setTimeout(function() {
            $('.select-search-kusus2').trigger('change');
        }, 500); // 500 milliseconds delay

        $wire.on('update-pegawai', () => {
            console.log($wire.disposisi);
        });
    </script>
@endscript


@push('css')
    <style>
        .margin {
            margin-bottom: 0.1rem
        }
    </style>
@endpush