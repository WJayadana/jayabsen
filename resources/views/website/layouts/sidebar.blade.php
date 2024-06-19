<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
        <img src="{{ asset('assets/dist/img/antawa-white.jpg') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Jayabsen</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                @canany(['view jurusan', 'create jurusan', 'edit jurusan', 'delete jurusan', 'view tingkat', 'create tingkat', 'edit tingkat', 'delete tingkat', 'view siswa', 'create siswa', 'edit siswa', 'delete siswa'])
                    <li class="nav-item {{ Route::is('jurusans*') || Route::is('tingkats*') || Route::is('siswa*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ Route::is('jurusans*') || Route::is('tingkats*') || Route::is('siswa*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-th"></i>
                            <p>Master Data<i class="fas fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            @canany(['view jurusan', 'create jurusan', 'edit jurusan', 'delete jurusan'])
                                <li class="nav-item">
                                    <a href="{{ route('jurusans.index') }}" class="nav-link {{ Route::is('jurusans*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Jurusan</p>
                                    </a>
                                </li>
                            @endcanany

                            @canany(['view tingkat', 'create tingkat', 'edit tingkat', 'delete tingkat'])
                                <li class="nav-item">
                                    <a href="{{ route('tingkats.index') }}" class="nav-link {{ Route::is('tingkats*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Tingkat/Kelas</p>
                                    </a>
                                </li>
                            @endcanany

                            @canany(['view siswa', 'create siswa', 'edit siswa', 'delete siswa'])
                                <li class="nav-item">
                                    <a href="{{ route('siswa.index') }}" class="nav-link {{ Route::is('siswa*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Siswa</p>
                                    </a>
                                </li>
                            @endcanany
                        </ul>
                    </li>
                @endcanany

                @canany(['view device', 'create device', 'edit device', 'delete device'])
                    <li class="nav-item">
                        <a href="{{ route('devices.index') }}" class="nav-link {{ Route::is('devices*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-server"></i>
                            <p>Devices</p>
                        </a>
                    </li>
                @endcanany

                @canany(['view kartu', 'delete kartu'])
                    <li class="nav-item">
                        <a href="{{ route('kartus.index') }}" class="nav-link {{ Route::is('kartus*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-id-card"></i>
                            <p>RFID Registration</p>
                        </a>
                    </li>
                @endcanany

                @canany(['view absensi'])
                <li class="nav-item">
                  <a href="{{ route('absensis.index') }}" class="nav-link {{ Route::is('absensis*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-file"></i>
                    <p>
                      Absensi
                    </p>
                  </a>
                </li>
              @endcanany

                @canany(['view role permission', 'create role permission', 'edit role permission', 'delete role permission', 'view user', 'create user', 'edit user', 'delete user'])
                    <li class="nav-item {{ Route::is('users*') || Route::is('roles*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ Route::is('users*') || Route::is('roles*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-users"></i>
                            <p>User<i class="fas fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            @canany(['view role permission', 'create role permission', 'edit role permission', 'delete role permission'])
                                <li class="nav-item">
                                    <a href="{{ route('roles.index') }}" class="nav-link {{ Route::is('roles*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Role & Permission</p>
                                    </a>
                                </li>
                            @endcanany

                            @canany(['view user', 'create user', 'edit user', 'delete user'])
                                <li class="nav-item">
                                    <a href="{{ route('users.index') }}" class="nav-link {{ Route::is('users*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>User</p>
                                    </a>
                                </li>
                            @endcanany
                        </ul>
                    </li>
                @endcanany

                @canany(['view absensi by date', 'export excel absensi by date', 'export pdf absensi by date', 'view absensi by siswa', 'export excel absensi by siswa', 'export pdf absensi by siswa'])
                    <li class="nav-item {{ Route::is('reports.date*') || Route::is('reports.siswa*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ Route::is('reports.date*') || Route::is('reports.siswa*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>Reports<i class="fas fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            @canany(['view absensi by date', 'export excel absensi by date', 'export pdf absensi by date'])
                                <li class="nav-item">
                                    <a href="{{ route('reports.date') }}" class="nav-link {{ Route::is('reports.date*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Report By Date</p>
                                    </a>
                                </li>
                            @endcanany

                            @canany(['view absensi by siswa', 'export excel absensi by siswa', 'export pdf absensi by siswa'])
                                <li class="nav-item">
                                    <a href="{{ route('reports.siswa') }}" class="nav-link {{ Route::is('reports.siswa*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Report By Siswa</p>
                                    </a>
                                </li>
                            @endcanany
                        </ul>
                    </li>
                @endcanany

                @canany(['view setting', 'edit setting'])
                <li class="nav-item">
                    <a href="{{ route('pengaturans.index') }}" class="nav-link {{ Route::is('pengaturans*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>Pengaturan</p>
                    </a>
                </li>
                @endcanany
                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
