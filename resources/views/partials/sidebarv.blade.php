<div class="sidebar-content">
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

    <div class="sidebar-section">
        <ul class="nav nav-sidebar" data-nav-type="accordion">

            <li class="nav-item-header pt-0">
                <div class="text-uppercase fs-sm lh-sm opacity-50 sidebar-resize-hide">Main</div>
                <i class="ph-dots-three sidebar-resize-show"></i>
            </li>

            <li class="nav-item">
                <a href="{{ route('gestion.superviseur') }}" class="nav-link">
                    <i class="ph-house"></i>
                    <span>
                        Dashboard superviseur
                        <span class="d-block fw-normal opacity-50">Espace sécurisé</span>
                    </span>
                </a>
            </li>

            <li class="nav-item-header">
                <div class="text-uppercase fs-sm lh-sm opacity-50 sidebar-resize-hide">Gestion personnel</div>
                <i class="ph-dots-three sidebar-resize-show"></i>
            </li>

            <li class="nav-item nav-item-submenu">
                <a href="#" class="nav-link">
                    <i class="ph-text-aa"></i>
                    <span>Mon profil</span>
                </a>
                <ul class="nav-group-sub collapse">
                    <li class="nav-item">
                        <a href="{{ route('profile.index') }}" class="nav-link">Changer mot de passe</a>
                    </li>
                </ul>
            </li>

        </ul>
    </div>
</div>
