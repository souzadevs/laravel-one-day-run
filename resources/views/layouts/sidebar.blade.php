<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/') }}" class="brand-link">
        <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/redhat/redhat-original.svg" class="brand-image bg-white img-circle">
        <span class="brand-text font-weight-light">OneDayRun</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu">

                @auth
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link">
                        <i class="nav-icon icon ion-md-pulse"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                @can('view-any', App\Models\CompraPedido::class)
                <li class="nav-item">
                    <a href="{{ route('compra-pedidos.index') }}" class="nav-link">
                        <!-- <i class="nav-icon fas fa-cloudsmith"></i> -->
                        <i class="nav-icon fas fa-fire    "></i>
                        <p>Pedidos</p>
                    </a>
                </li>
                @endcan

                @can('view-any', App\Models\Cliente::class)
                <li class="nav-item">
                    <a href="{{ route('clientes.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Clientes
                        </p>
                    </a>
                </li>
                @endcan


                @can('view-any', App\Models\Produto::class)
                <li class="nav-item">
                    <a href="{{ route('produtos.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-cubes"></i>
                        <p>Produtos</p>
                    </a>
                </li>
                @endcan

                @endauth

                @auth
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="nav-icon icon ion-md-exit"></i>
                        <p>{{ __('Logout') }}</p>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
                @endauth
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>