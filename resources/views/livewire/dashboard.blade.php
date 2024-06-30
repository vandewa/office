<div>
    <div class="content">
        <div class="row">
            @can('sekretariat')
                <div class="col-lg-4">
                    <a href="{{ route('suratmasuk') }}">
                        <div class="card" style="height: 200px; background-color: #B0B4ED;">
                            <div class="card-body">
                                <div class="d-flex">
                                    <h3 class="font-weight-semibold mb-0" style="color: #FFFFFF;">Buat Surat Masuk</h3>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4">
                    <a href="{{ route('suratkeluar') }}">
                        <div class="card" style="height: 200px; background-color: #8288E3;">
                            <div class="card-body">
                                <div class="d-flex">
                                    <h3 class="font-weight-semibold mb-0" style="color: #FFFFFF;">Buat Surat Keluar</h3>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endcan
            <div class="col-lg-4">
                <a href="{{ route('sppd') }}">
                    <div class="card" style="height: 200px; background-color: #676EDC;">
                        <div class="card-body">
                            <div class="d-flex">
                                <h3 class="font-weight-semibold mb-0" style="color: #FFFFFF;">Buat SPPD</h3>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h1>Surat Masuk Untuk Anda</h1>
            </div>
            <div class="dropdown-divider"></div>
            <div class="card-body">
                <div class="row">
                    <div class="col-8">
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped dataTable" id="DataTables_Table_0" role="grid"
                        aria-describedby="DataTables_Table_0_info">
                        <thead>
                            <tr role="row">
                                <th class="text-left" style="width: 17px;" aria-label="No">Nomor Agenda</th>
                                <th style="width: 150px;" aria-label="Tanggal">Tanggal</th>
                                <th style="width: 222px;" aria-label="Jenis">Jenis</th>
                                <th style="width: 310px;" aria-label="Disposisi">Disposisi</th>
                                <th style="width: 191px;" aria-label="Subject">Subject</th>
                                <th style="width: 222px;" aria-label="Keterangan">Keterangan</th>
                                @can('view-status-surat')
                                    <th style="width: 222px;" aria-label="Keterangan">Status Surat</th>
                                @endcan
                                <th style="width: 176px;" aria-label="Aksi">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($suratMasuk as $index => $suratmasuk)
                                <tr wire:key='{{ $suratmasuk->id }}'>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $suratmasuk->tgl_surat }}</td>
                                    <td>{{ $suratmasuk->jenis_agenda_tp }}</td>
                                    <td>
                                        @foreach ($suratmasuk->tindakLanjuts as $tindakLanjut)
                                            <span class="badge bg-purple">{{ $tindakLanjut->diteruskan_kepada }}</span>
                                            <span class="badge bg-blue">{{ $tindakLanjut->disposisi }}</span>
                                        @endforeach
                                    </td>
                                    <td>{{ $suratmasuk->acara }} {{ $suratmasuk->perihal }}</td>
                                    <td>
                                        @foreach ($suratmasuk->tindakLanjuts as $tindakLanjut)
                                            {{ $tindakLanjut->deskripsi }}
                                        @endforeach
                                    </td>
                                    <td>
                                        @can('view-status-surat')
                                            @foreach ($suratmasuk->statusSurats as $statusSurat)
                                                <span class="badge bg-danger">{{ $statusSurat->status_surat }}</span>
                                            @endforeach
                                        @endcan
                                    </td>
                                    <td>
                                        @can('sekretariat')
                                            <button type="button" wire:click="delete('{{ $suratmasuk->id }}')"
                                                class="btn btn-flat btn-sm" data-toggle="tooltip" data-placement="left"
                                                title="Edit">
                                                <i class="icon-trash"></i>
                                            </button>
                                            <a href="{{ route('suratmasuk', ['id' => $suratmasuk->id]) }}"
                                                class="btn btn-flat btn-sm">
                                                <i class="icon-add"></i>
                                            </a>
                                        @endcan
                                        <a href="{{ route('suratmasuk-disposisi', ['id' => $suratmasuk->id]) }}"
                                            class="btn btn-flat btn-sm">
                                            <i class="icon-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>

                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="card">
            <div class="card-header">
                <h1>Surat Keluar Untuk Anda</h1>
            </div>
            <div class="dropdown-divider"></div>
            <div class="card-body">
                <div class="row">
                    <div class="col-8">
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped dataTable" id="DataTables_Table_0" role="grid"
                        aria-describedby="DataTables_Table_0_info">
                        <thead>
                            <tr role="row">
                                <th class="text-left" style="width: 17px;" aria-label="No">Nomor Agenda</th>
                                <th style="width: 150px;" aria-label="Tanggal">Tanggal</th>
                                <th style="width: 222px;" aria-label="Jenis">Jenis</th>
                                <th style="width: 310px;" aria-label="Disposisi">Disposisi</th>
                                <th style="width: 191px;" aria-label="Subject">Subject</th>
                                <th style="width: 222px;" aria-label="Keterangan">Keterangan</th>
                                @can('view-status-surat')
                                    <th style="width: 222px;" aria-label="Keterangan">Status Surat</th>
                                @endcan
                                <th style="width: 176px;" aria-label="Aksi">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($suratKeluar as $index => $suratkeluar)
                                <tr wire:key='{{ $suratkeluar->id }}'>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $suratkeluar->tgl_surat }}</td>
                                    <td>{{ $suratkeluar->jenis_agenda_tp }}</td>
                                    <td>
                                        @foreach ($suratkeluar->tindakLanjuts as $tindakLanjut)
                                            <span class="badge bg-purple">{{ $tindakLanjut->diteruskan_kepada }}</span>
                                            <span class="badge bg-blue">{{ $tindakLanjut->disposisi }}</span>
                                        @endforeach
                                    </td>
                                    <td> {{ $suratkeluar->perihal }}</td>
                                    <td>
                                        @foreach ($suratkeluar->tindakLanjuts as $tindakLanjut)
                                            {{ $tindakLanjut->deskripsi }}
                                        @endforeach
                                    </td>
                                    <td>
                                        @can('view-status-surat')
                                            @foreach ($suratkeluar->statusSurats as $statusSurat)
                                                <span class="badge bg-danger">{{ $statusSurat->status_surat }}</span>
                                            @endforeach
                                        @endcan
                                    </td>
                                    <td>
                                        @can('sekretariat')
                                            <button type="button" wire:click="delete('{{ $suratkeluar->id }}')"
                                                class="btn btn-flat btn-sm" data-toggle="tooltip" data-placement="left"
                                                title="Edit">
                                                <i class="icon-trash"></i>
                                            </button>
                                            <a href="{{ route('suratkeluar', ['id' => $suratkeluar->id]) }}"
                                                class="btn btn-flat btn-sm">
                                                <i class="icon-add"></i>
                                            </a>
                                        @endcan
                                        <a href="{{ route('suratkeluar-verifikasi', ['id' => $suratkeluar->id]) }}"
                                            class="btn btn-flat btn-sm">
                                            <i class="icon-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
