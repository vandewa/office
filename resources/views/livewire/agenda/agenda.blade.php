<div>
    <x-slot name="header">
        <livewire:component.page-header judul="Data Agenda" subjudul="Manage Data Agenda" :breadcrumb="['Data Agenda']"
            button='
            <div class="d-lg-flex mb-2 mb-lg-0">
                         <button type="button" class="btn btn-info ms-3" wire:click="agenda">
                            Front Agenda<i class="ph-plus ms-2"></i>
                        </button>
                    </div>
                    &nbsp;
            <div class="d-lg-flex mb-2 mb-lg-0">
                         <button type="button" class="btn btn-primary ms-3" wire:click="add">
                            Tambah Data <i class="ph-plus ms-2"></i>
                        </button>
                    </div>' />
    </x-slot>
</div>
