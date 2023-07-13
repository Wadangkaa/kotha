<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
            <a href="#" class="d-block">Guest User</a>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
            data-accordion="false">

            <li class="nav-item">
                <a href="{{ route('kotha.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        {{ __('Dashboard') }}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('post.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        My posts
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('kotha.create') }}" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        Create Kotha
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('trash') }}" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        Bin
                    </p>
                </a>
            </li>


        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
