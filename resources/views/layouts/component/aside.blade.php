<aside class="main-sidebar sidebar-dark-primary elevation-4"> <!-- Brand Logo --> <a href="index3.html" class="brand-link"> <img src="{{asset('assets/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> <span class="brand-text font-weight-light">AdminLTE 3</span> </a> <!-- Sidebar -->
    <div class="sidebar"> <!-- Sidebar mahasiswa panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image"> <img src="{{asset('assets/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image"> </div>
            <div class="info"> <a href="#" class="d-block">Test<p> <small>email</small>
                    </p></a> </div>
        </div> <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search"> <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append"> <button class="btn btn-sidebar"> <i class="fas fa-search fa-fw"></i> </button> </div>
            </div>
        </div> <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false"> <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                <li class="nav-item"> <a href="{{url('home')}}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p> Dashboard <span class="right badge badge-danger"></span> </p>
                    </a> </li>
                <li class="nav-header">Management</li>
                <li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p> Settings <i class="right fas fa-angle-left"></i> </p>
                    </a>
                    <ul class="nav nav-treeview"> @canany(['create-role', 'edit-role', 'delete-role']) <li class="nav-item">
                            <a href="{{url('roles')}}" class="nav-link"> <i class="far fa-circle nav-icon"></i>
                                <p>Manage Roles</p>
                            </a>
                        </li> @endcanany 
                        @canany(['create-mahasiswa', 'edit-mahasiswa', 'delete-mahasiswa']) <li class="nav-item"> <a href="{{url('mahasiswas')}}" class="nav-link"> <i class="far fa-circle nav-icon"></i>
                                <p>Manage Mahasiswa</p>
                            </a> </li> @endcanany 
                            @canany(['create-matakuliah', 'edit-matakuliah', 'delete-matakuliah']) <li class="nav-item"> <a href="{{url('matakuliahs')}}" class="nav-link"> <i class="far fa-circle nav-icon"></i>
                                <p>Manage Mata Kuliah</p>
                            </a> </li> @endcanany
                    </ul>
                </li>
                <li class="nav-header">Exit</li>
                <li class="nav-item"> <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link"> <i class="nav-icon fas fa-file-export"></i>
                        <p> {{ __('Logout') }} <span class="right badge badge-danger"></span> </p>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none"> @csrf </form>
                </li>
            </ul>
        </nav> <!-- /.sidebar-menu -->
    </div> <!-- /.sidebar -->
</aside>
