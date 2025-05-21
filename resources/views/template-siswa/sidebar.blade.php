<nav class="pcoded-navbar">
    <div class="pcoded-inner-navbar main-menu">
        <div class="pcoded-navigatio-lavel" data-i18n="nav.category.navigation">Menu Utama</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="active nav-item">
                <a class="nav-link {{ $menu == 'dashboard' ? '' : 'collapsed' }}" href="{{ route('dashboard-siswa') }}">
                    <span class=" pcoded-micon"><i class="ti ti-clipboard"></i></span>
                    <span class="pcoded-mtext">Dashboard</span>
                </a>
            </li>
            <li class="active nav-item">
                <a class="nav-link {{ $menu == 'absen' ? '' : 'collapsed' }}" href="{{ route('rekap.index') }}">
                    <span class="pcoded-micon"><i class="ti ti-agenda"></i></span>
                    <span class="pcoded-mtext">Rekap</span>
                </a>
            </li>
        </ul>
    </div>
</nav>