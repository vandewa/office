<div>
    <div class="content">
        <!-- dashboard.blade.php -->
        <div class="card">
            <div class="card-header">
                <h3> Grafik Surat </h3>
            </div>
            <div class="card-body" style="height: 200px;">
                <livewire:surat-chart />
            </div>
        </div>

        <div class="row">
            @can('sekretariat')
                <div class="col-lg-4">
                    <a href="{{ route('suratmasuk') }}">
                        <div class="card" style="height: 200px; background-color: #B0B4ED;">
                            <div class="card-body">
                                <div class="d-flex">
                                    <h3 class="font-weight-semibold mb-0" style="color: #FFFFFF;">Buat Surat Masuk</h3>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4">
                    <a href="{{ route('suratkeluar') }}">
                        <div class="card" style="height: 200px; background-color: #8288E3;">
                            <div class="card-body">
                                <div class="d-flex">
                                    <h3 class="font-weight-semibold mb-0" style="color: #FFFFFF;">Buat Surat Keluar</h3>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endcan
            <div class="col-lg-4">
                <a href="{{ route('sppd') }}">
                    <div class="card" style="height: 200px; background-color: #676EDC;">
                        <div class="card-body">
                            <div class="d-flex">
                                <h3 class="font-weight-semibold mb-0" style="color: #FFFFFF;">Buat SPPD</h3>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="card">
            <div class="card-header">
                <h1 class="font-weight-semibold mb-0" style="color: #000000;">Surat Masuk Untuk Anda</h3>
            </div>
            <div class="card-body">
                @livewire('surat.surat-masuk-index', ['showHeader' => false])
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h1 class="font-weight-semibold mb-0" style="color: #000000;">Surat Keluar Untuk Anda</h3>
            </div>
            <div class="card-body">
                @livewire('surat.surat-keluar-index', ['showHeader' => false])
            </div>
        </div>
    </div>
</div>
