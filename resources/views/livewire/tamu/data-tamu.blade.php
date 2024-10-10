<div>
    <x-slot name="header">
        <livewire:component.page-header judul="Data Tamu" subjudul="Manage Data Tamu" :breadcrumb="['Data Tamu']"
            button='<div class="d-lg-flex mb-2 mb-lg-0">
                         <button type="button" class="btn btn-primary ms-3" wire:click="add">
                            Tambah Data <i class="ph-plus ms-2"></i>
                        </button>
                    </div>' />
    </x-slot>
    <div class="card" style="{{ $form ? 'display:none;' : '' }}">
        <div class="card-header d-flex flex-wrap">
            <h6 class="mb-0">{{ $idNya ? 'Edit' : 'Tambah' }}
                {{ __('Tamu') }}</h6>
            <div class="d-inline-flex ms-auto">
                <a class="text-body" data-card-action="remove" wire:click="batal">
                    <i class="ph-x"></i>
                </a>
            </div>
        </div>

        <div class="card-body">
            <form action="#" wire:submit="save">
                @csrf
                <fieldset class="mb-3">
                    <div class="row mb-3">
                        <label class="col-form-label col-lg-2">{{ __('Tanggal Bertamu') }}</label>
                        <div class="col-lg-10">
                            <input type="date" class="form-control @error('tanggal') is-invalid  @enderror"
                                wire:model="tanggal">
                        </div>
                        @error('tanggal')
                            <span class="form-text text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="row mb-3">
                        <label class="col-form-label col-lg-2">{{ __('Nama Tamu') }}</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control @error('name') is-invalid  @enderror"
                                wire:model="name" placeholder="Masukan Nama Tamu">
                        </div>
                        @error('name')
                            <span class="form-text text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="row mb-3">
                        <label class="col-form-label col-lg-2">{{ __('Instansi') }}</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control @error('instansi') is-invalid  @enderror"
                                wire:model="instansi" placeholder="Masukan Instansi">
                            @error('instansi')
                                <span class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-form-label col-lg-2">{{ __('Kontak Person') }}</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control @error('kontak') is-invalid  @enderror"
                                wire:model="kontak" placeholder="Masukan Nomor WhatsApp">
                            @error('kontak')
                                <span class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-form-label col-lg-2">{{ __('Keperluan') }}</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control @error('keperluan') is-invalid  @enderror"
                                wire:model="keperluan" placeholder="Keperluan">
                            @error('keperluan')
                                <span class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-form-label col-lg-2">{{ __('Jumlah Tamu') }}</label>
                        <div class="col-lg-10">
                            <input type="number" class="form-control @error('jumlah_tamu') is-invalid  @enderror"
                                wire:model="jumlah_tamu" placeholder="Jumlah Tamu">
                            @error('jumlah_tamu')
                                <span class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </fieldset>

                <div class="card-footer bg-white d-flex justify-content-between align-items-center py-2">

                    <ul class="list-inline mb-0">
                        <li class="list-inline-item">
                            <button type="button" class="btn btn-danger" wire:click="batal">Batal</button>
                        </li>
                    </ul>

                    <ul class="list-inline mb-0">
                        <li class="list-inline-item">
                            <button type="submit" class="btn btn-primary text-right">Simpan</button>
                        </li>
                    </ul>
                </div>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <a href="{{ route('tamu-mandiri') }}" class="btn btn-info ms-3" wire:navigate>
                Mandiri <i class="ph-plus ms-2"></i>
            </a>
            <div class="card-header">
                <div class="col-12 row">
                    <x-search />
                    {{-- <x-sort :order="$order" />
                    <x-show :limit="$limit" /> --}}
                </div>
            </div>
            <div class="datatable-scroll">
                <table class="table datatable-basic">
                    <thead>
                        <tr role="row">
                            <th>No.</th>
                            <th>Tanggal</th>
                            <th>Nama Tamu</th>
                            <th>Nomor WhatsApp</th>
                            <th>Instansi</th>
                            <th>Keperluan</th>
                            <th>Jumlah Tamu</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $index => $row)
                            <tr role="row" class="odd {{ $idNya == $row->id ? 'table-active' : '' }}">
                                <td>{{ ($data->currentPage() - 1) * $data->perPage() + $index + 1 }}</td>
                                <td>{{ $row->tanggal }}</td>
                                <td>{{ $row->name }}</td>
                                <td>{{ $row->kontak }}</td>
                                <td>{{ $row->instansi }}</td>
                                <td>{{ $row->keperluan }}</td>
                                <td>{{ $row->jumlah_tamu }}</td>
                                <td class="text-center"> <x-table-action :row="$row" /></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{ $data->links() }}
</div>
