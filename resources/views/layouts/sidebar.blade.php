<!-- Main navigation -->
<div class="card card-sidebar-mobile">
    <ul class="nav nav-sidebar" data-nav-type="accordion">

        <!-- Main Section Header -->
        <li class="nav-item-header">
            <div class="text-uppercase font-size-xs line-height-xs">Main</div>
            <i class="icon-menu" title="Main"></i>
        </li>

        <!-- Dashboard -->
        <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link" wire:navigate>
                <i class="icon-home"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <!-- Perjalanan Dinas -->
        <li class="nav-item">
            <a href="{{ route('sppd-index') }}" class="nav-link" wire:navigate>
                <i class="icon-bus"></i>
                <span>Perjalanan Dinas</span>
            </a>
        </li>

        <!-- Surat Masuk -->
        <li class="nav-item">
            <a href="{{ route('suratmasuk') }}" class="nav-link" wire:navigate>
                <i class="icon-mail-read"></i>
                <span>Surat Masuk</span>
            </a>
        </li>

        <!-- Informasi Organisasi Perangkat Daerah -->
        <li class="nav-item">
            <a href="{{ route('informasi-opd') }}" class="nav-link" wire:navigate>
                <i class="icon-office"></i>
                <span>Informasi Organisasi Perangkat Daerah</span>
            </a>
        </li>

        <!-- Data Pegawai -->
        <li class="nav-item">
            <a href="{{ route('datapegawai') }}" class="nav-link" wire:navigate>
                <i class="icon-users2"></i>
                <span>Data Pegawai</span>
            </a>
        </li>

        <!-- Tamu -->
        <li class="nav-item">
            <a href="{{ route('data-tamu') }}" class="nav-link" wire:navigate>
                <i class="icon-vcard"></i>
                <span>Tamu</span>
            </a>
        </li>

        <!-- Master Section -->
        <li class="nav-item nav-item-submenu">
            <a href="#" class="nav-link">
                <i class="icon-database-menu"></i>
                <span>Master</span>
            </a>
            <ul class="nav nav-group-sub" data-submenu-title="Presensi">
                <li class="nav-item">
                    <a href="{{ route('master.ssh') }}" class="nav-link" wire:navigate>
                        <span>SSH</span>
                    </a>
                </li>
            </ul>
        </li>

    </ul>
</div>
<!-- /main navigation -->
