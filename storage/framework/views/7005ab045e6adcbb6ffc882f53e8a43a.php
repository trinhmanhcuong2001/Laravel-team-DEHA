<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu">

    <!-- LOGO -->
    <a href="index.html" class="logo text-center logo-light">
        <span class="logo-lg">
            <img src="<?php echo e(asset('assets/admin/images/logo.png')); ?>" alt="" height="16">
        </span>
        <span class="logo-sm">
            <img src="<?php echo e(asset('assets/admin/images/logo_sm.png')); ?>" alt="" height="16">
        </span>
    </a>

    <!-- LOGO -->
    <a href="index.html" class="logo text-center logo-dark">
        <span class="logo-lg">
            <img src="<?php echo e(asset('assets/admin/images/logo-dark.png')); ?>" alt="" height="16">
        </span>
        <span class="logo-sm">
            <img src="<?php echo e(asset('assets/admin/images/logo_sm_dark.png')); ?>" alt="" height="16">
        </span>
    </a>

    <div class="h-100" id="left-side-menu-container" data-simplebar>

        <!--- Sidemenu -->
        <ul class="metismenu side-nav">

            <li class="side-nav-title side-nav-item">Navigation</li>

            <li class="side-nav-item">
                <a href="<?php echo e(route('dashboard')); ?>" class="side-nav-link">
                    <i class="uil-calender"></i>
                    <span> Dashboards </span>
                </a>
            </li>
            <li class="side-nav-title side-nav-item">Apps</li>

            <li class="side-nav-item">
                <a href="<?php echo e(route('categories.index')); ?>" class="side-nav-link" aria-expanded="true">
                    <i class="uil-layer-group"></i>
                    <span> Categories </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="<?php echo e(route('products.index')); ?>" class="side-nav-link" aria-expanded="true">
                    <i class="uil-shop"></i>
                    <span> Products </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="<?php echo e(route('roles.index')); ?>" class="side-nav-link">
                    <i class="dripicons-user-id"></i>
                    <span> Roles </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="<?php echo e(route('users.index')); ?>" class="side-nav-link">
                    <i class="uil-users-alt"></i>
                    <span> Users </span>
                </a>
            </li>

        </ul>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->
<?php /**PATH /var/www/resources/views/admin/layouts/sidebar.blade.php ENDPATH**/ ?>