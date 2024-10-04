<div class="modal fade show" id="modal-default"
    @if ($modal) style="display: block;" @else style="display: none;" @endif>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3>List Organisasi Perangkat Daerah</h3>
                <button type="button" wire:click='showModal' class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-2">
                    <input type="text" class="form-control" wire:model.live='search' id="search-opdd" autofocus
                        placeholder="Cari Organisasi Perangkat Daerah">
                </div>

                <table class="table table-striped table-hover">
                    <thead>
                        <th>Organisasi Perangkat Daerah</th>
                        <th></th>
                    </thead>
                    <tbody>
                        @foreach ($posts as $item)
                            <tr>
                                <td>{{ $item->nama_opd_lengkap ?? '-' }}</td>
                                <td>
                                    <button type="button" wire:click="pilih('{{ $item->id }}')"
                                        class="btn btn-info btn-flat btn-sm" data-toggle="tooltip" data-placement="left"
                                        title="Pilih Perangkat Daerah"><i class="far fa-check-square mr-1"></i>Pilih
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $posts->links() }}
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger" data-dismiss="modal" wire:click='showModal'><i
                        class="fas fa-window-close mr-1"></i>Tutup</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

@push('js')
    <script>
        document.addEventListener('livewire:load', function() {
            window.addEventListener('focus-search-input', function() {
                // Use setTimeout to ensure modal is fully displayed
                setTimeout(() => {
                    let searchInput = document.getElementById('search-opdd');
                    if (searchInput) {
                        searchInput.focus();
                    }
                }, 500); // 500 ms delay
            });
        });
    </script>
@endpush
