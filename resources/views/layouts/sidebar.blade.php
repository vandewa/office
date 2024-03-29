  <!-- Main navigation -->
  <div class="card card-sidebar-mobile">
      <ul class="nav nav-sidebar" data-nav-type="accordion">

          <!-- Main -->
          <li class="nav-item-header">
              <div class="text-uppercase font-size-xs line-height-xs">Main</div> <i class="icon-menu" title="Main"></i>
          </li>
          <li class="nav-item">
              <a href="{{ route('dashboard') }}" class="nav-link">
                  <i class="icon-home"></i>
                  <span>
                      Dashboard
                  </span>
              </a>
          </li>
          <li class="nav-item">
              <a href="{{ route('sppd-index') }}" class="nav-link">
                  <i class="icon-briefcase3"></i>
                  <span>
                      Perjalanan Dinas
                  </span>
              </a>
          </li>
          <li class="nav-item">
              <a href="{{ route('suratMasuk') }}" class="nav-link">
                  <i class="
                  icon-mail-read"></i>
                  <span>
                      Surat Masuk
                  </span>
              </a>
          </li>
          <!-- /main -->
          <li class="nav-item">
            <a href="{{ route('dataPegawai') }}" class="nav-link">
                <i class="icon-users"></i>
                <span>
                    Data Pegawai
                </span>
            </a>
        </li>
        <!-- /main -->

      </ul>
  </div>
  <!-- /main navigation -->
