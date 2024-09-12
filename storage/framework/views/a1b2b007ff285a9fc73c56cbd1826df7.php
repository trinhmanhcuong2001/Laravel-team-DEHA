<!-- Topbar Start -->
<div class="navbar-custom" style="box-shadow: 0 0 3px 1px #ccc;">
    <ul class="list-unstyled topbar-right-menu float-right mb-0">

        <li class="dropdown notification-list">
            <a class="nav-link dropdown-toggle nav-user arrow-none mr-0" data-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                aria-expanded="false">
                <span class="account-user-avatar">
                    <img src="<?php echo e(asset('assets/admin/images/users/avatar-1.jpg')); ?>" alt="user-image" class="rounded-circle">
                </span>
                    <?php if(Auth::check()): ?>
                        <span class="account-user-name mt-1"><?php echo e(Auth::user()->name); ?></span>
                    <?php endif; ?>
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated topbar-dropdown-menu profile-dropdown">
                <!-- item-->
                <div class=" dropdown-header noti-title">
                    <h6 class="text-overflow m-0">Welcome !</h6>
                </div>

                <!-- item-->
                <a href="javascript:void(0);" class="dropdown-item notify-item">
                    <i class="mdi mdi-account-circle mr-1"></i>
                    <span>My Account</span>
                </a>

                <!-- item-->
                <a href="" class="dropdown-item notify-item">
                <a href="<?php echo e(route('admin.logout')); ?>" class="dropdown-item notify-item">
                    <i class="mdi mdi-logout mr-1"></i>
                    <span>Logout</span>
                </a>

            </div>
        </li>

    </ul>
    <button class="button-menu-mobile open-left disable-btn">
        <i class="mdi mdi-menu"></i>
    </button>
</div>
<!-- end Topbar -->

<?php /**PATH /var/www/resources/views/admin/layouts/header.blade.php ENDPATH**/ ?>