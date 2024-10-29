 <!-- Main navigation -->
 <div class="card card-sidebar-mobile">
     <ul class="nav nav-sidebar" data-nav-type="accordion">
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
         <li class="nav-item">
             <a href="{{ route('agenda') }}"
                 class="nav-link
                {{ Request::segment(1) == 'agenda' ? 'active' : '' }}
             ">
                 <i class="
                 icon-megaphone"></i>
                 <span>
                     Agenda
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
         <!-- Tamu -->
         <li class="nav-item">
             <a href="{{ route('data-tamu') }}" class="nav-link" wire:navigate>
                 <i class="icon-vcard"></i>
                 <span>Tamu</span>
             </a>
         </li>
         <!-- /main -->

         <!-- Master Section -->
         <li class="nav-item nav-item-submenu">
             <a href="#" class="nav-link dropdown-toggle" data-toggle="collapse" data-target="#master-submenu"
                 aria-expanded="false">
                 <i class="icon-database-menu"></i> <span>Master</span>
             </a>
             <ul id="master-submenu" class="nav nav-group-sub collapse">
                 <li class="nav-item">
                     <a href="{{ route('master.ssh') }}" class="nav-link">
                         <span>SSH</span>
                     </a>
                 </li>
             </ul>
         </li>

     </ul>
 </div>
 <!-- /main navigation -->
