<div>
    <div class="content">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <h3>Master Dasar Perjalanan Dinas</h3>
                    <div class="dropdown-divider"></div>
                </div>
                <div class="card-body">
                    <form wire:submit='save'>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label class="col-form-label col-lg-12">Nama<span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <textarea rows="4" wire:model='nama' class="form-control"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            @error('nama')
                                                <div class="text-danger">
                                                    <i class="icon-cancel-circle2"></i>
                                                    <span><b>{{ $message }}</b></span>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Button Submit -->
                        <div class="text-right">
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary"><i class="mr-2 icon-paperplane"></i>
                                    Submit
                                </button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive mb-2">
                        <table class="table table-striped dataTable" id="DataTables_Table_0" role="grid"
                            aria-describedby="DataTables_Table_0_info">
                            <thead>
                                <tr role="row">
                                    {{-- <th>No</th> --}}
                                    <th>Nama</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                {{-- @foreach ($data as $list) --}}
                                <tr>
                                    {{-- <td>{{ $loop->iteration }}</td> --}}
                                    <td>{{ $data->nama ?? '' }}</td>
                                    <td><button type="button" class="btn alpha-primary text-primary-800 btn-icon ml-2"
                                            wire:click='edit'>
                                            <i class="icon-pencil7"></i>
                                        </button>
                                    </td>
                                </tr>
                                {{-- @endforeach --}}
                            </tbody>
                        </table>
                    </div>

                    {{-- {{ $sppds->links('pagination::bootstrap-5') }} --}}

                </div>
            </div>
        </div>
    </div>

</div>
