<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" href="{{ route('home') }}">
                    <div class="brand-logo"></div>
                    <h2 class="brand-text mb-0" style="font-size: 14px">SYSMON</h2>
                </a>
            </li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <div class="company" style="padding:0.5em 15px;background:#f9f9f9;">
            <div class="col-md-12">
                <div class="d-flex justify-content-center mt-1 mb-0">
                    <div>
                        <img width="150px" height="150px" class="d-flex justify-content-center" src="https://smkkotadijawatimur.files.wordpress.com/2017/04/logo-smkn-1-sby.jpg?w=241&h=299" alt="">
                    </div>
                </div>
                <div class="d-flex justify-content-center mt-1 mb-0">
                    <strong>SMK NEGERI 1 SURABAYA</strong>
                </div>
            </div>
        </div>
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item {{ request()->is('home') ? ' active' : '' }}"><a href="{{ route('home') }}"><i class="feather icon-home"></i><span class="menu-title" data-i18n="Dashboard">Dashboard</span></a>
            </li>
            <li class=" nav-item {{ request()->is('profile') ? ' active' : '' }}"><a href="{{ route('profile') }}"><i class="feather icon-user"></i><span class="menu-title" data-i18n="Profile">Profil</span></a>
            </li>
            @role('siswa')
            <li class=" nav-item"><a href="#"><i class="feather icon-search"></i><span class="menu-title" data-i18n="Ecommerce">Cari Industri</span></a>
                <ul class="menu-content">
                    <li class="{{ request()->is('applicant') && request()->query('detail') == 'lowongan' ? 'active' : '' }}"><a href="{{ route('applicant.index', ['detail' => 'lowongan']) }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Shop">Lowongan</span></a>
                    </li>
                    <li class="{{ request()->is('applicant') && request()->query('detail') == 'proposal' ? 'active' : '' }}"><a href="{{ route('applicant.index', ['detail' => 'proposal']) }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Details">Proposal</span></a>
                    </li>
                </ul>
            </li>
            @endrole
            @role('siswa|industri')
            <li class=" nav-item {{ request()->is('prakerin/*') ? 'active' : '' }}"><a href="{{ auth()->user()->hasRole('siswa') ? route('prakerin.index_s') : route('prakerin.index_i') }}"><i class="feather icon-cpu"></i><span class="menu-title" data-i18n="Prakerin">Prakerin</span></a>
            </li>
            @endrole
            @role('guru')
            <li class=" nav-item {{ request()->is('sekolah/tags') ? 'active' : '' }}"><a href="{{ route('sekolah.tags.index') }}"><i class="feather icon-at-sign"></i><span class="menu-title" data-i18n="Tags">Tags</span></a>
            </li>
            <li class=" nav-item {{ request()->is('guidance') || request()->is('guidance/*') ? 'active' : '' }}"><a href="{{ route('guidance.index') }}"><i class="feather icon-monitor"></i><span class="menu-title" data-i18n="Bimbingan">Bimbingan</span></a>
            </li>
            @endrole
            @role('industri')
            <li class=" nav-item"><a href="#"><i class="feather icon-file-text"></i><span class="menu-title" data-i18n="Cari Kandidat">Cari Kandidat</span></a>
                <ul class="menu-content">
                    <li class="{{ request()->is('vacancy') && request()->query('type') == 'all' ? 'active' : '' }}"><a href="{{ route('vacancy.index', ['type' => 'all']) }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Semua">Semua</span></a>
                    </li>
                    <li><a href="#"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Aktif">Aktif</span></a>
                        <ul class="menu-content">
                            <li class="{{ request()->is('vacancy') && request()->query('type') == 'active' && request()->query('detail') == 'lowongan' ? 'active' : '' }}"><a href="{{ route('vacancy.index', ['type' => 'active', 'detail' => 'lowongan']) }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Lowongan">Lowongan</span></a>
                            </li>
                            <li class="{{ request()->is('vacancy') && request()->query('type') == 'active' && request()->query('detail') == 'proposal' ? 'active' : '' }}"><a href="{{ route('vacancy.index', ['type' => 'active', 'detail' => 'proposal']) }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Proposal">Proposal</span></a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            @endrole
            @role('guru')
            <li class=" nav-item {{ request()->is('student') ? 'active' : '' }}"><a href="{{ route('student.index') }}"><i class="feather icon-users"></i><span class="menu-title" data-i18n="Daftar Siswa">Daftar Siswa</span></a>
            </li>
            @endrole
        </ul>
    </div>
</div> 