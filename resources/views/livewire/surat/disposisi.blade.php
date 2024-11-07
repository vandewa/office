<div>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-sm-6">

                        <!-- Left aligned -->
                        <div class="card card-body border-top-teal">

                            <div class="col-lg-12">
                                <div id="pdf-container" wire:ignore>
                                    <div id="loadingIndicator">Loading...</div>
                                </div>

                                <div class="mt-3">
                                    <span>
                                        Apakah Anda ingin mendisposisikan surat?
                                    </span>
                                </div>

                                <div wire:ignore>
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="status" value="1"
                                                wire:model.live='statusDisposisi'>
                                            Ya
                                        </label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="status" value="0"
                                                wire:model.live='statusDisposisi'>
                                            Tidak
                                        </label>
                                    </div>
                                </div>
                            </div>


                            @if ($statusDisposisi)
                                <div>
                                    <form wire:submit='save'>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <!-- Nama Pegawai -->
                                                <div class="form-group margin">
                                                    <label for="nama"
                                                        class="col-form-label col-lg-12">Disposisi<span
                                                            class="text-danger">*</span></label>
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <div wire:ignore>
                                                                <select class="form-control select-search"
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
                                                                <select class="form-control select-search"
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
                                                    <label for="nama"
                                                        class="col-form-label col-lg-12">Keterangan<span
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
                                </div>
                            @endif

                            <div class="card-body">
                                <div class="table-responsive mb-2">
                                    {{-- jika ada disposisi --}}
                                    @if (count($cekPegawaiDisposisi))
                                        <table class="table table-striped mb-4">
                                            <thead>
                                                <tr role="row">
                                                    <th>Disposisi</th>
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
                                            <thead>
                                                <tr role="row">
                                                    <th>Carbon Copy (CC)</th>
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
                                    @if ($keterangan->keterangan)
                                        <div class="card-footer">
                                            <span class="badge bg-teal-400 mr-2">Keterangan</span>
                                            <span class="badge bg-dark mr-2">
                                                @if ($keterangan->dari->gdb)
                                                    {{ $keterangan->dari->gdp . ' ' . $keterangan->dari->nama . ', ' . $keterangan->dari->gdb }}
                                                @else
                                                    {{ $keterangan->dari->gdp . ' ' . $keterangan->dari->nama }}
                                                @endif
                                            </span>
                                            {{ $keterangan->keterangan }}
                                        </div>
                                    @endif
                                @endif
                            </div>

                        </div>
                        <!-- /left aligned -->


                    </div>

                    <div class="col-sm-6">
                        <!-- Bottom aligned -->
                        <div>
                            <div class="card card-body border-top-teal">
                                <div class="table-responsive mb-2">
                                    {{-- jika ada disposisi --}}
                                    @if (count($cekPegawaiDisposisi))
                                        <h5>Disposisi</h5>

                                        <ul>
                                            @foreach ($cekPegawaiDisposisi as $list)
                                                <li>
                                                    {{ $list->gdp ? $list->gdp . ' ' : '' }}
                                                    {{ $list->nama }}
                                                    {{ $list->gdb ? ', ' . $list->gdb : '' }}
                                                </li>
                                            @endforeach
                                        </ul>

                                    @endif
                                </div>
                            </div>

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
                                                {{ $list->tipe->code_value }}
                                            </span>

                                            <div class="text-muted">
                                                {{ Carbon\Carbon::parse($list->created_at)->isoFormat('LLLL') }} WIB
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
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
        document.addEventListener('livewire:init', function() {
            // Initialize Select2 when Livewire is ready
            initializeSelect2();

            // Re-initialize Select2 after every Livewire message is processed
            Livewire.hook('message.processed', (message, component) => {
                initializeSelect2();
            });
        });

        function initializeSelect2() {
            // Destroy existing instances before initializing again to prevent duplicates
            $('.select-search-kusus').select2().off('change');
            $('.select-search-kusus2').select2().off('change');

            $('.select-search-kusus').select2();
            $('.select-search-kusus2').select2();

            $('.select-search-kusus').on('change', function() {
                let nilai = $(this).val();
                Livewire.emit('updateSelect', 'disposisi', nilai);
            });

            $('.select-search-kusus2').on('change', function() {
                let nilai = $(this).val();
                Livewire.emit('updateSelect', 'cc', nilai);
            });
        }

        Livewire.on('update-pegawai', () => {
            console.log('Selected Pegawai: ', Livewire.get('disposisi'));
        });
    </script>
@endscript


@push('css')
    <link href="{{ asset('costum/loading.css') }}" rel="stylesheet" type="text/css">
    <style>
        .margin {
            margin-bottom: 0.1rem
        }

        #pdf-container {
            overflow-y: auto;
            max-height: 600px;
            width: 100%;
            position: relative;
            /* Required for absolute positioning of the loading indicator */
            border: 1px solid #ddd;
            /* Optional: To visualize the scrollable area */
        }

        #loadingIndicator {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 18px;
            color: #333;
            display: none;
            /* Hidden by default, shown only when loading */
            z-index: 10;
            /* Ensure it overlays on top of PDF content */
        }
    </style>
@endpush

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.min.js"></script>
    <script src="{{ asset('costum/pdfviewer.js') }}"></script>
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('surat', (event) => {
                var path = event[0].path;
                pdfViewerFunction(path);
            });
        });
    </script>
@endpush
