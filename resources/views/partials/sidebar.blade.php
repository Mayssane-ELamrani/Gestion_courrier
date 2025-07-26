<div class="sidebar-content">

    <!-- Sidebar header -->
    <div class="sidebar-section">
        <div class="sidebar-section-body d-flex justify-content-center">
            <h5 class="sidebar-resize-hide flex-grow-1 my-auto">Menu</h5>

            <div>
                <button type="button" class="btn btn-flat-white btn-icon btn-sm rounded-pill border-transparent sidebar-control sidebar-main-resize d-none d-lg-inline-flex">
                    <i class="ph-arrows-left-right"></i>
                </button>

                <button type="button" class="btn btn-flat-white btn-icon btn-sm rounded-pill border-transparent sidebar-mobile-main-toggle d-lg-none">
                    <i class="ph-x"></i>
                </button>
            </div>
        </div>
    </div>
    <!-- /sidebar header -->

    <!-- Main navigation -->
    <div class="sidebar-section">
        <ul class="nav nav-sidebar" data-nav-type="accordion">

            <!-- Main -->
            <li class="nav-item-header pt-0">
                <div class="text-uppercase fs-sm lh-sm opacity-50 sidebar-resize-hide">Main</div>
                <i class="ph-dots-three sidebar-resize-show"></i>
            </li>

            <li class="nav-item">
                <a href="{{ route('gestion.admin') }}" class="nav-link">
                    <i class="ph-house"></i>
                    <span>
                        Dashboard admin
                        <span class="d-block fw-normal opacity-50">espace securisé</span>
                    </span>
                </a>
            </li>

            <!-- Forms -->
            <li class="nav-item-header">
                <div class="text-uppercase fs-sm lh-sm opacity-50 sidebar-resize-hide">Gestion</div>
                <i class="ph-dots-three sidebar-resize-show"></i>
            </li>

            <li class="nav-item nav-item-submenu">
                <a href="#" class="nav-link">
                    <i class="ph-text-aa"></i>
                    <span>Utilisateurs</span>
                </a>
                <ul class="nav-group-sub collapse">
                    <li class="nav-item">
                        <a href="{{ route('admin.utilisateur.index') }}" class="nav-link">ajouter user</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.utilisateur.liste') }}" class="nav-link">liste users</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item nav-item-submenu">
                <a href="#" class="nav-link">
                    <i class="ph-hand-pointing"></i>
                    <span>Départements</span>
                </a>
                <ul class="nav-group-sub collapse">
                    <li class="nav-item">
                        <a href="{{ route('admin.departement.index') }}" class="nav-link">ajouter departement</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.departement.liste') }}" class="nav-link">liste departements</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item nav-item-submenu">
                <a href="#" class="nav-link">
                    <i class="ph-browser"></i>
                    <span>Objets</span>
                </a>
                <ul class="nav-group-sub collapse">
                    <li class="nav-item">
                        <a href="{{ route('admin.objet.index') }}" class="nav-link">ajouter objet</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.objet.liste') }}" class="nav-link">liste objets</a>
                    </li>
                </ul>
            </li>

        </ul>
    </div>
    <!-- /main navigation -->

</div>
