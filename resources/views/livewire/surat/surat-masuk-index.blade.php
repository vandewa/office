<div>
    <x-slot name="header">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Home</span> -
                    Surat Masuk</h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                    <span class="breadcrumb-item active">Surat Masuk</span>
                </div>

                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
            <div class="header-elements d-none">
                <div class="breadcrumb justify-content-center">
                    <div class="btn-group">
                        <a class="btn btn-info mr-2" href="{{ route('front.agenda') }}" target="_blank">
                            <i class="icon-eye4 mr-1"></i>Agenda
                        </a>
                        <a class="btn btn-primary" href="{{ route('suratmasuk') }}">
                            <i class="icon-plus22 mr-1"></i>Add Data
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="content">
        <div class="card">
            <div class="card-body">
                {{-- <div class="table-responsive mb-2"> --}}
                <div class="mb-2">
                    <table class="table table-striped">
                        <thead>
                            <tr role="row">
                                <th class="text-left">No</th>
                                <th>Tipe</th>
                                <th>Disposisi</th>
                                <th>Subject</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($data as $list)
                                <tr wire:key="{{ $list->id }}">
                                    <td>{{ $list->nomor_agenda ?? '' }}</td>
                                    <td>
                                        @if ($list->surat_tp == 'SURAT_TP_01')
                                            <span class="badge badge-dark">Agenda</span>
                                        @elseif($list->surat_tp == 'SURAT_TP_02')
                                            <span class="badge badge-light">Non Agenda</span>
                                        @endif
                                    </td>
                                    <td>{{ $list->tempat_tujuan }}</td>
                                    <td>{{ $list->perihal ?? '' }}</td>
                                    <td>{{ $list->perihal }}</td>
                                    <td>
                                        <div class="btn-group ml-1">
                                            <button type="button"
                                                class="btn alpha-purple text-purple-800 btn-icon dropdown-toggle"
                                                data-toggle="dropdown">
                                                <i class="icon-menu7"></i>
                                            </button>

                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="{{ route('suratmasuk', ['id' => $list->id]) }}"
                                                    class="dropdown-item">
                                                    <i class="icon-pencil3 mr-3"></i>
                                                    Edit
                                                </a>

                                                <button wire:click="delete('{{ $list->id }}')"
                                                    class="dropdown-item">
                                                    <i class="icon-trash-alt mr-3"></i>
                                                    Hapus
                                                </button>

                                                <div class="dropdown-divider"></div>

                                                <a href="{{ route('disposisi', ['id' => $list->id]) }}"
                                                    class="dropdown-item">
                                                    <i class="icon-user mr-3"></i>
                                                    Disposisi
                                                </a>

                                                <a href="{{ route('laporan-sppd', $list->id) }}" class="dropdown-item">
                                                    <i class="icon-menu6 mr-3"></i>
                                                    Isi Laporan
                                                </a>

                                            </div>
                                        </div>


                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    {{ $data->links() }}
                </div>

            </div>
        </div>
    </div>
</div>
