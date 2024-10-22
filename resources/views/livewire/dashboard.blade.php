<div>
    <x-slot name="header">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Home</span> -
                    Dashboard</h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                    <span class="breadcrumb-item active">Dashboard</span>
                </div>

                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
            <div class="header-elements d-none">
            </div>
        </div>
    </x-slot>

    <div class="container mt-3">
        {{-- <livewire:chart.jumlah-chart> --}}
        <div class="row">
            <div class="col-md-6">
                <livewire:chart.perjalanan-dinas-chart>
            </div>
            <div class="col-md-6">
                <livewire:chart.surat-masuk-chart>
            </div>
        </div>
    </div>

</div>
