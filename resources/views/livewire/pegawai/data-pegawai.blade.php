<div>
    <div class="content">
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Data Pegawai</h5>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>NIP</th>
                            <th>Bidang</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tb01 as $rowTb01)
                            <tr>
                                <td>{{ $loop->iteration + 0 }}</td>
                                <td>{{ $rowTb01->nama }}</td>
                                <td>{{ $rowTb01->nip }}</td>
                                <td>{{ $rowTb01->skpd->skpd }}</td>
                        @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
