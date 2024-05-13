<div>
    @can('kepala_dinas')
    <h1>lihat ini kepala_dinas</h1>
    @endcan
    @can('kepala_bidang')
    <h1>lihat ini kepala_bidang</h1>
    @endcan
    @can('sekretariat')
    <h1>lihat ini sekretariat</h1>
    {{-- <div class="content">
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
                        <thead>
                            <tr role="row">
                                <th class="text-left" style="width: 17px;" aria-label="No">Nomor Agenda</th>
                                <th style="width: 150px;" aria-label="Tanggal">Tanggal</th>
                                <th style="width: 222px;" aria-label="Jenis">Jenis</th>
                                <th style="width: 310px;" aria-label="Disposisi">Disposisi</th>
                                <th style="width: 191px;" aria-label="Subject">Subject</th>
                                <th style="width: 222px;" aria-label="Keterangan">Keterangan</th>
                                <th style="width: 176px;" aria-label="Aksi">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $suratmasuk)
                                <tr wire:key='{{ $suratmasuk->id }}'>
                                    <td>{{ $loop->index + $data->firstItem() }}
                                    </td>
                                    <td>{{ $suratmasuk->tgl_surat }}</td>
                                    <td>{{ $suratmasuk->jenis_agenda_tp}}</td>
                                    <td></td>
                                    <td>{{ $suratmasuk->acara }}</td>
                                    <td></td>
                                    <td>
                                        <button type="button" wire:click="delete(' {{ $suratmasuk->id }}')"
                                            class="btn btn-flat btn-sm" data-toggle="tooltip" data-placement="left"
                                            title="Edit"><i class="icon-trash"></i>
                                        </button>
                                        <a href="{{ route('suratmasuk', ['id' => $suratmasuk->id]) }}"
                                            class="btn btn-flat btn-sm">
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
    </div> --}}
    @endcan
    @can('staff')
    <h1>lihat ini staff</h1>
    @endcan

</div>
