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
                <div class="table-responsive">
                    <table class="table table-striped dataTable" id="DataTables_Table_0" role="grid"
                        aria-describedby="DataTables_Table_0_info">
                        <thead>
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
                            @foreach ($sppds as $sppd)
                                <tr wire:key='{{$sppd->id}}'>
                                    <td>{{ $loop->iteration + 0 }}</td>
                                    <td>{{ $sppd->tgl_berangkat }}</td>
                                    <td>{{ $sppd->nama }} </td>
                                    <td>{{ $sppd->maksud }} </td>
                                    <td>{{ $sppd->tempat_tujuan }} </td>
                                    <td>{{ $sppd->status }} </td>
                                    <td>
                                        <button
                                        type="button"
                                        wire:click="delete(' {{$sppd->id}}')"
                                        class="btn btn-warning btn-flat btn-sm"
                                        data-toggle="tooltip"
                                        data-placement="left"
                                        title="Edit"><i
                                            class="fas fa-pencil-alt"></i>
                                    </button>
                                    <button
                                    type="button"
                                    wire:click="getEdit(' {{$sppd->id}}')"
                                    class="btn btn-warning btn-flat btn-sm"
                                    data-toggle="tooltip"
                                    data-placement="left"
                                    title="Edit"><i
                                        class="fas fa-pencil-alt"></i>
                                </button>
                                    </td>
                                    {{-- <td class="text-center">
                                        <div class="list-icons">
                                            <div class="list-icons-item dropdown show">
                                                <a href="#" class="list-icons-item dropdown-toggle caret-0"
                                                    data-toggle="dropdown" aria-expanded="true"><i
                                                        class="icon-three-bars"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right hidden"
                                                    x-placement="bottom-end"
                                                    style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-164px, 16px, 0px);">
                                                    <a class="dropdown-item" wire:click="getEdit('{{$sppd->id}}')" ><i class="icon-pencil"></i>Edit</a>
                                                    <a class="dropdown-item" wire:click="delete(' {{$sppd->id}}')" ><i class="icon-trash"></i>Delete</a>
                                                    <a class="dropdown-item"><i class="icon-file-locked"></i>-</a>
                                                </div>
                                            </div>
                                        </div>
                                    </td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
