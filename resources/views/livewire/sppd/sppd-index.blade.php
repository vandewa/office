<div>
    <x-slot name="header">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Home</span> -
                    Perjalanan Dinas</h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                    <span class="breadcrumb-item active">Perjalanan Dinas</span>
                </div>

                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
            <div class="header-elements d-none">
                <div class="breadcrumb justify-content-center">
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"> <i
                                class="icon-plus22 mr-1"></i>Add Data
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="{{ route('sppd') }}" class="dropdown-item">Non Kepala</a>
                            <a href="{{ route('sppd-kepala') }}" class="dropdown-item">Kepala</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="content">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive mb-2">
                    <table class="table table-striped dataTable" id="DataTables_Table_0" role="grid"
                        aria-describedby="DataTables_Table_0_info">
                        <thead>
                            <tr role="row">
                                <th class="text-left">No</th>
                                <th>Tanggal</th>
                                <th>Pegawai</th>
                                <th>Subject</th>
                                <th>Tujuan</th>
                                <th>Laporan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($sppds as $list)
                                <tr wire:key="{{ $list->id }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @php
                                            if ($list->tgl_berangkat == $list->tgl_kembali) {
                                                $tanggal = \Carbon\Carbon::createFromFormat(
                                                    'Y-m-d',
                                                    $list->tgl_berangkat,
                                                )->isoFormat('D MMMM Y');
                                            } else {
                                                $tanggal =
                                                    \Carbon\Carbon::createFromFormat(
                                                        'Y-m-d',
                                                        $list->tgl_berangkat,
                                                    )->isoFormat('D MMMM') .
                                                    ' - ' .
                                                    \Carbon\Carbon::createFromFormat(
                                                        'Y-m-d',
                                                        $list->tgl_kembali,
                                                    )->isoFormat('D MMMM Y');
                                            }
                                        @endphp

                                        <span>{{ $tanggal }}</span>
                                    </td>
                                    <td>
                                        <ul>
                                            @foreach ($list->pegawai as $item)
                                                <li>
                                                    {{ $item->user->gdp ? $item->user->gdp . ' ' : '' }}
                                                    {{ $item->user->nama }}
                                                    {{ $item->user->gdb ? ', ' . $item->user->gdb : '' }}
                                                </li>
                                            @endforeach
                                        </ul>
                                        {{-- 
                                        @foreach ($list->pegawai as $item)
                                            <label class="badge badge-secondary" style="font-size:10px;">
                                                {{ $item->user->gdp ? $item->user->gdp . ' ' : '' }}
                                                {{ $item->user->nama }}
                                                {{ $item->user->gdb ? ', ' . $item->user->gdb : '' }}
                                            </label>
                                        @endforeach --}}
                                    </td>
                                    <td>{{ $list->maksud ?? '' }}</td>
                                    <td>{{ $list->tempat_tujuan ?? '' }}</td>
                                    <td>{{ $list->status }}
                                        @if ($list->laporannya)
                                            <i class="icon-checkmark-circle" style="color: green;"></i>
                                        @else
                                            <i class="icon-cancel-circle2" style="color: red;"></i>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group ml-1">
                                            <button type="button"
                                                class="btn alpha-purple text-purple-800 btn-icon dropdown-toggle"
                                                data-toggle="dropdown">
                                                <i class="icon-menu7"></i>
                                            </button>

                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="{{ route('sppd', ['id' => $list->id]) }}"
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

                                                <a href="{{ route('laporan-sppd', $list->id) }}" class="dropdown-item">
                                                    <i class="icon-menu6 mr-3"></i>
                                                    Isi Laporan
                                                </a>

                                                {{-- cek jika sudah isi laporan --}}
                                                @if ($list->laporannya)
                                                    <a href="{{ route('cetak-laporan-sppd', $list->id) }}"
                                                        class="dropdown-item">
                                                        <i class="icon-printer2"></i>Laporan Perjalanan Dinas
                                                    </a>
                                                @endif

                                                {{-- cek kepala atau bukan sptnya --}}
                                                @if ($list->pegawai->contains('user.nip', $kepala))
                                                    <a href="{{ route('cetak-spt-kepala', $list->id) }}"
                                                        class="dropdown-item">
                                                        <i class="icon-printer2"></i>Surat Perintah Tugas
                                                    </a>
                                                @else
                                                    <a href="{{ route('cetak-spt', $list->id) }}"
                                                        class="dropdown-item">
                                                        <i class="icon-printer2"></i>Surat Perintah Tugas
                                                    </a>
                                                @endif

                                                {{-- sppd perorangan --}}
                                                @foreach ($list->pegawai as $item)
                                                    @if ($item->user->nip == $kepala)
                                                        <a href="{{ route('cetak-sppd-kepala', ['parameter1' => $list->id, 'parameter2' => $item->user->nip]) }}"
                                                            class="dropdown-item">
                                                            <i class="icon-printer2"></i>SPPD {{ $item->user->nama }}
                                                        </a>
                                                    @else
                                                        <a href="{{ route('cetak-sppd', ['parameter1' => $list->id, 'parameter2' => $item->user->nip]) }}"
                                                            class="dropdown-item">
                                                            <i class="icon-printer2"></i>SPPD {{ $item->user->nama }}
                                                        </a>
                                                    @endif
                                                @endforeach

                                            </div>
                                        </div>


                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    {{ $sppds->links() }}
                </div>

            </div>
        </div>
    </div>
</div>
