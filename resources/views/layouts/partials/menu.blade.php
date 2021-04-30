<!-- BEGIN: Main Menu-->
    <div class="horizontal-menu-wrapper">
        <div class="header-navbar navbar-expand-sm navbar navbar-horizontal floating-nav navbar-light navbar-without-dd-arrow navbar-shadow menu-border" role="navigation" data-menu="menu-wrapper">
            <div class="navbar-header">
                <ul class="nav navbar-nav flex-row">
                    <li class="nav-item mr-auto"><a class="navbar-brand" href="{{ route('home') }}">
                            <div class="brand-logo"></div>
                            <h2 class="brand-text mb-0">Sysmon</h2>
                        </a></li>
                    <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"></i><i class="toggle-icon feather icon-disc font-medium-4 d-none d-xl-block collapse-toggle-icon primary" data-ticon="icon-disc"></i></a></li>
                </ul>
            </div>
            <!-- Horizontal menu content-->
            <div class="navbar-container main-menu-content" data-menu="menu-container">
                <!-- include ../../../includes/mixins-->
                <ul class="nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation">
                    <li class="nav-item {{ request()->is('home') ? 'active' : '' }}"><a class="nav-link" href="{{ route('home') }}"><i class="feather icon-home"></i><span data-i18n="Dashboard">Dashboard</span></a>
                    </li>
                    <li class="nav-item {{ request()->is('profile') ? 'active' : '' }}"><a class="nav-link" href="{{ route('profile') }}"><i class="feather icon-user"></i><span data-i18n="Profile">Profile</span></a>
                    </li>
                    @role('siswa')
                    <li class="nav-item {{ request()->is('applicant') ? 'active' : '' }}"><a class="nav-link" href="{{ route('applicant.index') }}"><i class="feather icon-search"></i><span data-i18n="Cari Industri">Cari Industri</span></a>
                    </li>
                    @endrole
                    @role('siswa|industri')
                    <li class="nav-item {{ request()->is('prakerin/*') ? 'active' : '' }}"><a class="nav-link" href="{{ auth()->user()->hasRole('siswa') ? route('prakerin.index_s') : route('prakerin.index_i') }}"><i class="feather icon-cpu"></i><span data-i18n="Prakerin">Prakerin</span></a>
                    </li>
                    @endrole
                    @role('guru')
                    <li class="nav-item {{ request()->is('sekolah/tags') ? 'active' : '' }}"><a class="nav-link" href="{{ route('sekolah.tags.index') }}"><i class="feather icon-at-sign"></i><span data-i18n="Tag">Tag</span></a>
                    </li>
                    <li class="nav-item {{ request()->is('guidance') || request()->is('guidance/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('guidance.index') }}"><i class="feather icon-monitor"></i><span data-i18n="Bimbingan">Bimbingan</span></a>
                    </li>
                    @endrole
                    @role('industri')
                    <li class="dropdown nav-item {{ request()->is('vacancy*') ? 'active' : '' }}" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="feather icon-search"></i><span data-i18n="Cari Kandidat">Cari Kandidat</span></a>
                        <ul class="dropdown-menu">
                            <li data-menu=""><a class="dropdown-item" href="{{ route('vacancy.index', ['type' => 'all']) }}" data-toggle="dropdown" data-i18n="Semua"><i class="feather icon-circle"></i>Semua</a>
                            </li>
                            <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#" data-toggle="dropdown" data-i18n="Data List"><i class="feather icon-circle"></i>Aktif</a>
                                <ul class="dropdown-menu">
                                    <li data-menu=""><a class="dropdown-item" href="{{ route('vacancy.index', ['type' => 'active', 'detail' => 'lowongan']) }}" data-toggle="dropdown" data-i18n="List View"><i class="feather icon-circle"></i>Lowongan</a>
                                    </li>
                                    <li data-menu=""><a class="dropdown-item" href="{{ route('vacancy.index', ['type' => 'active', 'detail' => 'lamaran']) }}" data-toggle="dropdown" data-i18n="Thumb View"><i class="feather icon-circle"></i>Lamaran</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    @endrole
                    @role('guru')
                    <li class="nav-item {{ request()->is('student') ? 'active' : '' }}"><a class="nav-link" href="{{ route('student.index') }}"><i class="feather icon-users"></i><span data-i18n="Daftar Siswa">Daftar Siswa</span></a>
                    </li>
                    @endrole
                </ul>
            </div>
        </div>
    </div>
    <!-- END: Main Menu-->