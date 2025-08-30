<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="./index.html" class="text-nowrap logo-img text-center d-block py-2 w-100">
                <img src="<?= base_url() ?>/assets/images/logos/logo_bimba.png" width="150" alt="" />
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Home</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="<?= base_url('admin/dashboard') ?>" aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Tools</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="<?= base_url('admin/soal') ?>" aria-expanded="false">
                        <span>
                            <i class="ti ti-article"></i>
                        </span>
                        <span class="hide-menu">Soal</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="./ui-alerts.html" aria-expanded="false">
                        <span>
                            <i class="ti ti-report"></i>
                        </span>
                        <span class="hide-menu">Nilai</span>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>