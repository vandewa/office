<div>
    <x-slot name="header">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Home</span> -
                    SPPD</h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                    <span class="breadcrumb-item active">SPPD</span>
                </div>

                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
            <div class="header-elements d-none">
                <div class="breadcrumb justify-content-center">
                    <div class="p-0 breadcrumb-elements-item dropdown">
                        <a href="{{ route('sppd') }}" class="btn btn-primary">
                            <i class="mr-2 icon-file-plus"></i>
                            Add Data
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="content">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-8">

                    </div>
                    <div class="col-md-4">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Cari" wire:model.live='cari'>
                            <span class="input-group-text"><i class="icon-search4"></i></span>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped dataTable" id="DataTables_Table_0" role="grid"
                        aria-describedby="DataTables_Table_0_info">
                        <tr role="row">
                            <th class="text-left" style="width: 17px;" aria-label="No">No</th>
                            <th style="width: 150px;" aria-label="Tanggal">Tanggal</th>
                            <th style="width: 222px;" aria-label="Nama">Nama</th>
                            <th style="width: 310px;" aria-label="Subject">Subject</th>
                            <th style="width: 191px;" aria-label="Tujuan">Tujuan</th>
                            <th style="width: 222px;" aria-label="Laporan">Status Laporan</th>
                            <th style="width: 176px;" aria-label="Aksi">Aksi</th>
                        </tr>
                        </thead>

                        <tbody>
                            @foreach ($data as $sppd)
                                <tr wire:key='{{ $sppd->id }}'>
                                    <td>{{ $loop->index + $data->firstItem() }}</td>
                                    <td>{{ $sppd->tgl_berangkat }}</td>
                                    <td>
                                        @foreach ($sppd->sppdPegawais as $sppdPegawai)
                                            {{ $sppdPegawai->tb01->nama }} <br>
                                        @endforeach
                                    </td>
                                    <td>{{ $sppd->maksud }}</td>
                                    <td>{{ $sppd->tempat_tujuan }}</td>
                                    <td>{{ $sppd->status }}</td>
                                    <td>
                                        <button type="button" wire:click="delete('{{ $sppd->id }}')"
                                            class="btn btn-flat btn-sm" data-toggle="tooltip" data-placement="left"
                                            title="Delete">
                                            <i class="icon-trash"></i>
                                        </button>
                                        <a href="{{ route('sppd', ['id' => $sppd->id]) }}" class="btn btn-flat btn-sm">
                                            <i class="icon-pencil"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>


                    </table>
                    {{ $data->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
</div>
