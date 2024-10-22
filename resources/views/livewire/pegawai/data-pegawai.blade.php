<div>
    <x-slot name="header">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="mr-2 icon-arrow-left52"></i> <span class="font-weight-semibold">Home</span> -
                    Data Pegawai</h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="index.html" class="breadcrumb-item"><i class="mr-2 icon-home2"></i> Home</a>
                    <span class="breadcrumb-item active">Data Pegawai</span>
                </div>

                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>
    </x-slot>
    <div class="content">
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">List Pegawai <b>{{ $skpd->skpd }}</b> Kabupaten Wonosobo</h5>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>NIP</th>
                            <th>Pangkat, Gol.Ruang</th>
                            <th>Jabatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tb01 as $list)
                            <tr>
                                <td>{{ $loop->iteration + 0 }}</td>
                                <td>
                                    @if ($list->gdb)
                                        {{ $list->gdp . ' ' . $list->nama . ', ' . $list->gdb }}
                                    @else
                                        {{ $list->gdp . ' ' . $list->nama }}
                                    @endif
                                </td>
                                <td>{{ $list->nip ?? '' }}</td>
                                <td>{{ $list->pangkat . ', ' . $list->golru }}</td>
                                <td>{{ $list->jabatan ?? '' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
