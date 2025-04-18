<section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
        <div class="pull-left image">
            <img src="{{ asset('storage/foto/' . Auth::user()->foto) }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
            <p>{{ Auth::user()->name }}</p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
    </div>
    <!-- search form -->
    <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Search...">
            <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i
                        class="fa fa-search"></i></button>
            </span>
        </div>
    </form>
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li>
            @auth
                @if (Auth::user()->role === 'admin')
            <li>
                <a href="{{ route('dashboard') }}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
                @endif
            @endauth
        </li>
        <li>
            @auth
                @if (Auth::user()->role === 'svp')
            <li>
                <a href="{{ route('dashboardsvp') }}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
                @endif
            @endauth
        </li>       
        <li>
            @auth
                @if (Auth::user()->role === 'admin')
            <li>
                <a href="{{ route('perbaikan') }}">
                    <i class="fa fa-ticket"></i> <span>Tiketing</span>
                </a>
            </li>
            @endif
        @endauth
        </li>
        @auth
            @if (Auth::user()->role === 'admin')
                <li>
                    <a href="{{ route('permintaan') }}">
                        <i class="fa fa-archive"></i> <span>Permintaan Barang</span>
                    </a>
            @endif
        @endauth
        </li>
        @auth
        @if (Auth::user()->role === 'admin')
        <li>
            <a href="{{ route('peminjaman') }}">
                <i class="fa fa-truck"></i> <span>Peminjaman Barang</span>
            </a>
            @endif
            @endauth
        </li>
        </li>
        @auth
        @if (Auth::user()->role === 'svp')
        <li>
            <a href="{{ route('peminjamansvp') }}">
                <i class="fa fa-truck"></i> <span>Peminjaman Barang</span>
            </a>
            @endif
            @endauth
        </li>
        @auth
            @if (Auth::user()->role === 'admin')
                <li class="header">MASTER</li>
                <li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-pie-chart"></i>
                        <span>Master</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ route('barang') }}"><i class="fa fa-circle-o"></i> Barang</a></li>
                        <li><a href="{{ route('formdivisi') }}"><i class="fa fa-circle-o"></i> Divisi</a></li>
                </li>
        </ul>
        </li>
        @endif
    @endauth
</section>
