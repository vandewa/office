  <!-- Main navigation -->
  <hr>
  <div class="card card-sidebar-mobile">
      <ul class="nav nav-sidebar" data-nav-type="accordion">

          <!-- Main -->
          {{-- <li class="nav-item-header">
              <div class="text-uppercase font-size-xs line-height-xs">Menu</div> <i class="icon-menu" title="Main"></i>
          </li> --}}
          <li class="nav-item">
              <a href="{{ route('dashboard') }}" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                  <i class="icon-home"></i>
                  <span>
                      Dashboard
                  </span>
              </a>
          </li>
          <li class="nav-item">
              <a href="{{ route('sppd-index') }}"
                  class="nav-link 
              {{ request()->is('sppd-index') ? 'active' : '' }}
              {{ request()->is('sppd') ? 'active' : '' }}
              {{ request()->is('sppd-kepala') ? 'active' : '' }}
              ">
                  <i class="icon-bus"></i>
                  <span>
                      Perjalanan Dinas
                  </span>
              </a>
          </li>
          <li class="nav-item">
              <a href="{{ route('suratmasuk-index') }}"
                  class="nav-link
                 {{ Request::segment(1) == 'surat-masuk-index' ? 'active' : '' }}
                 {{ Request::segment(1) == 'surat-masuk' ? 'active' : '' }}
                 {{ Request::segment(1) == 'disposisi' ? 'active' : '' }}
              ">
                  <i class="
                  icon-mail-read"></i>
                  <span>
                      Surat Masuk
                  </span>
              </a>
          </li>
          <!-- /main -->
          <li class="nav-item">
              <a href="{{ route('informasi-opd') }}"
                  class="nav-link
              {{ request()->is('informasi-opd') ? 'active' : '' }}
              ">
                  <i class="icon-office"></i>
                  <span>
                      Informasi OPD
                  </span>
              </a>
          </li>
          <li class="nav-item">
              <a href="{{ route('datapegawai') }}"
                  class="nav-link
              {{ request()->is('datapegawai') ? 'active' : '' }}
              ">
                  <i class="icon-users2"></i>
                  <span>
                      Data Pegawai
                  </span>
              </a>
          </li>
          <!-- /main -->
          <li class="nav-item nav-item-submenu">
              <a href="#" class="nav-link">
                  <i class="icon-database-menu"></i> <span>Master</span>
              </a>
              <ul class="nav nav-group-sub" data-submenu-title="Presensi">
                  <li class="nav-item">
                      <a href="{{ route('master.ssh') }}" class="nav-link">
                          <span>SSH </span>
                      </a>
                  </li>
              </ul>
          </li>

      </ul>
  </div>
  <!-- /main navigation -->
