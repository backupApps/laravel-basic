<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title text-white">Menu</li>

                <li>
                    <a href="{{ route('dashboard') }}" class="waves-effect">
                        <i class="mdi mdi-view-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('peminjaman') }}" class="waves-effect">
                        <i class="mdi mdi-account-box"></i>
                        <span>Peminjaman</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('laporan') }}" class="waves-effect">
                        <i class="mdi mdi-book-alphabet"></i>
                        <span>Laporan</span>
                    </a>
                </li>

                @if (session('auth_role') === 'admin')
                    <li class="menu-title text-white">Data Master</li>

                    <li>
                        <a href="{{ route('barang') }}" class="waves-effect">
                            <i class="mdi mdi-stack-exchange"></i>
                            <span>Barang</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('mahasiswa') }}" class="waves-effect">
                            <i class="mdi mdi-school"></i>
                            <span>Mahasiswa</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('admin') }}" class="waves-effect">
                            <i class="mdi mdi-account-tie"></i>
                            <span>Admin</span>
                        </a>
                    </li>
                @endif

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
