<nav class="pcoded-navbar">
    <div class="pcoded-inner-navbar main-menu">
        <div class="pcoded-navigatio-lavel" data-i18n="nav.category.navigation">Menu Utama</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="active nav-item">
                <a class="nav-link {{ $menu == 'dashboard' ? '' : 'collapsed' }}" href="{{ route('dashboard-admin') }}">
                    <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i></span>
                    <span class="pcoded-mtext">Dashboard</span>
                </a>
            </li>
            <li class="active nav-item">
                <a class="nav-link {{ $menu == 'guru' ? '' : 'collapsed' }}" href="{{ route('guru.index') }}">
                    <span class="pcoded-micon"><i class="ti-user"></i></span>
                    <span class="pcoded-mtext">Guru</span>
                </a>
            </li>
            <li class="active nav-item">
                <a class="nav-link {{ $menu == 'siswa' ? '' : 'collapsed' }}" href="{{ route('siswa.index') }}">
                    <span class="pcoded-micon"><i class="ti-id-badge"></i></span>
                    <span class="pcoded-mtext">Siswa</span>
                </a>
            </li>
            <li class="active nav-item">
                <a class=" nav-link {{ $menu == 'local' || $menu == 'jurusan' ? '' : 'collapsed' }}"
                    href="{{ route('local.index') }}">
                    <span class="pcoded-micon"><i class="ti-home"></i></span>
                    <span class="pcoded-mtext">Local</span>
                </a>
            </li>
        </ul>
    </div>
</nav>